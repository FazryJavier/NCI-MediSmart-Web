{{-- Floating WhatsApp button. --}}
@php($waNumber = collect($whatsappContent['whatsappView'])->first())
@if ($waNumber)
    <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank" rel="noopener noreferrer"
        aria-label="Chat WhatsApp"
        class="fixed bottom-5 right-5 z-[900] block rounded-full shadow-lg transition hover:-translate-y-1 sm:bottom-8 sm:right-8">
        <img src="{{ asset('assets/img/whatsapp.png') }}" alt="" class="h-12 w-12 sm:h-14 sm:w-14">
    </a>
@endif
