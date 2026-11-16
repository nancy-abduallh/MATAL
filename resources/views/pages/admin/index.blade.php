@extends('layouts.app')

@section('title', 'لوحة تحكم المنصة · مَطَلّ')

@section('content')

<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right space-y-10">
    
    <!-- Admin Header -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <span class="text-xs font-bold text-teal-800 bg-teal-50 px-3 py-1 rounded-full border border-teal-200">
                لوحة الإدارة والتحكم
            </span>
            <h1 class="text-3xl font-black text-[#0A3847] tracking-tight mt-2">
                مؤشرات أداء منصة مَطَلّ (KPIs)
            </h1>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-semibold text-slate-500">حساب الإدارة: {{ Auth::user()->name }}</span>
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                معاينة الواجهة الأمامية
            </a>
        </div>
    </div>

    <!-- Stats KPI Cards Grid matching PDF Page 8 Requirements -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        
        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/12 border border-sky-100 hover:border-cyan-300 space-y-2 card-3d-lift card-shimmer transition-all duration-300 group">
            <div class="text-xs text-[#183746]/70 font-semibold flex items-center justify-between">
                <span>إجمالي الحجوزات</span>
                <div class="w-8 h-8 rounded-xl bg-cyan-50 text-[#06B6D4] flex items-center justify-center group-hover:scale-110 transition"><i class="fa-solid fa-ticket"></i></div>
            </div>
            <div class="text-3xl font-black text-[#164E63] font-heading">{{ $stats['total_bookings'] }}</div>
            <div class="text-[11px] text-emerald-600 font-bold">نمو مستمر +40%</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/12 border border-sky-100 hover:border-cyan-300 space-y-2 card-3d-lift card-shimmer transition-all duration-300 group">
            <div class="text-xs text-[#183746]/70 font-semibold flex items-center justify-between">
                <span>الإيرادات التقديرية</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center group-hover:scale-110 transition"><i class="fa-solid fa-coins"></i></div>
            </div>
            <div class="text-3xl font-black text-amber-500 font-heading">{{ number_format($stats['total_revenue'], 2) }} ر.س</div>
            <div class="text-[11px] text-slate-400">عمولات ومبيعات مباشرة</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/12 border border-sky-100 hover:border-cyan-300 space-y-2 card-3d-lift card-shimmer transition-all duration-300 group">
            <div class="text-xs text-[#183746]/70 font-semibold flex items-center justify-between">
                <span>المواقع المسجلة</span>
                <div class="w-8 h-8 rounded-xl bg-sky-50 text-[#38BDF8] flex items-center justify-center group-hover:scale-110 transition"><i class="fa-solid fa-map-pin"></i></div>
            </div>
            <div class="text-3xl font-black text-[#164E63] font-heading">{{ $stats['total_destinations'] }}</div>
            <div class="text-[11px] text-slate-400">من أصل 500+ مستهدف</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/12 border border-sky-100 hover:border-cyan-300 space-y-2 card-3d-lift card-shimmer transition-all duration-300 group">
            <div class="text-xs text-[#183746]/70 font-semibold flex items-center justify-between">
                <span>المسارات النشطة</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition"><i class="fa-solid fa-route"></i></div>
            </div>
            <div class="text-3xl font-black text-[#164E63] font-heading">{{ $stats['total_routes'] }}</div>
            <div class="text-[11px] text-slate-400">تغطي 6 تصنيفات رئيسية</div>
        </div>

    </div>

    <!-- Management Tables: Recent Bookings & Contacts -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Recent Bookings Table -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h3 class="text-xl font-bold text-[#0A3847] flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-amber-500"></i>
                    <span>أحدث الحجوزات الواردة</span>
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 font-bold">
                            <th class="py-3 px-2">رمز الحجز</th>
                            <th class="py-3 px-2">اسم السائح</th>
                            <th class="py-3 px-2">التجربة / المسار</th>
                            <th class="py-3 px-2">المبلغ</th>
                            <th class="py-3 px-2">الحالة</th>
                            <th class="py-3 px-2">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentBookings as $bk)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3 px-2 font-mono font-bold text-amber-600">{{ $bk->booking_code }}</td>
                                <td class="py-3 px-2 font-semibold text-slate-800">{{ $bk->customer_name }}</td>
                                <td class="py-3 px-2 text-slate-600">{{ $bk->bookable?->title ?? 'مسار' }}</td>
                                <td class="py-3 px-2 font-bold text-[#0A3847]">{{ number_format($bk->total_price, 2) }} ر.س</td>
                                <td class="py-3 px-2">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $bk->status == 'confirmed' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ $bk->status == 'confirmed' ? 'مؤكد' : 'ملغي' }}
                                    </span>
                                </td>
                                <td class="py-3 px-2">
                                    <a href="{{ route('booking.show', $bk->booking_code) }}" target="_blank" class="text-teal-700 font-bold hover:underline">
                                        التذكرة
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-slate-400">لا توجد حجوزات مسجلة حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Contact Messages -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <h3 class="text-xl font-bold text-[#0A3847] flex items-center gap-2">
                    <i class="fa-solid fa-inbox text-teal-700"></i>
                    <span>طلبات التواصل</span>
                </h3>
                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-xs font-bold rounded-full">
                    {{ $stats['unread_contacts'] }} غير مقروء
                </span>
            </div>

            <div class="space-y-4">
                @forelse($recentContacts as $msg)
                    <div class="p-4 rounded-2xl {{ $msg->is_read ? 'bg-slate-50' : 'bg-amber-50/50 border border-amber-200' }} space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-[#0A3847] text-xs">{{ $msg->name }}</span>
                            <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-xs text-slate-700 font-semibold">{{ $msg->subject ?? 'طلب استفسار' }}</div>
                        <p class="text-slate-500 text-[11px] line-clamp-2">{{ $msg->message }}</p>
                        @if(!$msg->is_read)
                            <form action="{{ route('admin.contacts.read', $msg->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] text-teal-700 font-bold hover:underline">
                                    تحديد كمقروء ✓
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-slate-400 text-xs py-4">صندوق الرسائل فارغ.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

@endsection
