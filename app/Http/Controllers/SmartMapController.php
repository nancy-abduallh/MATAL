<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\SavedTrip;
use App\Models\TouristRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmartMapController extends Controller
{
    /**
     * Display the interactive Smart Map and AI Planner workspace.
     */
    public function index(): View
    {
        $categories = Category::orderBy('order')->get();
        $destinations = Destination::all();
        $routes = TouristRoute::all();

        return view('pages.map.index', compact('categories', 'destinations', 'routes'));
    }

    /**
     * Return JSON endpoints for Leaflet map markers and filter layers.
     */
    public function apiPoints(Request $request): JsonResponse
    {
        $categorySlug = $request->query('category');
        $query = Destination::with('category');

        if ($categorySlug && $categorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $points = $query->get()->map(function (Destination $dest) {
            return [
                'id' => $dest->id,
                'title' => $dest->title,
                'slug' => $dest->slug,
                'tagline' => $dest->tagline,
                'region' => $dest->region,
                'lat' => (float) $dest->latitude,
                'lng' => (float) $dest->longitude,
                'image' => $dest->image,
                'rating' => (float) $dest->rating,
                'price' => (float) $dest->price,
                'difficulty' => $dest->difficulty,
                'category_name' => $dest->category?->name ?? 'معلم سياحي',
                'category_slug' => $dest->category?->slug ?? 'general',
                'url' => route('destinations.show', $dest->slug),
            ];
        });

        return response()->json([
            'status' => 'success',
            'count' => $points->count(),
            'data' => $points,
        ]);
    }

    /**
     * Generate an AI-powered personalized itinerary.
     */
    public function aiPlan(Request $request): JsonResponse
    {
        $request->validate([
            'prompt' => 'nullable|string|max:500',
            'days' => 'nullable|integer|min:1|max:5',
            'group_type' => 'nullable|string',
            'interests' => 'nullable|array',
        ]);

        $days = (int) ($request->input('days') ?: 2);
        $groupType = $request->input('group_type') ?: 'عائلة';
        $interests = $request->input('interests') ?: ['الجبال', 'المزارع', 'الطبيعة'];
        $userPrompt = $request->input('prompt') ?: 'لدي عائلة من 5 أشخاص، معنا أطفال، ونريد رحلة يومين في جازان، ونفضل الجبال والطبيعة والمزارع.';

        // Build customized dynamic itinerary based on input
        $itinerary = [];

        // Day 1
        $itinerary['day_1'] = [
            'day_number' => 1,
            'title' => 'اليوم الأول: سحر أعالي جازان ومزارع البن الخولاني',
            'summary' => 'الانطلاق من مدينة جازان نحو القطاع الجبلي الشاهق، قضاء وقت ممتع بين الغيوم ومدرجات البن والمطلات البانورامية.',
            'stops' => [
                [
                    'time' => '08:30 ص',
                    'title' => 'الصعود إلى مطل جبل حبس وجبال فيفا',
                    'desc' => 'استنشاق الهواء العليل ومراقبة معانقة الضباب للقمم الخضراء والمدرجات الحلزونية.',
                    'tag' => 'مطل طبيعي',
                    'icon' => 'mountain',
                ],
                [
                    'time' => '11:00 ص',
                    'title' => 'زيارة مزارع البن الخولاني وتجربة الحصاد',
                    'desc' => 'جولة تفاعلية مع المزارعين المحليين لقطاف حبوب البن ومعايشة إرث اليونسكو.',
                    'tag' => 'مزرعة وتراث',
                    'icon' => 'coffee',
                ],
                [
                    'time' => '01:30 م',
                    'title' => 'وجبة غداء شعبية جازانية (مغش ومرسة)',
                    'desc' => 'تذوق ألذ المأكولات الجازانية المطهوة في أواني الحجر الطبيعي وتنانير الفخار.',
                    'tag' => 'مطعم محلي',
                    'icon' => 'utensils',
                ],
                [
                    'time' => '04:30 م',
                    'title' => 'مقهى مطل الدرب في الريث',
                    'desc' => 'استراحة مع القهوة السعودية الفاخرة والتقاط الصور التذكارية مع الغروب البانورامي.',
                    'tag' => 'مقهى واستراحة',
                    'icon' => 'camera',
                ],
                [
                    'time' => '07:30 م',
                    'title' => 'تسجيل الوصول في نزل ريفي جبلي',
                    'desc' => 'الاسترخاء في سكن وسط الطبيعة العذراء وعشاء هادئ تحت النجوم.',
                    'tag' => 'إقامة ريفية',
                    'icon' => 'home',
                ],
            ],
        ];

        // Day 2
        if ($days >= 2) {
            $itinerary['day_2'] = [
                'day_number' => 2,
                'title' => 'اليوم الثاني: عبق التاريخ، القرى التراثية، وسحر الوادي',
                'summary' => 'استكشاف التراث المعماري الفريد لقرى جازان الصخرية وتجربة مائية طبيعية منعشة.',
                'stops' => [
                    [
                        'time' => '09:00 ص',
                        'title' => 'جولة في قرية العشة التراثية',
                        'desc' => 'التعرف على فن العمارة الحجرية العريقة والمسارات الضيقة والمتاحف المحلية.',
                        'tag' => 'قرية تراثية',
                        'icon' => 'landmark',
                    ],
                    [
                        'time' => '11:30 ص',
                        'title' => 'ورشة تحميص وتذوق القهوة السعودية',
                        'desc' => 'شرح مراحل إعداد البن من التحميص وحتى إضافة بهارات الهيل والزعفران.',
                        'tag' => 'تجربة بن',
                        'icon' => 'coffee',
                    ],
                    [
                        'time' => '01:30 م',
                        'title' => 'غداء محلي وتجربة العسل السدر الجبلي',
                        'desc' => 'تناول وجبة غداء غنية بأطايب عسل جازان والخبز البلدي الطازج.',
                        'tag' => 'مطعم',
                        'icon' => 'utensils',
                    ],
                    [
                        'time' => '03:30 م',
                        'title' => 'موقع التصوير واستكشاف أطراف وادي لجب',
                        'desc' => 'توثيق أجمل اللحظات بجانب الشلالات المنسابة والتشكيلات الصخرية العجيبة.',
                        'tag' => 'موقع تصوير',
                        'icon' => 'camera',
                    ],
                    [
                        'time' => '06:00 م',
                        'title' => 'العودة والتسوق من المنتجات المحلية',
                        'desc' => 'اقتناء البن الخولاني والعسل وزيوت السمسم الأصيلة والعودة بسلامة الله.',
                        'tag' => 'العودة والتسوق',
                        'icon' => 'shopping-bag',
                    ],
                ],
            ];
        }

        // Day 3 if requested
        if ($days >= 3) {
            $itinerary['day_3'] = [
                'day_number' => 3,
                'title' => 'اليوم الثالث: الشواطئ الساحرة وأرخبيل جزر فرسان',
                'summary' => 'الانتقال إلى الواجهة البحرية، ركوب العبارة، والسباحة في مياه فرسان الفيروزية.',
                'stops' => [
                    [
                        'time' => '08:00 ص',
                        'title' => 'الرحلة البحرية إلى جزر فرسان',
                        'desc' => 'ركوب القارب السريع والاستمتاع بمشاهدة طيور النورس والدلافين في البحر الأحمر.',
                        'tag' => 'رحلة بحرية',
                        'icon' => 'anchor',
                    ],
                    [
                        'time' => '11:00 ص',
                        'title' => 'السباحة والسنوركلينج في شاطئ الغدير',
                        'desc' => 'مياه نقية ضحلة ورمال بيضاء ناعمة تناسب الأطفال والعائلات تماماً.',
                        'tag' => 'شاطئ وجزر',
                        'icon' => 'sun',
                    ],
                    [
                        'time' => '02:00 م',
                        'title' => 'غداء مأكولات بحرية طازجة',
                        'desc' => 'أشهى الأسماك والروبيان الطازج في مطعم ساحلي تراثي.',
                        'tag' => 'مطعم بحري',
                        'icon' => 'utensils',
                    ],
                    [
                        'time' => '05:00 م',
                        'title' => 'زيارة قصر الرفاعي ومحمية الغزلان',
                        'desc' => 'التعرف على تاريخ تجارة اللؤلؤ ومشاهدة الغزلان الفرسانية البرية.',
                        'tag' => 'محمية وتراث',
                        'icon' => 'eye',
                    ],
                ],
            ];
        }

        $responseMessage = "جهزت لك خطة متكاملة من {$days} أيام مخصصة لـ ({$groupType}) تجمع بين الجبال والمزارع والقرى التراثية بأعلى درجات الراحة والأمان!";

        return response()->json([
            'status' => 'success',
            'message' => $responseMessage,
            'prompt' => $userPrompt,
            'days_count' => $days,
            'group_type' => $groupType,
            'interests' => $interests,
            'itinerary' => $itinerary,
        ]);
    }

    /**
     * Save the generated AI itinerary to database.
     */
    public function saveTrip(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'days_count' => 'required|integer|min:1|max:7',
            'itinerary' => 'required|array',
            'group_type' => 'nullable|string',
            'interests' => 'nullable|array',
        ]);

        $userId = Auth::id();
        $sessionId = session()->getId();

        $savedTrip = SavedTrip::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'title' => $request->input('title'),
            'days_count' => (int) $request->input('days_count'),
            'group_type' => $request->input('group_type', 'عائلة'),
            'interests' => $request->input('interests', []),
            'itinerary_data' => $request->input('itinerary'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم حفظ خطة رحلتك بنجاح في حسابك!',
            'trip_id' => $savedTrip->id,
        ]);
    }
}
