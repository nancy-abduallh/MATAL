<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Event;
use App\Models\TouristRoute;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatalApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads_successfully_with_matal_content(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('اكتشف جازان');
        $response->assertSee('أعاليها');
        $response->assertSee('سواحلها');
        $response->assertSee('تنوّع استثنائي في مكان واحد');
    }

    public function test_routes_index_and_detail_page_work(): void
    {
        $response = $this->get(route('routes.index'));
        $response->assertStatus(200);
        $response->assertSee('المسارات السياحية');

        $route = TouristRoute::first();
        $detailResponse = $this->get(route('routes.show', $route->slug));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee($route->title);
    }

    public function test_destinations_index_and_detail_page_work(): void
    {
        $response = $this->get(route('destinations.index'));
        $response->assertStatus(200);
        $response->assertSee('الوجهات');

        $dest = Destination::first();
        $detailResponse = $this->get(route('destinations.show', $dest->slug));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee($dest->title);
        $detailResponse->assertSee('قصة المكان');
        $detailResponse->assertSee('معلومات الزيارة');
    }

    public function test_smart_map_and_api_endpoints_work(): void
    {
        $pageResponse = $this->get(route('map.index'));
        $pageResponse->assertStatus(200);
        $pageResponse->assertSee('الخريطة السياحية');

        $apiPointsResponse = $this->getJson(route('map.points'));
        $apiPointsResponse->assertStatus(200)
            ->assertJsonPath('status', 'success');

        $aiPlanResponse = $this->postJson(route('map.ai-plan'), [
            'prompt' => 'رحلة عائلية يومين في جازان',
            'days' => 2,
            'group_type' => 'عائلة',
            'interests' => ['الجبال', 'المزارع'],
        ]);

        $aiPlanResponse->assertStatus(200)
            ->assertJsonPath('status', 'success')
            ->assertJsonStructure([
                'status',
                'message',
                'itinerary' => [
                    'day_1' => ['day_number', 'title', 'stops'],
                    'day_2' => ['day_number', 'title', 'stops'],
                ],
            ]);
    }

    public function test_events_page_loads(): void
    {
        $response = $this->get(route('events.index'));
        $response->assertStatus(200);
        $response->assertSee('الفعاليات والمهرجانات');

        $event = Event::first();
        if ($event) {
            $detailResponse = $this->get(route('events.show', $event->slug));
            $detailResponse->assertStatus(200);
            $detailResponse->assertSee($event->title);
        }
    }

    public function test_booking_submission_flow_creates_booking_and_shows_ticket(): void
    {
        $route = TouristRoute::first();

        $bookingData = [
            'bookable_type' => 'route',
            'bookable_id' => $route->id,
            'customer_name' => 'سارة الخالدي',
            'customer_phone' => '0512345678',
            'customer_email' => 'sara@example.com',
            'trip_date' => now()->addDays(5)->toDateString(),
            'adults_count' => 2,
            'children_count' => 1,
            'payment_method' => 'mada',
            'addons' => ['local_guide'],
        ];

        $postResponse = $this->post(route('booking.store'), $bookingData);
        $postResponse->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'customer_name' => 'سارة الخالدي',
            'customer_email' => 'sara@example.com',
            'adults_count' => 2,
        ]);
    }

    public function test_contact_form_submission_stores_message(): void
    {
        $contactData = [
            'name' => 'علي عسيري',
            'email' => 'ali@example.com',
            'phone' => '0599988877',
            'subject' => 'استفسار عن حجز النزل',
            'message' => 'أود الاستفسار عن توفر مرشد باللغة الإنجليزية للأصدقاء.',
        ];

        $response = $this->post(route('contact.submit'), $contactData);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'email' => 'ali@example.com',
            'name' => 'علي عسيري',
        ]);
    }

    public function test_demo_login_authenticates_user(): void
    {
        $response = $this->get(route('auth.demo', 'tourist'));
        $response->assertRedirect(route('account.index'));
        $this->assertAuthenticated();
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $tourist = User::where('role', 'tourist')->first();
        $response = $this->actingAs($tourist)->get(route('admin.index'));

        $response->assertStatus(403);
    }

    public function test_admin_user_can_access_admin_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $response = $this->actingAs($admin)->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertSee('لوحة مؤشرات الأداء والتحليلات');
    }

    public function test_admin_login_page_loads_and_guest_is_redirected(): void
    {
        // Login page loads
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
        $response->assertSee('تسجيل الدخول الإداري');

        // Guest accessing /admin is redirected to /admin/login
        $guestResponse = $this->get(route('admin.index'));
        $guestResponse->assertRedirect(route('admin.login'));
    }

    public function test_admin_login_authenticates_admin_and_blocks_regular_user(): void
    {
        // Tourist cannot log in via admin login
        $touristResponse = $this->post(route('admin.login.submit'), [
            'email' => 'tourist@matal.sa',
            'password' => 'password123',
        ]);
        $touristResponse->assertSessionHasErrors('email');
        $this->assertGuest();

        // Admin logs in successfully
        $adminResponse = $this->post(route('admin.login.submit'), [
            'email' => 'admin@matal.sa',
            'password' => 'password123',
        ]);
        $adminResponse->assertRedirect(route('admin.index'));
        $this->assertAuthenticated();

        // Admin logout
        $logoutResponse = $this->post(route('admin.logout'));
        $logoutResponse->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_admin_can_update_booking_status_with_validation(): void
    {
        $admin = User::where('role', 'admin')->first();
        $booking = Booking::first();

        // Valid status update
        $validResponse = $this->actingAs($admin)->post(route('admin.bookings.status', $booking->id), [
            'status' => 'completed',
        ]);
        $validResponse->assertRedirect();
        $this->assertEquals('completed', $booking->fresh()->status);

        // Invalid status update rejected
        $invalidResponse = $this->actingAs($admin)->post(route('admin.bookings.status', $booking->id), [
            'status' => 'invalid_status_xyz',
        ]);
        $invalidResponse->assertSessionHasErrors('status');
    }
}
