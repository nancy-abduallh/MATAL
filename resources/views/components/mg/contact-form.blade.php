@props(['subject' => true])

<form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
    @csrf

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="mg-label" for="cf_name">الاسم الكامل <span class="text-[#06B6D4]">*</span></label>
            <input id="cf_name" type="text" name="name" value="{{ old('name') }}" required placeholder="اسمك الكريم" class="mg-field">
            @error('name')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="mg-label" for="cf_email">البريد الإلكتروني <span class="text-[#06B6D4]">*</span></label>
            <input id="cf_email" type="email" name="email" value="{{ old('email') }}" required placeholder="example@domain.com" class="mg-field" dir="ltr" style="text-align: right;">
            @error('email')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid {{ $subject ? 'sm:grid-cols-2' : '' }} gap-5">
        <div>
            <label class="mg-label" for="cf_phone">رقم الجوال <span class="text-[#164E63]/50 font-semibold">(اختياري)</span></label>
            <input id="cf_phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="05XXXXXXXX" class="mg-field" dir="ltr" style="text-align: right;">
            @error('phone')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
        </div>
        @if($subject)
            <div>
                <label class="mg-label" for="cf_subject">موضوع الرسالة</label>
                <input id="cf_subject" type="text" name="subject" value="{{ old('subject') }}" placeholder="استفسار، اقتراح، طلب شراكة" class="mg-field">
                @error('subject')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
            </div>
        @endif
    </div>

    <div>
        <label class="mg-label" for="cf_message">رسالتك <span class="text-[#06B6D4]">*</span></label>
        <textarea id="cf_message" name="message" rows="5" required placeholder="اكتب تفاصيل استفسارك أو اقتراحك هنا..." class="mg-field resize-none">{{ old('message') }}</textarea>
        @error('message')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="mg-btn w-full sm:w-auto" data-magnetic>
        <i class="fa-solid fa-paper-plane"></i><span>إرسال الرسالة</span>
    </button>
</form>
