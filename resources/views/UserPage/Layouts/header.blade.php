{{-- Site header: top bar (collapses after scroll) + main navigation. --}}
@php
    $navLink = 'block rounded-lg px-3 py-2 font-medium transition hover:bg-mist hover:text-brand-dark xl:px-4';
    $dropLink = 'flex items-center gap-3 rounded-lg p-3 transition hover:bg-mist';
    $mobileLink = 'flex w-full items-center justify-between rounded-lg px-3 py-3 text-left font-medium transition hover:bg-mist';
    $socials = [
        ['https://www.instagram.com/ncimedismart/', 'fa-instagram', 'Instagram NCI Medismart'],
        ['https://www.youtube.com/@simrsncimedismart2282/featured', 'fa-youtube', 'YouTube NCI Medismart'],
        ['https://www.linkedin.com/company/pt-nuansa-cerah-informasi/', 'fa-linkedin-in', 'LinkedIn PT Nuansa Cerah Informasi'],
    ];
    $products = collect($navbarContent)->filter(fn ($item) => $item->products);
    $about = [
        ['href' => url('/HealthcareSolution'), 'icon' => asset('assets/img/healthcare.png'), 'title' => 'Healthcare Solution', 'external' => false],
        ['href' => 'http://nuansa.com/2019/', 'icon' => asset('assets/img/pt-nci.png'), 'title' => 'PT Nuansa Cerah Informasi', 'external' => true],
    ];
    $links = [
        ['href' => url('/Testimoni'), 'label' => 'Testimoni'],
        ['href' => url('/Blog'), 'label' => 'Blog'],
        ['href' => url('/Demo'), 'label' => 'Demo'],
    ];
    $waNumber = collect($whatsappContent['whatsappView'])->first();
@endphp

