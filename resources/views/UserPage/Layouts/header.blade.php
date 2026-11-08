{{-- Site header: top bar (collapses after scroll) + main navigation. --}}
@php
    $navLink = 'block p-5 transition hover:bg-brand-dark hover:text-white';
    $subItem = 'whitespace-nowrap border-t border-black/10 bg-[#eee] nav:bg-white';
    $subLink = 'flex items-center p-5 transition hover:bg-brand-dark hover:text-white';
    $subMenu = 'hidden w-full bg-white group-hover:block group-focus-within:block nav:absolute nav:left-0 nav:w-auto';
@endphp
<header x-data="{ open: false, scrolled: false }" x-init="scrolled = window.scrollY > 0"
    @scroll.window.passive="scrolled = window.scrollY > 0" class="sticky top-0 z-[1000]">
    <div class="overflow-hidden bg-ink text-[10px] text-white transition-[max-height] duration-300 min-[501px]:text-sm"
        :class="scrolled ? 'max-h-0' : 'max-h-[30px]'">
        <div class="px-[10%]">
            <div class="flex h-[30px] items-center justify-between gap-5 sm:px-[30px]">
                <div class="flex items-center gap-7">
                    <a href="https://www.instagram.com/ncimedismart/" target="_blank" rel="noopener noreferrer"
                        aria-label="Instagram NCI Medismart" class="transition hover:text-brand">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/@simrsncimedismart2282/featured" target="_blank"
                        rel="noopener noreferrer" aria-label="YouTube NCI Medismart"
                        class="transition hover:text-brand">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/pt-nuansa-cerah-informasi/" target="_blank"
                        rel="noopener noreferrer" aria-label="LinkedIn PT Nuansa Cerah Informasi"
                        class="transition hover:text-brand">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>

                <div class="flex flex-wrap items-center">
                    <span><i class="fa-solid fa-phone mr-1.5"></i>022 8735 6050</span>
                    <span
                        class="ml-12 hidden h-[30px] items-center rounded-t-[10px] bg-white px-7 text-ink min-[681px]:flex">
                        Kantor Bandung
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white text-ink shadow-[0_5px_10px_rgba(0,0,0,0.1)]">
        <div class="px-[10%]">
            <div class="flex min-h-[60px] items-center justify-between sm:px-[30px]">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="Medismart"
                        class="w-full max-w-[100px] min-[501px]:max-w-[150px]">
                </a>

                <button type="button" class="text-[22px] text-brand-dark min-[501px]:text-[28px] nav:hidden"
                    @click="open = !open" :aria-expanded="open.toString()" aria-controls="main-nav"
                    aria-label="Buka menu navigasi">
                    <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
                </button>

                <nav id="main-nav"
                    class="absolute inset-x-0 top-full hidden border-t border-black/10 bg-white pb-2.5 nav:static nav:block nav:border-0 nav:pb-0"
                    :class="{ '!block': open }">
                    <ul class="grid gap-5 nav:flex nav:items-center nav:gap-0 xl:gap-5">
                        <li class="group relative">
                            <a href="#" class="{{ $navLink }}" @click.prevent>Produk <span
                                    aria-hidden="true">&#x25BE;</span></a>
                            <ul class="{{ $subMenu }}">
                                @foreach ($navbarContent as $navbarItem)
                                    @if ($navbarItem->products)
                                        <li class="{{ $subItem }}">
                                            <a href="{{ url('/ProductView/' . $navbarItem->products->id) }}"
                                                class="{{ $subLink }}">
                                                <img src="{{ asset('storage/' . $navbarItem->icon) }}" alt=""
                                                    class="mr-2.5 w-[38px]">
                                                <div>
                                                    <h5 class="font-bold">{{ $navbarItem->products->title }}</h5>
                                                    <p class="text-xs text-muted">
                                                        {{ $navbarItem->products->subTitle }}</p>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li class="group relative">
                            <a href="#" class="{{ $navLink }}" @click.prevent>Tentang Kami <span
                                    aria-hidden="true">&#x25BE;</span></a>
                            <ul class="{{ $subMenu }}">
                                <li class="{{ $subItem }}">
                                    <a href="{{ url('/HealthcareSolution') }}" class="{{ $subLink }}">
                                        <img src="{{ asset('assets/img/healthcare.png') }}" alt=""
                                            class="mr-2.5 w-[38px]">
                                        <h5 class="font-bold">Healthcare Solution</h5>
                                    </a>
                                </li>
                                <li class="{{ $subItem }}">
                                    <a href="http://nuansa.com/2019/" target="_blank" rel="noopener noreferrer"
                                        class="{{ $subLink }}">
                                        <img src="{{ asset('assets/img/pt-nci.png') }}" alt=""
                                            class="mr-2.5 w-[38px]">
                                        <h5 class="font-bold">PT Nuansa Cerah Informasi</h5>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="{{ url('/Testimoni') }}" class="{{ $navLink }}">Testimoni</a></li>
                        <li><a href="{{ url('/Blog') }}" class="{{ $navLink }}">Blog</a></li>
                        <li><a href="{{ url('/Demo') }}" class="{{ $navLink }}">Demo</a></li>
                        <li class="px-5 nav:px-0">
                            @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="inline-block w-fit rounded-[10px] bg-brand px-4 py-[18px] text-center text-white transition hover:bg-brand-dark nav:ml-2.5 xl:ml-0">
                                    Hubungi Kami
                                </a>
                            @endforeach
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
