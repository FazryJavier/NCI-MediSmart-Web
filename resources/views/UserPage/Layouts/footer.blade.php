{{-- Site footer. --}}
@php
    $footerLink = 'transition hover:text-brand-dark hover:underline underline-offset-4';
    $socials = [
        ['https://www.instagram.com/ncimedismart/', 'instagram', 'Instagram NCI Medismart'],
        ['https://www.youtube.com/@simrsncimedismart2282/featured', 'youtube', 'YouTube NCI Medismart'],
        ['https://www.linkedin.com/company/pt-nuansa-cerah-informasi/', 'linkedin-in', 'LinkedIn PT Nuansa Cerah Informasi'],
    ];
    $offices = [
        'Head Office' => [$footerContent->address_head, $footerContent->phone_head, $footerContent->fax_head],
        'Branch Office' => [$footerContent->address_branch, $footerContent->phone_branch, $footerContent->fax_branch],
    ];
    $footerProducts = collect($navbarContent)->filter(fn ($item) => $item->products);
@endphp
<footer class="bg-brand text-white">
    <div class="mx-auto grid w-full max-w-7xl grid-cols-2 gap-x-6 gap-y-10 px-5 py-14 sm:px-8 lg:grid-cols-12 lg:py-16">
        {{-- Brand & offices --}}
        <div class="col-span-2 lg:col-span-5">
            <img src="{{ asset('assets/img/white-logo.png') }}" alt="NCI Medismart" class="h-14 w-auto" loading="lazy" decoding="async">
            <div class="mt-6 grid gap-6 text-sm leading-relaxed text-white/90 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                @foreach ($offices as $label => $lines)
                    @if (array_filter($lines))
                        <address class="not-italic">
                            <p class="mb-1.5 text-xs font-bold uppercase tracking-wider text-white">{{ $label }}</p>
                            @foreach (array_filter($lines) as $line)
                                <p class="break-words">{{ $line }}</p>
                            @endforeach
                        </address>
                    @endif
                @endforeach
            </div>
            <div class="mt-6 flex gap-3">
                @foreach ($socials as [$href, $icon, $label])
                    <a href="{{ $href }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-lg transition hover:-translate-y-0.5 hover:bg-white hover:text-brand-dark">
                        <x-icon :name="$icon" />
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Products (hidden when none are configured; Company then takes both columns on phones) --}}
        @if ($footerProducts->isNotEmpty())
            <div class="lg:col-span-2">
                <h2 class="mb-4 text-sm font-bold uppercase tracking-wider">NCI Medismart</h2>
                <ul class="space-y-3 text-sm text-white/90">
                    @foreach ($footerProducts as $navbarItem)
                        <li><a href="{{ url('/ProductView/' . $navbarItem->products->id) }}"
                                class="{{ $footerLink }}">{{ $navbarItem->products->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Company --}}
        <div class="{{ $footerProducts->isNotEmpty() ? '' : 'col-span-2 ' }}lg:col-span-2">
            <h2 class="mb-4 text-sm font-bold uppercase tracking-wider">Perusahaan</h2>
            <ul class="space-y-3 text-sm text-white/90">
                <li><a href="http://nuansa.com/2019/" target="_blank" rel="noopener noreferrer"
                        class="{{ $footerLink }}">Informasi Perusahaan</a></li>
                <li><a href="{{ url('/HealthcareSolution') }}" class="{{ $footerLink }}">Healthcare Solution</a></li>
                <li><a href="{{ url('/Blog') }}" class="{{ $footerLink }}">Blog</a></li>
                <li><a href="{{ url('/Sitemap') }}" class="{{ $footerLink }}">Sitemap</a></li>
            </ul>
        </div>

        {{-- Registrations --}}
        <div class="col-span-2 lg:col-span-3">
            <h2 class="mb-4 text-sm font-bold uppercase tracking-wider">Terdaftar di</h2>
            <div class="flex flex-wrap gap-3">
                <a href="https://pse.kominfo.go.id/tdpse-detail/13864" target="_blank" rel="noopener noreferrer"
                    class="flex h-16 w-36 items-center justify-center rounded-lg bg-white p-2 transition hover:shadow-lg">
                    <img src="{{ asset('assets/img/pse.png') }}" alt="Terdaftar di PSE Kominfo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </a>
                <a href="https://e-katalog.lkpp.go.id/katalog/produk/detail/51361898?lang=id&type=general"
                    target="_blank" rel="noopener noreferrer"
                    class="flex h-16 w-36 items-center justify-center rounded-lg bg-white p-2 transition hover:shadow-lg">
                    <img src="{{ asset('assets/img/lkpp.png') }}" alt="Tersedia di e-Katalog LKPP"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white text-ink">
        <div
            class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-5 pb-24 pt-5 text-center sm:pb-5 text-xs sm:flex-row sm:px-8 sm:text-left sm:text-sm">
            <img src="{{ asset('assets/img/Logo NCI.png') }}" alt="PT Nuansa Cerah Informasi" class="h-8 w-auto sm:h-10"
                loading="lazy">
            <p class="text-ink/70">Copyright &copy; {{ now()->year }} PT Nuansa Cerah Informasi. All rights reserved.</p>
        </div>
    </div>
</footer>
