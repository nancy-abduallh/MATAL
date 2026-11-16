<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Review;
use App\Models\SavedTrip;
use App\Models\TouristRoute;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@matal.sa'],
            [
                'name' => 'إدارة مَطَلّ',
                'phone' => '0501234567',
                'role' => 'admin',
                'avatar' => null,
                'password' => Hash::make('password123'),
            ]
        );

        $tourist = User::firstOrCreate(
            ['email' => 'tourist@matal.sa'],
            [
                'name' => 'عبدالعزيز الفيفي',
                'phone' => '0559876543',
                'role' => 'tourist',
                'avatar' => null,
                'password' => Hash::make('password123'),
            ]
        );

        $guide = User::firstOrCreate(
            ['email' => 'guide@matal.sa'],
            [
                'name' => 'سعيد الريثي',
                'phone' => '0543219876',
                'role' => 'guide',
                'avatar' => null,
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Categories
        $categoriesData = [
            [
                'name' => 'الجبال والمطلات',
                'slug' => 'mountains-and-viewpoints',
                'icon' => 'mountain',
                'description' => 'قمم شاهقة ومناخ معتدل وإطلالات بانورامية بين السحاب في فيفا والداير وهروب.',
                'image' => '/images/al_dharb_viewpoint.jpg',
                'order' => 1,
            ],
            [
                'name' => 'البن والمزارع',
                'slug' => 'coffee-and-farms',
                'icon' => 'coffee',
                'description' => 'مزارع البن الخولاني السعودي العريق والمدرجات الزراعية الخضراء المستدامة.',
                'image' => '/images/coffee_terraces.jpg',
                'order' => 2,
            ],
            [
                'name' => 'البحر والجزر',
                'slug' => 'sea-and-islands',
                'icon' => 'anchor',
                'description' => 'أرخبيل جزر فرسان، الشعاب المرجانية، شواطئ عذراء وتجارب غوص فريدة.',
                'image' => '/images/farasan_islands.jpg',
                'order' => 3,
            ],
            [
                'name' => 'المغامرات والأودية',
                'slug' => 'adventures-and-valleys',
                'icon' => 'compass',
                'description' => 'وادي لجب، مجاري مائية ساحرة وشقوق صخرية وتجارب مشي واستكشاف للمغامرين.',
                'image' => '/images/wadi_lajab.jpg',
                'order' => 4,
            ],
            [
                'name' => 'التراث والحصون',
                'slug' => 'heritage-and-forts',
                'icon' => 'landmark',
                'description' => 'قرى حجرية تاريخية، قلاع حصينة، بيوت العشة التراثية وفنون العمارة الأصيلة.',
                'image' => '/images/heritage_village.jpg',
                'order' => 5,
            ],
            [
                'name' => 'الساحل والشواطئ',
                'slug' => 'coastal-beaches',
                'icon' => 'sun',
                'description' => 'شواطئ رملية خلابة ومياه صافية على امتداد ساحل البحر الأحمر بجازان.',
                'image' => '/images/coastal_beach.jpg',
                'order' => 6,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::firstOrCreate(['slug' => $cData['slug']], $cData);
        }

        // 3. Destinations
        $destinationsData = [
            [
                'category_id' => $categories['heritage-and-forts']->id,
                'title' => 'قرية العشة التراثية',
                'slug' => 'asha-heritage-village',
                'tagline' => 'تراثي · تاريخي · ثقافي',
                'description' => 'قرية تراثية قديمة تتميز ببيوتها الحجرية ومساراتها الضيقة، تعكس تاريخ المنطقة وتراثها المعماري العريق في قلب الطبيعة الجبلية.',
                'story' => 'تعتبر قرية العشة من أقدم التجمعات السكانية التاريخية في جبال جازان، حيث بنيت البيوت من الحجر الجبلي المحلي المصقول يدويًا، بأسقف من خشب العرعر المزخرف. تمثل القرية نموذجاً حياً للتكافل الاجتماعي والذكاء المعماري في التكيف مع تضاريس الجبل والمناخ الماطر.',
                'region' => 'الداير بني مالك',
                'location_name' => 'الداير، جبال آل يحيى، جازان',
                'latitude' => 17.3245,
                'longitude' => 43.1287,
                'image' => '/images/heritage_village.jpg',
                'gallery' => ['/images/heritage_village.jpg', '/images/abadel_fort.jpg', '/images/mountain_terraces.jpg'],
                'best_time' => 'الصباح الباكر',
                'duration' => 'ساعتان',
                'difficulty' => 'متوسط',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'معبد ومفتوح',
                'weather_summary' => 'معتدل ضبابي 21°C',
                'rating' => 4.85,
                'reviews_count' => 256,
                'price' => 45.00,
                'is_featured' => true,
                'tags' => ['تراثي', 'تاريخي', 'ثقافي', 'عمارة جبلية'],
                'facilities' => ['مواقف سيارات', 'مرشد محلي', 'مقهى شعبي', 'دورات مياه', 'متجر حرف يدوية'],
            ],
            [
                'category_id' => $categories['adventures-and-valleys']->id,
                'title' => 'وادي لجب (مسار المغامرات)',
                'slug' => 'wadi-lajab-canyon',
                'tagline' => 'مغامرة · استكشاف · طبيعة بكر',
                'description' => 'شق صخري مائي انكساري ضيق وشاهق يعد من أروع عجائب الطبيعة في المملكة، يتميز بينابيع عذبة ونباتات معلقة وشلالات جارية.',
                'story' => 'يمتد وادي لجب لنحو 11 كيلومتراً بين جبلين شاهقين يرتفعان لمئات الأمتار ويحجبان أشعة الشمس معظم ساعات النهار. يوفر الوادي تجربة مشي مائي فريدة وسط الصخور المنحوتة بفعل المياه الجارية منذ آلاف السنين.',
                'region' => 'الريث',
                'location_name' => 'محافظة الريث، شمال شرق جازان',
                'latitude' => 17.5958,
                'longitude' => 42.9298,
                'image' => '/images/wadi_lajab.jpg',
                'gallery' => ['/images/wadi_lajab.jpg', '/images/valleys_waterways.jpg', '/images/mountain_waterfalls.jpg'],
                'best_time' => 'الصباح الباكر حتى الظهيرة',
                'duration' => 'يوم كامل (4-6 ساعات)',
                'difficulty' => 'صعب',
                'is_family_friendly' => false,
                'has_parking' => true,
                'road_condition' => 'مفتوح (يوصى بسيارات دفع رباعي)',
                'weather_summary' => 'معتدل رطب 25°C',
                'rating' => 4.90,
                'reviews_count' => 380,
                'price' => 120.00,
                'is_featured' => true,
                'tags' => ['مغامرات', 'هايكنج', 'سباحة طبيعية', 'تصوير'],
                'facilities' => ['مواقف سيارات', 'منطقة تجمع', 'معدات أمان وسترات نجاة', 'مرشدين محليين'],
            ],
            [
                'category_id' => $categories['mountains-and-viewpoints']->id,
                'title' => 'جبل حبس ومدرجات فيفا',
                'slug' => 'jabal-habas-and-faifa',
                'tagline' => 'إطلالات بانورامية · فوق السحاب',
                'description' => 'واحدة من أعلى القمم الخضراء في جازان، تكتسي بالمدرجات الزراعية الدائرية والضباب الكثيف، وتطل على أودية خضراء خلابة.',
                'story' => 'يُعرف جبل حبس بجماله الأسطوري وإطلالته الشاملة على قطاع جبال فيفا والداير. شيد أهالي المنطقة مدرجات زراعية هندسية مبهرة تحفظ مياه الأمطار وتزرع فيها أجود أنواع البن والفواكه الاستوائية.',
                'region' => 'الداير وفيفا',
                'location_name' => 'قمة جبل حبس، الداير، جازان',
                'latitude' => 17.2891,
                'longitude' => 43.1612,
                'image' => '/images/mountain_terraces.jpg',
                'gallery' => ['/images/mountain_terraces.jpg', '/images/al_dharb_viewpoint.jpg', '/images/coffee_terraces.jpg'],
                'best_time' => 'العصر ومغيب الشمس',
                'duration' => '3 ساعات',
                'difficulty' => 'متوسط',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'طرق جبلية مسفلتة ومنحدرات',
                'weather_summary' => 'بارد معتدل 18°C',
                'rating' => 4.88,
                'reviews_count' => 210,
                'price' => 30.00,
                'is_featured' => true,
                'tags' => ['مطلات', 'ضباب', 'مدرجات خضراء', 'قهوة مختصة'],
                'facilities' => ['مطل مجهز', 'جلسات عائلية', 'مقهى إطلالة', 'مصلى', 'مواقف'],
            ],
            [
                'category_id' => $categories['sea-and-islands']->id,
                'title' => 'جزر فرسان والشواطئ العذراء',
                'slug' => 'farasan-islands-beaches',
                'tagline' => 'مياه فيروزية · محمية طبيعية · غوص',
                'description' => 'أكبر أرخبيل بحري سياحي في المملكة يضم أكثر من 80 جزيرة بكر، مياه صافية ورمال بيضاء ناعمة ومواقع غوص وشعب مرجانية عالمية.',
                'story' => 'تحتضن فرسان تاريخاً عريقاً كمركز قديم لتجارة اللؤلؤ والعمارة الفرسانية المميزة مثل قصر النجدي ومسجد النجدي، بالإضافة إلى كونها محمية طبيعية لغزلان فرسان والطيور المهاجرة.',
                'region' => 'جزر فرسان',
                'location_name' => 'ميناء فرسان، جزيرة فرسان الكبرى',
                'latitude' => 16.7024,
                'longitude' => 42.1189,
                'image' => '/images/farasan_islands.jpg',
                'gallery' => ['/images/farasan_islands.jpg', '/images/ahbar_islands.jpg', '/images/coastal_beach.jpg'],
                'best_time' => 'الصباح الباكر وحتى الغروب',
                'duration' => 'يومان (رحلة بحرية)',
                'difficulty' => 'سهل',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'عبّارة بحرية وسيارات داخل الجزيرة',
                'weather_summary' => 'دافئ منعش 26°C',
                'rating' => 4.92,
                'reviews_count' => 415,
                'price' => 180.00,
                'is_featured' => true,
                'tags' => ['جزر بكر', 'غوص', 'رحلات بحرية', 'محمية غزلان'],
                'facilities' => ['قوارب سريعة', 'معدات غوص وسنوركلينج', 'نزل ساحلية', 'مطاعم سمك طازج'],
            ],
            [
                'category_id' => $categories['coastal-beaches']->id,
                'title' => 'شواطئ جازان والكورنيش الشمالي',
                'slug' => 'jazan-coastal-beaches',
                'tagline' => 'رمال ذهبية · نسيم عليل · نزهات عائلية',
                'description' => 'واجهات بحرية عصرية تضم حدائق ممتدة، مسارات مشي وركوب دراجات، وجلسات هادئة على سواحل البحر الأحمر المزدانة بأشجار النخيل.',
                'story' => 'يعد كورنيش جازان المتنفس الأول للعائلات والزوار، حيث يلتقي شاطئ البحر بمساحات خضراء شاسعة ومرافق ترفيهية متكاملة تقدم أشهى مأكولات الأسماك المشوية على الطريقة الجازانية الأصيلة.',
                'region' => 'مدينة جازان',
                'location_name' => 'طريق الكورنيش الشمالي، مدينة جازان',
                'latitude' => 16.9082,
                'longitude' => 42.5451,
                'image' => '/images/coastal_beach.jpg',
                'gallery' => ['/images/coastal_beach.jpg', '/images/sunset_marine.jpg', '/images/ahbar_islands.jpg'],
                'best_time' => 'عصراً وحتى منتصف الليل',
                'duration' => '3 ساعات',
                'difficulty' => 'سهل',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'طرق سريعة مجهزة بالكامل',
                'weather_summary' => 'معتدل بحري 27°C',
                'rating' => 4.75,
                'reviews_count' => 195,
                'price' => 0.00,
                'is_featured' => true,
                'tags' => ['شاطئ', 'عائلي', 'ممشى بحري', 'مطاعم أسماك'],
                'facilities' => ['مواقف مجانية', 'جلسات مظللة', 'ألعاب أطفال', 'مقاهي ومطاعم'],
            ],
            [
                'category_id' => $categories['coffee-and-farms']->id,
                'title' => 'مزارع البن الخولاني بجبال الداير',
                'slug' => 'khawlani-coffee-farms',
                'tagline' => 'من الشجرة إلى الفنجان · تراث عالمي',
                'description' => 'مزارع بن أصيلة في أعالي الجبال تم تصنيف زراعتها ضمن قائمة التراث الإنساني لليونسكو، تقدم تجارب قطاف وتحميص حية.',
                'story' => 'توارث مزارعو الداير وبني مالك زراعة شجرة البن الخولاني لمئات السنين على ارتفاعات تزيد عن 1800 متر فوق سطح البحر. تجربة مزارع البن ليست مجرد زيارة، بل معايشة ثقافية تفاعلية تبدأ من حصاد الثمار الحمراء وتنتهي برشفة القهوة السعودية الفاخرة.',
                'region' => 'محافظة الداير',
                'location_name' => 'قرى آل يحيى وآل تليد، الداير، جازان',
                'latitude' => 17.3389,
                'longitude' => 43.1550,
                'image' => '/images/coffee_terraces.jpg',
                'gallery' => ['/images/coffee_terraces.jpg', '/images/mountain_terraces.jpg', '/images/al_dharb_viewpoint.jpg'],
                'best_time' => 'موسم الحصاد (أكتوبر - فبراير)',
                'duration' => '4 ساعات',
                'difficulty' => 'متوسط',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'جبلي ممهد',
                'weather_summary' => 'منعش 20°C',
                'rating' => 4.95,
                'reviews_count' => 312,
                'price' => 95.00,
                'is_featured' => true,
                'tags' => ['بن خولاني', 'حصاد تفاعلي', 'مدرجات زراعية', 'يونسكو'],
                'facilities' => ['ورشة تحميص وتذوق', 'متجر بن مباشر', 'جلسات جبلية', 'مرشد مزارع محلي'],
            ],
            [
                'category_id' => $categories['sea-and-islands']->id,
                'title' => 'جزيرة أحبار وجزيرة دراكة',
                'slug' => 'ahbar-and-darakah-islands',
                'tagline' => 'جزر الأحلام · طيور نورس وشعاب مرجانية',
                'description' => 'جزر سياحية قريبة من شواطئ جازان تم تجهيزها بمظلات وجلسات عائلية وأرصفة قوارب وشواطئ رملية نقية لممارسة السباحة والسنوركلينج.',
                'story' => 'تبعد جزيرة أحبار 15 كيلومتراً فقط عن ميناء جازان، وتتميز بطبيعتها البكر وهدوئها التام، حيث يمكنك مشاهدة السلاحف البحرية وأسراب طيور النورس وتناول وجبة الغداء البحرية على الشاطئ.',
                'region' => 'جازان البحرية',
                'location_name' => 'قبالة سواحل مدينة جازان',
                'latitude' => 16.8920,
                'longitude' => 42.4200,
                'image' => '/images/ahbar_islands.jpg',
                'gallery' => ['/images/ahbar_islands.jpg', '/images/sunset_marine.jpg', '/images/coastal_beach.jpg'],
                'best_time' => 'من 9 صباحاً حتى 5 عصراً',
                'duration' => 'يوم كامل',
                'difficulty' => 'سهل',
                'is_family_friendly' => true,
                'has_parking' => false,
                'road_condition' => 'رحلة بالقارب السريع 25 دقيقة',
                'weather_summary' => 'مشمس معتدل 26°C',
                'rating' => 4.82,
                'reviews_count' => 140,
                'price' => 110.00,
                'is_featured' => false,
                'tags' => ['جزر قريبة', 'سباحة', 'قوارب', 'نزهة بحرية'],
                'facilities' => ['مظلات شاطئية', 'مرافق سباحة', 'قوارب نقل دورية', 'كافتيريا'],
            ],
            [
                'category_id' => $categories['mountains-and-viewpoints']->id,
                'title' => 'مطل الدرب في الريث',
                'slug' => 'al-dharb-viewpoint-reeth',
                'tagline' => 'إطلالة بانورامية · أودية وجبال شاهقة',
                'description' => 'مطل استراتيجي يمنحك رؤية 360 درجة لسلاسل جبال القهر ووادي لجب والأودية الخضراء السحيقة في مشهد يأسر القلوب.',
                'story' => 'يشكل مطل الدرب محطة الاستراحة المثالية للمسافرين المتجهين نحو محافظة الريث ووادي لجب، حيث الهواء العليل والمقاهي التي تقدم القهوة والشاي بالحبق الجبلي.',
                'region' => 'محافظة الريث',
                'location_name' => 'طريق الريث الجبلي، جازان',
                'latitude' => 17.5120,
                'longitude' => 42.9811,
                'image' => '/images/al_dharb_viewpoint.jpg',
                'gallery' => ['/images/al_dharb_viewpoint.jpg', '/images/wadi_lajab.jpg', '/images/mountain_waterfalls.jpg'],
                'best_time' => 'وقت الشروق والغروب',
                'duration' => 'ساعة ونصف',
                'difficulty' => 'سهل',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'مسفلت وسلس',
                'weather_summary' => 'معتدل 22°C',
                'rating' => 4.86,
                'reviews_count' => 168,
                'price' => 0.00,
                'is_featured' => false,
                'tags' => ['مطل', 'تصوير', 'استراحة جبلية', 'قهوة'],
                'facilities' => ['مواقف سيارات', 'جلسات مظللة', 'مقهى متنقل', 'إنارة ليلية'],
            ],
            [
                'category_id' => $categories['heritage-and-forts']->id,
                'title' => 'حصن الأبادل التاريخي',
                'slug' => 'abadel-fort',
                'tagline' => 'عمارة حربية · أصالة وتاريخ',
                'description' => 'حصن جبلي تاريخي شيد على نتوء صخري شاهق، شواهد حية على براعة البناء العسكري والحراسة في جبال جازان.',
                'story' => 'يعد حصن الأبادل من أهم المعالم التاريخية التي تقف شامخة في أعالي قمم جازان، محتفظاً بتفاصيله المعمارية الحجرية وإطلالته المهيبة على سهول تهامة والأودية المجاورة.',
                'region' => 'الداير بني مالك',
                'location_name' => 'قمة جبل الأبادل، جازان',
                'latitude' => 17.3100,
                'longitude' => 43.1400,
                'image' => '/images/abadel_fort.jpg',
                'gallery' => ['/images/abadel_fort.jpg', '/images/heritage_village.jpg'],
                'best_time' => 'الصباح والعصر',
                'duration' => 'ساعتان',
                'difficulty' => 'سهل',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'معبد ومتاح',
                'weather_summary' => 'معتدل 23°C',
                'rating' => 4.87,
                'reviews_count' => 142,
                'price' => 35.00,
                'is_featured' => true,
                'tags' => ['حصن', 'تاريخ', 'عمارة حجرية', 'إطلالة'],
                'facilities' => ['مواقف', 'مرشد محلي', 'منصة تصوير'],
            ],
            [
                'category_id' => $categories['adventures-and-valleys']->id,
                'title' => 'شلالات ومجاري أودية جازان',
                'slug' => 'jazan-waterfalls',
                'tagline' => 'طبيعة عذراء · مياه متدفقة · خضرة دائمة',
                'description' => 'شلالات طبيعية مبهجة تتدفق بين الجبال والمدرجات الخضراء وتصب في برك صخرية صافية تحفها النباتات العطرية.',
                'story' => 'تزخر جبال وأودية جازان بينابيع وشلالات دائمة وموسمية تغذيها الأمطار الغزيرة، مانحة المنطقة طبيعة ساحرة ومناخاً استوائياً فريداً يشبه الجنان الاستوائية.',
                'region' => 'هروب وفيفا',
                'location_name' => 'أودية هروب وفيفا، جازان',
                'latitude' => 17.3800,
                'longitude' => 43.0500,
                'image' => '/images/mountain_waterfalls.jpg',
                'gallery' => ['/images/mountain_waterfalls.jpg', '/images/valleys_waterways.jpg', '/images/wadi_lajab.jpg'],
                'best_time' => 'الصباح الباكر',
                'duration' => '3 ساعات',
                'difficulty' => 'متوسط',
                'is_family_friendly' => true,
                'has_parking' => true,
                'road_condition' => 'طريق جبلي معبد مع ممشى ترابي',
                'weather_summary' => 'منعش ماطر 22°C',
                'rating' => 4.91,
                'reviews_count' => 198,
                'price' => 0.00,
                'is_featured' => true,
                'tags' => ['شلالات', 'أودية', 'طبيعة', 'سباحة طبيعية'],
                'facilities' => ['مواقف', 'جلسات طبيعية', 'مناطق تنزه'],
            ],
        ];

        foreach ($destinationsData as $dData) {
            Destination::firstOrCreate(['slug' => $dData['slug']], $dData);
        }

        // 4. Tourist Routes (The 6 Signature Routes from PDF)
        $routesData = [
            [
                'title' => 'مسار الجبال والمطلات',
                'slug' => 'mountains-viewpoints-route',
                'badge' => '01',
                'category' => 'الجبال والمطلات',
                'subtitle' => 'رحلة عبر القمم والمشاهد الخلابة بين السحاب',
                'description' => 'مسار شامل يربط أجمل قمم جازان الخضراء ومطلاتها الساحرة عبر الداير وفيفا والعارضة وهروب والريث. استمتع بالمناخ المعتدل والمدرجات الزراعية والبيوت الحجرية القديمة.',
                'days_count' => 3,
                'duration_text' => '3 أيام',
                'difficulty' => 'متوسط',
                'rating' => 4.88,
                'reviews_count' => 184,
                'price' => 480.00,
                'image' => '/images/al_dharb_viewpoint.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'جبل حبس ومطلاته', 'desc' => 'الانطلاق وصعود القمة مع إطلالة الصباح الباكر', 'icon' => 'mountain'],
                    ['step' => 2, 'title' => 'موقع ومتحف تراثي', 'desc' => 'استكشاف الهندسة المعمارية الحجرية والمقتنيات التراثية', 'icon' => 'landmark'],
                    ['step' => 3, 'title' => 'مزرعة البن الخولاني', 'desc' => 'جولة في مدرجات البن والتعرف على الزراعة الجبلية', 'icon' => 'coffee'],
                    ['step' => 4, 'title' => 'قرية جبلية أصيلة', 'desc' => 'الاحتكاك بالأهالي والتعرف على كرم الضيافة وعادات الجبل', 'icon' => 'home'],
                    ['step' => 5, 'title' => 'مقهى بإطلالة جبلية', 'desc' => 'استراحة مع القهوة السعودية والتمر في أعلى القمم', 'icon' => 'coffee'],
                    ['step' => 6, 'title' => 'مطل الريث البانورامي', 'desc' => 'مشاهدة مغيب الشمس وتداخل السحاب مع سلاسل الجبال', 'icon' => 'sun'],
                    ['step' => 7, 'title' => 'إقامة في نزل ريفي جبلي', 'desc' => 'راحة ونوم هادئ في كوخ ريفي وسط الطبيعة النقية', 'icon' => 'bed'],
                ],
                'highlights' => [
                    'زيارة 4 محافظات جبلية (فيفا، الداير، الريث، هروب)',
                    'إطلالات بانورامية على ارتفاع يزيد عن 2000 متر',
                    'تجربة القهوة الخولانية في موطنها الأصلي',
                    'إقامة ليلتين في نزل ريفي جبلي فاخر',
                ],
                'included_services' => [
                    'سيارة دفع رباعي مريحة مع سائق خبير بالطرق الجبلية',
                    'مرشد سياحي مرخص معتمد من هيئة السياحة',
                    'جميع الوجبات الشعبية الطازجة والمشروبات',
                    'تذاكر المتاحف والتجارب التفاعلية',
                ],
                'is_featured' => true,
            ],
            [
                'title' => 'مسار البن السعودي',
                'slug' => 'saudi-coffee-route',
                'badge' => '02',
                'category' => 'البن السعودي',
                'subtitle' => 'من المزرعة إلى الفنجان: تجربة حسية وثقافية أصيلة',
                'description' => 'رحلة تفاعلية حصرية تقودك إلى مزارع البن الخولاني المدرجة في اليونسكو بجبال الداير. شارك المزارعين قطاف الثمار، وشاهد التحميص التقليدي واستمتع بتذوق القهوة السعودية الفاخرة.',
                'days_count' => 1,
                'duration_text' => 'يوم واحد',
                'difficulty' => 'سهل',
                'rating' => 4.95,
                'reviews_count' => 240,
                'price' => 195.00,
                'image' => '/images/coffee_terraces.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'الوصول إلى مزرعة بن جازان', 'desc' => 'استقبال تقليدي وارتداء الزي التراثي وحزام النباتات العطرية', 'icon' => 'map-pin'],
                    ['step' => 2, 'title' => 'تجربة زراعة وحصاد البن', 'desc' => 'قطاف حبات البن الحمراء الناضجة بأيديكم مع إرشادات المزارع', 'icon' => 'check-circle'],
                    ['step' => 3, 'title' => 'معمل التقشير والتجفيف', 'desc' => 'متابعة مراحل تجفيف الحبوب تحت أشعة شمس الجبال الصافية', 'icon' => 'sun'],
                    ['step' => 4, 'title' => 'ورشة التحميص والطحن', 'desc' => 'تحميص حبات البن وإضافة الهيل والزعفران والمستكة', 'icon' => 'flame'],
                    ['step' => 5, 'title' => 'جلسة تذوق القهوة السعودية', 'desc' => 'تذوق درجات التحميص المختلفة في مقهى المزرعة البانورامي', 'icon' => 'coffee'],
                    ['step' => 6, 'title' => 'متجر منتجات البن والعسل', 'desc' => 'اقتناء عبوات بن خولاني طازج وعسل جبلي أصيل', 'icon' => 'shopping-bag'],
                ],
                'highlights' => [
                    'معايشة حية لتراث اليونسكو للبن الخولاني',
                    'الحصول على كيس بن خولاني فاخر هدية تذكارية',
                    'ضيافة جازانية متكاملة تشمل الأكلات الشعبية الشهيرة',
                ],
                'included_services' => [
                    'مرشد مزارع محلي متخصص في البن',
                    'ورشة عمل التحميص والتذوق الكاملة',
                    'وجبة غداء تراثية في المزرعة',
                    'مواصلات مخصصة من مركز المحافظة',
                ],
                'is_featured' => true,
            ],
            [
                'title' => 'المسار التراثي والثقافي',
                'slug' => 'heritage-and-culture-route',
                'badge' => '03',
                'category' => 'التراثي',
                'subtitle' => 'قصص التاريخ، القلاع الحصينة، وفنون العمارة الأصيلة',
                'description' => 'اكتشف عبق الماضي وعراقة الأجداد في جازان، من قلعة الدوسرية التاريخية المطلة على البحر إلى القرى الحجرية والبيوت المزينة بالنقوش، مع قصص وحكايات صوتية مشوقة.',
                'days_count' => 1,
                'duration_text' => 'يوم واحد',
                'difficulty' => 'متوسط',
                'rating' => 4.80,
                'reviews_count' => 135,
                'price' => 160.00,
                'image' => '/images/heritage_village.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'قلعة الدوسرية الأثرية', 'desc' => 'استكشاف الحصن العسكري التاريخي وإطلالته على البحر والمدينة', 'icon' => 'shield'],
                    ['step' => 2, 'title' => 'قرية العشة الحجرية', 'desc' => 'جولة بين المنازل الصخرية والممرات المعمارية العتيقة', 'icon' => 'home'],
                    ['step' => 3, 'title' => 'متحف الآثار والحلي الشعبية', 'desc' => 'مشاهدة الأزياء التراثية، الأواني الفخارية، والأسلحة القديمة', 'icon' => 'archive'],
                    ['step' => 4, 'title' => 'سوق الحرف اليدوية والفخار', 'desc' => 'لقاء كبار الحرفيين ومشاهدة صناعة الأواني وسلال الخوص', 'icon' => 'gift'],
                    ['step' => 5, 'title' => 'مطعم شعبي للأكلات التقليدية', 'desc' => 'تذوق المغش والخمير والمرسة والعصيدة الجازانية الأصيلة', 'icon' => 'utensils'],
                ],
                'highlights' => [
                    'دليل صوتي ذكي يروي تاريخ كل موقع بالواقع المعزز',
                    'زيارة 3 متاحف وقلاع معمارية نادرة',
                    'تجربة تذوق الأكلات الشعبية في تنور الحطب التقليدي',
                ],
                'included_services' => [
                    'مرشد مؤرخ محلي',
                    'تذاكر دخول كافة القلاع والمتاحف',
                    'وجبة غداء شعبية فاخرة',
                ],
                'is_featured' => true,
            ],
            [
                'title' => 'المسار البحري · جزر فرسان',
                'slug' => 'farasan-marine-route',
                'badge' => '04',
                'category' => 'البحري',
                'subtitle' => 'رحلة بحرية، جزر عذراء، وحياة بحرية استثنائية',
                'description' => 'انطلق في مغامرة بحرية عبر مياه البحر الأحمر الصافية إلى جزر فرسان، حيث المياه التركوازية، محميات الغزلان النادرة، بيوت تجار اللؤلؤ، وغروب الشمس الساحر.',
                'days_count' => 2,
                'duration_text' => 'يومان',
                'difficulty' => 'سهل',
                'rating' => 4.90,
                'reviews_count' => 290,
                'price' => 390.00,
                'image' => '/images/farasan_islands.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'الانطلاق من ميناء جازان', 'desc' => 'ركوب العبارة أو اليخت السريع نحو أرخبيل فرسان', 'icon' => 'navigation'],
                    ['step' => 2, 'title' => 'شاطئ الغدير وجزيرة زفاف', 'desc' => 'نزول في الشواطئ البيضاء الناعمة والسباحة في مياه تركوازية', 'icon' => 'sun'],
                    ['step' => 3, 'title' => 'سنوركلينج وغوص المرجان', 'desc' => 'مشاهدة الشعاب المرجانية الزاهية والأسماك النادرة وسلاحف البحر', 'icon' => 'eye'],
                    ['step' => 4, 'title' => 'محمية غزلان فرسان الطبيعية', 'desc' => 'جولة سفاري لمشاهدة الغزال الفرساني المهدد بالانقراض في بيئته', 'icon' => 'heart'],
                    ['step' => 5, 'title' => 'حي القصار وقصر الرفاعي التراثي', 'desc' => 'اكتشاف عمارة تجار اللؤلؤ بالجبس المنقوش بالحرفية الباهرة', 'icon' => 'landmark'],
                    ['step' => 6, 'title' => 'عشاء مأكولات بحرية طازجة', 'desc' => 'سمك شعور وهوامير طازجة مشوية على الجمر مع الخبز البلدي', 'icon' => 'utensils'],
                ],
                'highlights' => [
                    'تذكرة يخت سريع ذهاباً وإياباً مع قارب خاص للجزر البكر',
                    'معدات سنوركلينج متكاملة ومرافق سباحة آمنة',
                    'إقامة ليلة واحدة في منتجع ساحلي فاخر بفرسان',
                ],
                'included_services' => [
                    'تذاكر النقل البحري واليخوت',
                    'إقامة فندقية ليلة واحدة مع إفطار',
                    'مدرب غوص ومرشد بحري مرخص',
                    'وجبة عشاء بحرية فاخرة',
                ],
                'is_featured' => true,
            ],
            [
                'title' => 'مسار المغامرات · وادي لجب',
                'slug' => 'wadi-lajab-adventure-route',
                'badge' => '05',
                'category' => 'المغامرات',
                'subtitle' => 'مشي واستكشاف وتصوير وسط شقوق الصخور الشاهقة',
                'description' => 'مسار عشاق الإثارة والمغامرة في وادي لجب الانكساري الشهير بالريث. خوض التحدي سيراً وسط مجرى المياه العذبة، تسلق ممر صخري ضيق، واستمتع برذاذ الشلالات المنهمرة من القمم.',
                'days_count' => 1,
                'duration_text' => 'يوم واحد',
                'difficulty' => 'صعب',
                'rating' => 4.92,
                'reviews_count' => 320,
                'price' => 220.00,
                'image' => '/images/wadi_lajab.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'نقطة الانطلاق والتجهيز بالريث', 'desc' => 'استلام سترات النجاة وأحذية المشي المائي وتعليمات السلامة', 'icon' => 'shield'],
                    ['step' => 2, 'title' => 'دخول الشق الصخري العظيم', 'desc' => 'المسير بين جدارين صخريين شاهقين يحجبان السماء', 'icon' => 'map-pin'],
                    ['step' => 3, 'title' => 'شلالات لجب والبرك الطبيعية', 'desc' => 'السباحة في أحواض صخرية نقية ذات مياه جارية منعشة', 'icon' => 'droplet'],
                    ['step' => 4, 'title' => 'الحديقة المعلقة في قلب الصخر', 'desc' => 'تصوير الأشجار المعلقة في الفراغ الصخري العجيب', 'icon' => 'camera'],
                    ['step' => 5, 'title' => 'مطل الريث واستراحة القهوة', 'desc' => 'الصعود إلى المطل للاسترخاء وتبادل الصور وتناول وجبة الغداء', 'icon' => 'coffee'],
                ],
                'highlights' => [
                    'تجربة مغامرة مائية وصخرية مصنفة عالمياً',
                    'فريق إنقاذ ومرشدون متخصصون بالطرق الجبلية الوعرة',
                    'جلسة تصوير فوتوغرافي احترافية لتوثيق المغامرة',
                ],
                'included_services' => [
                    'معدات سلامة كاملة (خوذات، سترات نجاة، حقائب ضد الماء)',
                    'سيارات دفع رباعي للنقل من وإلى الوادي',
                    'مرشد هايكنج معتمد مع إسعافات أولية',
                    'وجبة طاقة وغداء جبلي متكامل',
                ],
                'is_featured' => true,
            ],
            [
                'title' => 'المسار العائلي الترفيهي',
                'slug' => 'family-entertainment-route',
                'badge' => '06',
                'category' => 'العائلي',
                'subtitle' => 'أمان، راحة، حدائق شاطئية ومرح لجميع الأعمار',
                'description' => 'مسار مصمم خصيصاً للعائلات والأطفال يجمع بين الشواطئ الآمنة، الحدائق الواسعة، الممشى البحري، الفعاليات الترفيهية، والمطاعم ذات الإطلالات الساحرة.',
                'days_count' => 1,
                'duration_text' => 'يوم واحد',
                'difficulty' => 'سهل',
                'rating' => 4.82,
                'reviews_count' => 210,
                'price' => 140.00,
                'image' => '/images/sunset_marine.jpg',
                'stops' => [
                    ['step' => 1, 'title' => 'منتزه الكورنيش الشمالي والحديقة', 'desc' => 'جلسات مظللة ومسطحات خضراء وألعاب آمنة للأطفال', 'icon' => 'sun'],
                    ['step' => 2, 'title' => 'مطعم مأكولات بحرية عائلي', 'desc' => 'أشهى المأكولات في كبائن خاصة بإطلالة بانورامية على البحر', 'icon' => 'utensils'],
                    ['step' => 3, 'title' => 'جولة الممشى البحري وتأجير الدراجات', 'desc' => 'نشاط حركي ممتع لجميع أفراد الأسرة بمحاذاة الشاطئ', 'icon' => 'activity'],
                    ['step' => 4, 'title' => 'حضور فعاليات مهرجان جازان', 'desc' => 'عروض مسرحية وأركان ترفيهية للأطفال وحرف يدوية', 'icon' => 'smile'],
                    ['step' => 5, 'title' => 'مقهى الكورنيش وغروب الشمس', 'desc' => 'حلويات وعصائر طازجة والاستمتاع بنسيم البحر المنعش', 'icon' => 'coffee'],
                ],
                'highlights' => [
                    'مسار آمن ومناسب لعربات الأطفال وكبار السن',
                    'تنوع متكامل بين الترفيه والطبيعة والطعام اللذيذ',
                    'خدمة نقل عائلية مريحة مع مقاعد أطفال',
                ],
                'included_services' => [
                    'نقل عائلي خاص مريح ومكيف',
                    'حجوزات جلسات VIP في المطاعم والفعاليات',
                    'وجبة غداء أو عشاء عائلية متكاملة',
                ],
                'is_featured' => true,
            ],
        ];

        $routes = [];
        foreach ($routesData as $rData) {
            $routes[$rData['slug']] = TouristRoute::firstOrCreate(['slug' => $rData['slug']], $rData);
        }

        // 5. Events
        $eventsData = [
            [
                'title' => 'مهرجان البن الخولاني السعودي الدولي',
                'slug' => 'khawlani-coffee-festival',
                'category' => 'زراعية وتراثية',
                'date_start' => now()->addDays(5)->toDateString(),
                'date_end' => now()->addDays(15)->toDateString(),
                'date_text' => '20 - 30 نوفمبر',
                'location' => 'محافظة الداير بني مالك، ساحة المهرجان الجبلية',
                'price' => 25.00,
                'image' => '/images/coffee_terraces.jpg',
                'description' => 'المهرجان الأبرز على مستوى المملكة للاحتفاء بمنتج البن الخولاني السعودي المصنف في اليونسكو، بمشاركة أكثر من 200 مزارع وعروض شعبية وورش تذوق القهوة المختصة.',
                'is_featured' => true,
                'tickets_available' => 250,
            ],
            [
                'title' => 'مهرجان شتاء جازان (أجمل دفء)',
                'slug' => 'jazan-winter-festival',
                'category' => 'عائلية وترفيهية',
                'date_start' => now()->addDays(12)->toDateString(),
                'date_end' => now()->addDays(40)->toDateString(),
                'date_text' => '1 ديسمبر - 15 يناير',
                'location' => 'القرية التراثية، الكورنيش الجنوبي، جازان',
                'price' => 0.00,
                'image' => '/images/coastal_beach.jpg',
                'description' => 'كرنفال شتوي ضخم يجمع الفلكلور الجازاني، عروض الدرونز والألعاب النارية، القرية الحرفية، ومسارح الفنون في أجواء شتوية دافئة وساحرة على الشاطئ.',
                'is_featured' => true,
                'tickets_available' => 500,
            ],
            [
                'title' => 'موسم استكشاف وغوص جزر فرسان',
                'slug' => 'farasan-diving-season',
                'category' => 'بحرية ومغامرات',
                'date_start' => now()->addDays(8)->toDateString(),
                'date_end' => now()->addDays(28)->toDateString(),
                'date_text' => '25 نوفمبر - 15 ديسمبر',
                'location' => 'مارينا فرسان، مرسى شاطئ الغدير',
                'price' => 150.00,
                'image' => '/images/farasan_islands.jpg',
                'description' => 'موسم غوص وبطولات صيد ومغامرات بحرية تحت إشراف مدربين عالميين لاستكشاف شعاب المرجان والسلاحف وأسماك القرش النمرية في أعماق البحر الأحمر.',
                'is_featured' => true,
                'tickets_available' => 80,
            ],
            [
                'title' => 'تحدي هايكنج وادي لجب الجبلي',
                'slug' => 'lajab-canyon-hiking-challenge',
                'category' => 'رياضية ومغامرات',
                'date_start' => now()->addDays(18)->toDateString(),
                'date_end' => now()->addDays(19)->toDateString(),
                'date_text' => '5 - 6 ديسمبر',
                'location' => 'وادي لجب، محافظة الريث',
                'price' => 90.00,
                'image' => '/images/wadi_lajab.jpg',
                'description' => 'تحدي هايكنج ومسابقات مشي مائي واستكشاف الشقوق الصخرية للمغامرين وهواة الرياضات الجبلية مع جلسات تصوير وتخييم ليلي في المطلات.',
                'is_featured' => false,
                'tickets_available' => 60,
            ],
        ];

        foreach ($eventsData as $eData) {
            Event::firstOrCreate(['slug' => $eData['slug']], $eData);
        }

        // 6. Bookings (Realistic demo bookings)
        $route1 = TouristRoute::where('slug', 'mountains-viewpoints-route')->first();
        $dest1 = Destination::where('slug', 'asha-heritage-village')->first();

        Booking::firstOrCreate(
            ['booking_code' => 'MTL-89421'],
            [
                'user_id' => $tourist->id,
                'bookable_type' => TouristRoute::class,
                'bookable_id' => $route1->id,
                'customer_name' => 'عبدالعزيز الفيفي',
                'customer_phone' => '0559876543',
                'customer_email' => 'tourist@matal.sa',
                'trip_date' => now()->addDays(7)->toDateString(),
                'adults_count' => 2,
                'children_count' => 1,
                'total_price' => 960.00,
                'payment_method' => 'mada',
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'selected_addons' => ['مرشد سياحي جبلي محلي', 'تجربة تذوق البن الخولاني'],
                'notes' => 'نرجو تجهيز سيارة دفع رباعي بمقاعد أطفال.',
                'qr_code' => 'MTL-QR-89421-CONFIRMED',
            ]
        );

        Booking::firstOrCreate(
            ['booking_code' => 'MTL-32104'],
            [
                'user_id' => $tourist->id,
                'bookable_type' => Destination::class,
                'bookable_id' => $dest1->id,
                'customer_name' => 'عبدالعزيز الفيفي',
                'customer_phone' => '0559876543',
                'customer_email' => 'tourist@matal.sa',
                'trip_date' => now()->addDays(14)->toDateString(),
                'adults_count' => 4,
                'children_count' => 0,
                'total_price' => 180.00,
                'payment_method' => 'apple_pay',
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'selected_addons' => ['دليل صوتي ذكي بالواقع المعزز'],
                'notes' => 'زيارة عائلية في الصباح الباكر.',
                'qr_code' => 'MTL-QR-32104-CONFIRMED',
            ]
        );

        // 7. Reviews
        $sampleReviews = [
            [
                'destination_id' => $dest1->id,
                'tourist_route_id' => null,
                'user_id' => $tourist->id,
                'author_name' => 'محمد السبيعي',
                'rating' => 5,
                'comment' => 'تجربة لا تنسى في قرية العشة التراثية! العمارة الحجرية مبهرة وكرم أهل جازان يجعلك تشعر أنك بين أهلك. الدليل السياحي كان رائعاً وشرح لنا تفاصيل تاريخية مدهشة.',
                'is_approved' => true,
            ],
            [
                'destination_id' => $dest1->id,
                'tourist_route_id' => null,
                'user_id' => null,
                'author_name' => 'سارة الحربي',
                'rating' => 5,
                'comment' => 'المكان ساحر خصوصاً مع الضباب في الصباح الباكر، والمقهى التراثي يقدم ألذ قهوة سعودية تذوقتها بحياتي. المنصة سهلت علينا كل شيء من الحجز حتى الوصول.',
                'is_approved' => true,
            ],
            [
                'destination_id' => null,
                'tourist_route_id' => $route1->id,
                'user_id' => $tourist->id,
                'author_name' => 'خالد بن ناصر',
                'rating' => 5,
                'comment' => 'مسار الجبال والمطلات منظم بأعلى درجات الاحترافية. سيارة الدفع الرباعي مريحة والمرشد سعيد يعرف كل شبر في جبال فيفا والداير. أنصح الجميع بتجربته!',
                'is_approved' => true,
            ],
        ];

        foreach ($sampleReviews as $rev) {
            Review::firstOrCreate([
                'author_name' => $rev['author_name'],
                'comment' => $rev['comment'],
            ], $rev);
        }

        // 8. Saved Trip for user
        SavedTrip::firstOrCreate(
            ['title' => 'رحلتي العائلية في جبال وطبيعة جازان'],
            [
                'user_id' => $tourist->id,
                'days_count' => 2,
                'group_type' => 'عائلة مع أطفال',
                'interests' => ['جبال ومطلات', 'مزارع بن', 'أكلات شعبية', 'قرى تراثية'],
                'itinerary_data' => [
                    'day_1' => [
                        'title' => 'اليوم الأول: سحر القمم ومدرجات البن',
                        'stops' => [
                            ['time' => '08:30 ص', 'place' => 'الانطلاق من الفندق والصعود إلى قمة جبل حبس', 'tag' => 'مطل'],
                            ['time' => '11:00 ص', 'place' => 'جولة في مزرعة البن وتجربة قطاف الحبوب', 'tag' => 'مزرعة'],
                            ['time' => '01:30 م', 'place' => 'غداء شعبي (مغش ومرسة) في مطعم جبلي', 'tag' => 'غداء'],
                            ['time' => '04:30 م', 'place' => 'استراحة في مقهى مطل الدرب والتقاط الصور مع الغروب', 'tag' => 'مقهى'],
                            ['time' => '07:30 م', 'place' => 'الوصول إلى النزل الريفي الجبلي والمبيت وسط الضباب', 'tag' => 'إقامة'],
                        ],
                    ],
                    'day_2' => [
                        'title' => 'اليوم الثاني: عبق التاريخ وتراث الأجداد',
                        'stops' => [
                            ['time' => '09:00 ص', 'place' => 'استكشاف قرية العشة التراثية ومساراتها الحجرية', 'tag' => 'تراث'],
                            ['time' => '11:30 ص', 'place' => 'ورشة تحميص وتذوق القهوة السعودية الفاخرة', 'tag' => 'قهوة'],
                            ['time' => '01:30 م', 'place' => 'وجبة غداء وتجربة العسل الجبلي الأصيل', 'tag' => 'مطعم'],
                            ['time' => '03:30 م', 'place' => 'محطة التصوير البانورامي التذكاري', 'tag' => 'تصوير'],
                            ['time' => '05:30 م', 'place' => 'النزول الآمن واختتام الرحلة السعيدة', 'tag' => 'عودة'],
                        ],
                    ],
                ],
            ]
        );

        // 9. Sample Contact message
        Contact::firstOrCreate(
            ['email' => 'partner@jazaninvest.sa'],
            [
                'name' => 'فهد القحطاني',
                'phone' => '0505554321',
                'subject' => 'طلب الانضمام كشريك نزل ريفي في فيفا',
                'message' => 'السلام عليكم، لدينا مجمع نزل ريفية بيئية في جبال فيفا ونرغب في إدراجها ضمن مسارات منصة مَطَلّ السياحية وتفعيل الحجز المباشر.',
                'is_read' => false,
            ]
        );
    }
}
