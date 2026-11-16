@extends('layouts.app')

@section('title', 'من نحن وتواصل معنا · مَطَلّ جازان')
@section('meta_description', 'تعرف على رؤية ورسالة منصة مَطَلّ الرقمية لاكتشاف مقومات جازان السياحية، وشبكة الشركاء المعتمدين.')

@section('content')

<!-- Hero Banner matching About + Contact.png -->
<section class="relative py-28 bg-cover bg-center text-white" style="background-image: url('/images/mountain_terraces.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            من نحن
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            منصة رقمية لاكتشاف جازان من أعاليها إلى سواحلها.
        </p>
    </div>
</section>

<!-- Vision & Mission Section matching About + Contact.png -->
<section class="py-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
    
    <div class="text-center space-y-3 mb-14">
        <h2 class="text-3xl sm:text-4xl font-black text-[#164E63] tracking-tight font-heading">
            رؤيتنا ورسالتنا
        </h2>
        <p class="text-[#183746]/60 text-sm">البوصلة التي تقود تجربة السياحة الرقمية المستدامة في جازان</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- الرؤية -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer card-3d-lift space-y-4 group transition-all duration-400">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-2xl mb-4 shadow-md shadow-cyan-500/25 group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-eye"></i>
            </div>
            <h3 class="text-2xl font-black text-[#164E63] group-hover:text-[#06B6D4] transition font-heading">الرؤية</h3>
            <p class="text-[#183746]/80 leading-relaxed text-sm sm:text-base">
                أن يصبح تطبيق «مَطَلّ» المنصة الرقمية الأولى لاكتشاف التجارب والمسارات السياحية الأصيلة في منطقة جازان، وربط السائح بالمكان والمجتمع المحلي ومقدمي الخدمات السياحية بكفاءة واستدامة.
            </p>
        </div>

        <!-- الرسالة -->
        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer card-3d-lift space-y-4 group transition-all duration-400">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-2xl mb-4 shadow-md shadow-cyan-500/25 group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-bullseye"></i>
            </div>
            <h3 class="text-2xl font-black text-[#164E63] group-hover:text-[#06B6D4] transition font-heading">الرسالة</h3>
            <p class="text-[#183746]/80 leading-relaxed text-sm sm:text-base">
                تقديم تجربة سياحية رقمية سهلة وآمنة وموثوقة، تساعد الزائر على: اكتشاف جازان، التخطيط لرحلته، حجز تجاربه، والتنقل بين مساراتها السياحية مع دعم المشاريع المحلية وتحقيق الاستدامة الاقتصادية.
            </p>
        </div>

    </div>

</section>

<!-- Partners Section matching About + Contact.png -->
<section class="py-16 bg-[#F8FCFD] border-y border-sky-100 text-center">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h3 class="text-2xl font-black text-[#164E63] mb-3 font-heading">شركاؤنا</h3>
        <p class="text-[#183746]/60 text-sm mb-8">شراكات تكاملية بين القطاعين الحكومي والخاص والمجتمع المحلي</p>

        <div class="bg-white rounded-3xl p-6 shadow-md border border-sky-100 flex flex-wrap items-center justify-center gap-3">
            @foreach($partners as $partner)
                <span class="px-4 py-2 rounded-xl bg-sky-50/70 text-[#164E63] font-semibold text-xs sm:text-sm border border-sky-100 shadow-2xs">
                    {{ $partner }}
                </span>
            @endforeach
        </div>

    </div>
</section>

<!-- Contact Us Form matching About + Contact.png -->
<section id="contact" class="py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
    
    <div class="text-center space-y-3 mb-12">
        <h2 class="text-3xl sm:text-4xl font-black text-[#164E63] tracking-tight font-heading">
            تواصل معنا
        </h2>
        <p class="text-[#183746]/60 text-sm">يسعدنا استقبال استفساراتكم واقتراحاتكم وطلبات الانضمام كشركاء</p>
    </div>

    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-2xl hover:shadow-cyan-500/10 border border-sky-100 transition-all">
        
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">الاسم الكامل *</label>
                <input type="text" name="name" required placeholder="اسمك الكريم" 
                       class="w-full p-3.5 rounded-xl border border-sky-100 text-sm focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">البريد الإلكتروني *</label>
                    <input type="email" name="email" required placeholder="example@domain.com" 
                           class="w-full p-3.5 rounded-xl border border-sky-100 text-sm focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">رقم الجوال (اختياري)</label>
                    <input type="tel" name="phone" placeholder="05XXXXXXXX" 
                           class="w-full p-3.5 rounded-xl border border-sky-100 text-sm focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">رسالتك *</label>
                <textarea name="message" rows="5" required placeholder="اكتب تفاصيل استفسارك أو اقتراحك هنا..." 
                          class="w-full p-3.5 rounded-xl border border-sky-100 text-sm focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white leading-relaxed transition"></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full sm:w-auto px-10 py-3.5 rounded-2xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-sm shadow-xl shadow-cyan-500/25 transition transform hover:scale-105">
                    إرسال الرسالة
                </button>
            </div>

        </form>

    </div>

</section>

@endsection
