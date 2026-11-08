{{-- Floating WhatsApp button. --}}
<div class="fixed bottom-[10%] right-4 z-[1000] flex flex-col items-center gap-2 min-[581px]:bottom-[15%] min-[581px]:right-[2%]">
    @foreach ($whatsappContent['whatsappView'] as $phone_number)
        <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}" target="_blank"
            rel="noopener noreferrer" aria-label="Chat WhatsApp" class="transition hover:-translate-y-2.5">
            <img src="{{ asset('assets/img/whatsapp.png') }}" alt="" class="w-10 min-[581px]:w-[60px]">
        </a>
    @endforeach
</div>
