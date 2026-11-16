@extends('layouts.app')

@section('title', 'تواصل معنا · مَطَلّ جازان')
@section('meta_description', 'تواصل مع فريق مَطَلّ للاستفسارات، الشراكات السياحية، ودعم الحجوزات في جازان.')

@section('content')

<section class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
    
    <div class="text-center space-y-3 mb-14">
        <span class="text-xs font-bold text-amber-600 uppercase tracking-wider bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
            خدمة الزوار والشركاء
        </span>
        <h1 class="text-4xl sm:text-5xl font-black text-[#0A3847] tracking-tight">
            تواصل معنا
        </h1>
        <p class="text-slate-600 text-sm max-w-xl mx-auto">
            نحن هنا للإجابة على تساؤلاتكم، وتنسيق رحلاتكم الاستثنائية في ربوع جازان.
        </p>
    </div>

    <!-- Contact Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 text-center">
        <div class="bg-white rounded-3xl p-6 shadow-md border border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h4 class="font-bold text-[#0A3847] text-sm">البريد الإلكتروني</h4>
            <p class="text-slate-500 text-xs mt-1">info@matal.sa</p>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-md border border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="fa-solid fa-phone"></i>
            </div>
            <h4 class="font-bold text-[#0A3847] text-sm">الهاتف الموحد</h4>
            <p class="text-slate-500 text-xs mt-1">920000000</p>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-md border border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-3">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h4 class="font-bold text-[#0A3847] text-sm">المقر الرئيسي</h4>
            <p class="text-slate-500 text-xs mt-1">مدينة جازان، الكورنيش الشمالي</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-200">
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">الاسم الكريم *</label>
                    <input type="text" name="name" required placeholder="اسمك الكامل" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">البريد الإلكتروني *</label>
                    <input type="email" name="email" required placeholder="example@domain.com" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-slate-50">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">رقم الجوال</label>
                    <input type="tel" name="phone" placeholder="05XXXXXXXX" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">موضوع الرسالة</label>
                    <input type="text" name="subject" placeholder="استفسار، اقتراح، طلب شراكة" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-slate-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">نص الرسالة *</label>
                <textarea name="message" rows="5" required placeholder="اكتب استفسارك هنا..." 
                          class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-slate-50"></textarea>
            </div>

            <button type="submit" class="px-8 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-sm shadow-xl transition transform hover:scale-105">
                إرسال الرسالة
            </button>
        </form>
    </div>

</section>

@endsection
