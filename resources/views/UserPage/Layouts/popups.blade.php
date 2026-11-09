{{--
    Promo popup. Rendered only when it is live (switch on, image set, inside its date window; one shared rule in
    App\Models\Popup::resolveState). It opens shortly after the page loads, once per browser session for a given
    popup (editing the popup in the admin makes it appear again). Behaviour: resources/js/app.js "promoPopup".
--}}
@php
    $popupActive = \App\Models\Popup::resolveState(
        $popupContent['statusView'],
        $popupContent['startdateView'],
        $popupContent['enddateView'],
        $popupContent['imageView'],
    ) === \App\Models\Popup::STATE_LIVE;

    $popupLink = trim((string) ($popupContent['linkView'] ?? ''));
    $popupLinkHost = $popupLink !== '' ? parse_url($popupLink, PHP_URL_HOST) : null;
    $popupExternal = $popupLinkHost && strcasecmp($popupLinkHost, request()->getHost()) !== 0;
    $popupKey = 'promo-popup-' . ($popupContent['idView'] ?? '0') . '-' . ($popupContent['versionView'] ?? '0');
@endphp

@if ($popupActive)
    <div x-data="promoPopup({ key: @js($popupKey), delay: 900 })" x-cloak x-show="open" role="dialog" aria-modal="true"
        aria-label="Promo" x-on:keydown.escape.window="close()" x-on:keydown.tab="trap($event)"
        x-transition:enter="transition duration-300 ease-out motion-reduce:transition-none"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-200 ease-in motion-reduce:transition-none"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6">
        {{-- Backdrop: click anywhere outside the card to close. --}}
        <div class="absolute inset-0 bg-ink/75 backdrop-blur-sm" x-on:click="close()" aria-hidden="true"></div>

        <div x-ref="panel" x-show="open"
            x-transition:enter="transition duration-300 ease-out motion-reduce:transition-none"
            x-transition:enter-start="translate-y-6 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            class="relative w-full max-w-[min(92vw,34rem)]">
            <button type="button" x-ref="close" x-on:click="close()" aria-label="Tutup promo"
                class="absolute -right-2 -top-2 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-white text-ink shadow-lg ring-1 ring-black/10 transition hover:bg-brand hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 sm:-right-4 sm:-top-4">
                <x-icon name="xmark" class="h-5 w-5" />
            </button>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-white/20">
                @if ($popupLink !== '')
                    <a href="{{ $popupLink }}" x-on:click="dismiss()" class="block"
                        @if ($popupExternal) target="_blank" rel="noopener noreferrer" @endif>
                        <img src="{{ $popupContent['imageView'] }}" alt="Banner promo"
                            class="mx-auto block max-h-[70vh] w-full object-contain">
                    </a>
                    <div class="flex flex-col gap-2 border-t border-mist p-4 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button" x-on:click="close()"
                            class="order-2 rounded-lg px-3 py-2 text-sm font-medium text-muted transition hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand sm:order-1">
                            Nanti saja
                        </button>
                        <a href="{{ $popupLink }}" x-on:click="dismiss()"
                            @if ($popupExternal) target="_blank" rel="noopener noreferrer" @endif
                            class="btn btn-primary order-1 sm:order-2">
                            Lihat selengkapnya
                            <x-icon name="arrow-right" class="h-4 w-4" />
                        </a>
                    </div>
                @else
                    <img src="{{ $popupContent['imageView'] }}" alt="Banner promo"
                        class="mx-auto block max-h-[75vh] w-full object-contain">
                @endif
            </div>
        </div>
    </div>
@endif
