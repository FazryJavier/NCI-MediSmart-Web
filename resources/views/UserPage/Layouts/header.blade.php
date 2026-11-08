{{-- Site header: top bar (collapses after scroll) + main navigation. --}}
@php
    // Hover/active states are deliberately strong (brand green) so they stay visible on the white sticky bar.
    $navLink = 'block rounded-lg px-3 py-2.5 font-medium transition duration-200 hover:bg-brand hover:text-white focus-visible:bg-brand focus-visible:text-white focus-visible:outline-none xl:px-4';
    $navActive = 'bg-brand/10 text-brand-dark';
    $navTrigger = $navLink . ' inline-flex items-center gap-1.5 group-hover:bg-brand group-hover:text-white group-focus-within:bg-brand group-focus-within:text-white';
    $dropLink = 'flex items-center gap-3 rounded-lg p-3 transition hover:bg-brand/10 hover:text-brand-dark';
    $mobileLink = 'flex w-full items-center justify-between rounded-lg px-3 py-3 text-left font-medium transition hover:bg-brand/10 hover:text-brand-dark';
    $socials = [
        ['https://www.instagram.com/ncimedismart/', 'instagram', 'Instagram NCI Medismart'],
        ['https://www.youtube.com/@simrsncimedismart2282/featured', 'youtube', 'YouTube NCI Medismart'],
        ['https://www.linkedin.com/company/pt-nuansa-cerah-informasi/', 'linkedin-in', 'LinkedIn PT Nuansa Cerah Informasi'],
    ];
    $products = collect($navbarContent)->filter(fn ($item) => $item->products);
    $about = [
        ['href' => route('about'), 'icon' => asset('assets/img/healthcare.png'), 'title' => 'Healthcare Solution', 'external' => false],
        ['href' => 'http://nuansa.com/2019/', 'icon' => asset('assets/img/pt-nci.png'), 'title' => 'PT Nuansa Cerah Informasi', 'external' => true],
    ];
    $menus = array_filter([
        'produk' => $products->isNotEmpty() ? 'Produk' : null,
        'tentang' => 'Tentang Kami',
    ]);
    $links = [
        ['href' => route('testimoni'), 'label' => 'Testimoni', 'active' => request()->routeIs('testimoni')],
        ['href' => route('blog.index'), 'label' => 'Blog', 'active' => request()->routeIs('blog.*')],
        ['href' => route('demo'), 'label' => 'Demo', 'active' => request()->routeIs('demo')],
    ];
    $waNumber = collect($whatsappContent['whatsappView'])->first();
@endphp

