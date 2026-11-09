{{-- Promo popup: rendered only when active and inside its date window (checked server-side). --}}
@php
    $popupActive = \App\Models\Popup::resolveState(
        $popupContent['statusView'],
        $popupContent['startdateView'],
        $popupContent['enddateView'],
        $popupContent['imageView'],
    ) === \App\Models\Popup::STATE_LIVE;
@endphp

@if ($popupActive)
    <div x-data="{ show: true }" x-show="show" x-cloak @keydown.escape.window="show = false"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50" role="dialog"
        aria-modal="true" aria-label="Promo">
        <div class="relative p-5 text-center" @click.outside="show = false">
            <a href="{{ $popupContent['linkView'] }}">
                <img src="{{ $popupContent['imageView'] }}" alt="Banner promo"
                    class="h-auto w-[600px] max-w-full">
            </a>
            <button type="button" @click="show = false" aria-label="Tutup promo"
                class="absolute right-2.5 top-2.5 bg-brand px-2.5 py-1 text-white">
                <x-icon name="xmark" />
            </button>
        </div>
    </div>
@endif
