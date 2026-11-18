<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Event;
use App\Models\TouristRoute;
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
}