<header x-data="{ open: false, scrolled: false, sub: null }" x-init="scrolled = window.scrollY > 0"
    @scroll.window.passive="scrolled = window.scrollY > 0" @keydown.escape.window="open = false; sub = null"
    class="sticky top-0 z-[1000] bg-white">
    {{-- Top bar --}}
    <div class="overflow-hidden bg-ink text-xs text-white transition-[max-height] duration-300 sm:text-sm"
        :class="scrolled ? 'max-h-0' : 'max-h-10'">
        <div class="mx-auto flex h-9 w-full max-w-7xl items-center justify-between gap-4 px-5 sm:px-8">
            <div class="flex items-center gap-5">
                @foreach ($socials as [$href, $icon, $label])
                    <a href="{{ $href }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}"
                        class="transition hover:text-brand"><i class="fa-brands {{ $icon }}"></i></a>
                @endforeach
            </div>
            <div class="flex items-center gap-5">
                <a href="tel:+622287356050" class="transition hover:text-brand">
                    <i class="fa-solid fa-phone mr-1.5"></i>022 8735 6050
                </a>
                <span class="hidden items-center gap-1.5 text-white/80 md:inline-flex">
                    <i class="fa-solid fa-location-dot"></i>Kantor Bandung
                </span>
            </div>
        </div>
    </div>

    {{-- Main bar --}}
    <div class="relative border-b border-black/5 shadow-[0_4px_12px_rgba(0,0,0,0.06)]">
        <div class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between gap-6 px-5 sm:h-20 sm:px-8">
            <a href="{{ url('/') }}" class="shrink-0" aria-label="Beranda NCI Medismart">
                <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="NCI Medismart"
                    class="h-11 w-auto sm:h-14">
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden nav:block" aria-label="Navigasi utama">
                <ul class="flex items-center gap-1 text-[15px]">
                    <li class="group relative">
                        <button type="button" class="{{ $navLink }} inline-flex items-center gap-1.5" aria-haspopup="true">
                            Produk <i class="fa-solid fa-chevron-down text-[10px] transition group-hover:rotate-180"></i>
                        </button>
                        <div
                            class="invisible absolute left-0 top-full z-10 pt-3 opacity-0 transition group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100">
                            <ul class="w-80 rounded-xl border border-black/5 bg-white p-2 shadow-xl">
                                @foreach ($products as $navbarItem)
                                    <li>
                                        <a href="{{ url('/ProductView/' . $navbarItem->products->id) }}" class="{{ $dropLink }}">
                                            <img src="{{ asset('storage/' . $navbarItem->icon) }}" alt=""
                                                class="h-9 w-9 shrink-0 object-contain">
                                            <span>
                                                <span class="block font-bold">{{ $navbarItem->products->title }}</span>
                                                <span class="block text-xs text-muted">{{ $navbarItem->products->subTitle }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="group relative">
                        <button type="button" class="{{ $navLink }} inline-flex items-center gap-1.5" aria-haspopup="true">
                            Tentang Kami <i class="fa-solid fa-chevron-down text-[10px] transition group-hover:rotate-180"></i>
                        </button>
                        <div
                            class="invisible absolute left-0 top-full z-10 pt-3 opacity-0 transition group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100">
                            <ul class="w-80 rounded-xl border border-black/5 bg-white p-2 shadow-xl">
                                @foreach ($about as $item)
                                    <li>
                                        <a href="{{ $item['href'] }}" class="{{ $dropLink }}"
                                            @if ($item['external']) target="_blank" rel="noopener noreferrer" @endif>
                                            <img src="{{ $item['icon'] }}" alt="" class="h-9 w-9 shrink-0 object-contain">
                                            <span class="font-bold">{{ $item['title'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @foreach ($links as $link)
                        <li><a href="{{ $link['href'] }}" class="{{ $navLink }}">{{ $link['label'] }}</a></li>
                    @endforeach
                    @if ($waNumber)
                        <li class="ml-3">
                            <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank"
                                rel="noopener noreferrer" class="btn btn-primary !py-2.5">
                                <i class="fa-brands fa-whatsapp"></i>Hubungi Kami
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>

            {{-- Mobile toggle --}}
            <button type="button"
                class="flex h-11 w-11 items-center justify-center rounded-lg text-2xl text-brand-dark transition hover:bg-mist nav:hidden"
                @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-nav"
                :aria-label="open ? 'Tutup menu navigasi' : 'Buka menu navigasi'">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        {{-- Mobile navigation --}}
        <nav id="mobile-nav" x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="absolute inset-x-0 top-full max-h-[calc(100svh-7rem)] overflow-y-auto border-t border-black/5 bg-white shadow-xl nav:hidden"
            aria-label="Navigasi utama">
            <ul class="mx-auto w-full max-w-7xl space-y-1 px-5 py-4 sm:px-8">
                <li>
                    <button type="button" class="{{ $mobileLink }}" @click="sub = sub === 'produk' ? null : 'produk'"
                        :aria-expanded="(sub === 'produk').toString()">
                        Produk <i class="fa-solid fa-chevron-down text-xs transition" :class="sub === 'produk' && 'rotate-180'"></i>
                    </button>
                    <ul x-show="sub === 'produk'" x-transition.opacity class="ml-3 border-l border-black/10 pl-3">
                        @foreach ($products as $navbarItem)
                            <li>
                                <a href="{{ url('/ProductView/' . $navbarItem->products->id) }}" class="{{ $dropLink }}">
                                    <img src="{{ asset('storage/' . $navbarItem->icon) }}" alt="" class="h-8 w-8 shrink-0 object-contain">
                                    <span>
                                        <span class="block font-bold">{{ $navbarItem->products->title }}</span>
                                        <span class="block text-xs text-muted">{{ $navbarItem->products->subTitle }}</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <button type="button" class="{{ $mobileLink }}" @click="sub = sub === 'tentang' ? null : 'tentang'"
                        :aria-expanded="(sub === 'tentang').toString()">
                        Tentang Kami <i class="fa-solid fa-chevron-down text-xs transition" :class="sub === 'tentang' && 'rotate-180'"></i>
                    </button>
                    <ul x-show="sub === 'tentang'" x-transition.opacity class="ml-3 border-l border-black/10 pl-3">
                        @foreach ($about as $item)
                            <li>
                                <a href="{{ $item['href'] }}" class="{{ $dropLink }}"
                                    @if ($item['external']) target="_blank" rel="noopener noreferrer" @endif>
                                    <img src="{{ $item['icon'] }}" alt="" class="h-8 w-8 shrink-0 object-contain">
                                    <span class="font-bold">{{ $item['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @foreach ($links as $link)
                    <li><a href="{{ $link['href'] }}" class="{{ $mobileLink }}">{{ $link['label'] }}</a></li>
                @endforeach
                @if ($waNumber)
                    <li class="pt-3">
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank"
                            rel="noopener noreferrer" class="btn btn-primary w-full">
                            <i class="fa-brands fa-whatsapp"></i>Hubungi Kami
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