<header x-data="{ open: false, scrolled: false, sub: null }" x-init="scrolled = window.scrollY > 0"
    @scroll.window.passive="scrolled = window.scrollY > 0" @keydown.escape.window="open = false; sub = null"
    class="sticky top-0 z-[1000] bg-white">
    {{-- Top bar --}}
    <div class="overflow-hidden bg-ink text-sm text-white transition-[max-height] duration-300 sm:text-[15px]"
        :class="scrolled ? 'max-h-0' : 'max-h-11'">
        <div class="mx-auto flex h-10 w-full max-w-7xl items-center justify-between gap-4 px-5 sm:h-11 sm:px-8">
            <div class="flex items-center gap-1">
                @foreach ($socials as [$href, $icon, $label])
                    <a href="{{ $href }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}"
                        class="flex h-8 w-8 items-center justify-center rounded-full text-base transition hover:bg-white/10 hover:text-brand">
                        <x-icon :name="$icon" />
                    </a>
                @endforeach
            </div>
            <div class="flex h-full items-center gap-6">
                <a href="tel:+622287356050" class="inline-flex items-center gap-2 transition hover:text-brand">
                    <x-icon name="phone" />022 8735 6050
                </a>
                {{-- Office tab: white "tab" that visually connects to the main bar below. --}}
                <span
                    class="hidden h-8 items-center gap-2 self-end rounded-t-[10px] bg-white px-6 font-medium text-ink md:inline-flex">
                    <x-icon name="location-dot" class="text-brand" />Kantor Bandung
                </span>
            </div>
        </div>
    </div>

    {{-- Main bar --}}
    <div class="relative border-b border-black/5 shadow-[0_4px_12px_rgba(0,0,0,0.06)]">
        <div class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between gap-6 px-5 sm:h-20 sm:px-8">
            <a href="{{ route('home') }}" class="shrink-0" aria-label="Beranda NCI Medismart">
                <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="NCI Medismart" width="600" height="312"
                    class="h-11 w-auto sm:h-14">
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden nav:block" aria-label="Navigasi utama">
                <ul class="flex items-center gap-1 text-[15px]">
                    @foreach ($menus as $key => $label)
                        <li class="group relative">
                            <button type="button" class="{{ $navTrigger }}" aria-haspopup="true">
                                {{ $label }}
                                <x-icon name="chevron-down" class="text-[10px] transition group-hover:rotate-180" />
                            </button>
                            <div
                                class="invisible absolute left-0 top-full z-10 pt-3 opacity-0 transition group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100">
                                <ul class="w-80 rounded-xl border border-black/5 bg-white p-2 shadow-xl">
                                    @include('UserPage.Layouts.header-menu-items', ['menu' => $key, 'iconSize' => 'h-9 w-9'])
                                </ul>
                            </div>
                        </li>
                    @endforeach
                    @foreach ($links as $link)
                        <li><a href="{{ $link['href'] }}" class="{{ $navLink }} {{ $link['active'] ? $navActive : '' }}"
                                @if ($link['active']) aria-current="page" @endif>{{ $link['label'] }}</a></li>
                    @endforeach
                    @if ($waNumber)
                        <li class="ml-3">
                            <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank"
                                rel="noopener noreferrer" class="btn btn-primary !py-2.5">
                                <x-icon name="whatsapp" />Hubungi Kami
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>

            {{-- Mobile toggle (two icons swapped with x-show: SVGs are static markup) --}}
            <button type="button"
                class="flex h-11 w-11 items-center justify-center rounded-lg text-2xl text-brand-dark transition hover:bg-mist nav:hidden"
                @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-nav"
                :aria-label="open ? 'Tutup menu navigasi' : 'Buka menu navigasi'">
                <span x-show="!open"><x-icon name="bars" /></span>
                <span x-show="open" x-cloak><x-icon name="xmark" /></span>
            </button>
        </div>

        {{-- Mobile navigation --}}
        <nav id="mobile-nav" x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="absolute inset-x-0 top-full max-h-[calc(100svh-7rem)] overflow-y-auto border-t border-black/5 bg-white shadow-xl nav:hidden"
            aria-label="Navigasi utama">
            <ul class="mx-auto w-full max-w-7xl space-y-1 px-5 py-4 sm:px-8">
                @foreach ($menus as $key => $label)
                    <li>
                        <button type="button" class="{{ $mobileLink }}" @click="sub = sub === '{{ $key }}' ? null : '{{ $key }}'"
                            :aria-expanded="(sub === '{{ $key }}').toString()">
                            {{ $label }}
                            <span class="transition" :class="sub === '{{ $key }}' && 'rotate-180'"><x-icon name="chevron-down" class="text-xs" /></span>
                        </button>
                        <ul x-show="sub === '{{ $key }}'" x-transition.opacity class="ml-3 border-l border-black/10 pl-3">
                            @include('UserPage.Layouts.header-menu-items', ['menu' => $key, 'iconSize' => 'h-8 w-8'])
                        </ul>
                    </li>
                @endforeach
                @foreach ($links as $link)
                    <li><a href="{{ $link['href'] }}" class="{{ $mobileLink }} {{ $link['active'] ? $navActive : '' }}"
                            @if ($link['active']) aria-current="page" @endif>{{ $link['label'] }}</a></li>
                @endforeach
                @if ($waNumber)
                    <li class="pt-3">
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank"
                            rel="noopener noreferrer" class="btn btn-primary w-full">
                            <x-icon name="whatsapp" />Hubungi Kami
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
