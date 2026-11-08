{{--
    Site footer, laid out like the landing page design:
    left = logo, head/branch office (stacked) and socials; right = NCIMEDISMART / Solusi / Perusahaan columns
    with the PSE and e-Katalog badges underneath; white bottom bar with the NCI logo and centred copyright.
    "Layanan", "Fitur" and "Syarat & Ketentuan" from the design have no pages yet, so the columns link to
    existing pages only.
--}}
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
    $columns = array_filter([
        'NCIMEDISMART' => [
            ['Tentang Kami', route('about'), false],
            ['Testimoni', route('testimoni'), false],
            ['Jadwalkan Demo', route('demo'), false],
        ],
        'Solusi' => $footerProducts->map(fn ($item) => [$item->products->title, $item->products->publicUrl(), false])->values()->all(),
        'Perusahaan' => [
            ['Informasi Perusahaan', 'http://nuansa.com/2019/', true],
            ['Blog', route('blog.index'), false],
            ['Sitemap', route('sitemap'), false],
        ],
    ]);
@endphp
<footer class="bg-brand text-white">
    <div class="mx-auto grid w-full max-w-7xl gap-10 px-5 py-14 sm:px-8 lg:grid-cols-12 lg:gap-8 lg:py-16">
        {{-- Brand, offices, socials --}}
        <div class="lg:col-span-5">
            <img src="{{ asset('assets/img/white-logo.png') }}" alt="NCI Medismart" class="h-14 w-auto" loading="lazy" decoding="async">
            <div class="mt-6 space-y-5 text-sm leading-relaxed text-white/90">
                @foreach ($offices as $label => $lines)
                    @if (array_filter($lines))
                        <address class="max-w-sm not-italic">
                            <p class="mb-1 text-xs font-bold uppercase tracking-wider text-white">{{ $label }}</p>
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
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-lg transition hover:bg-white hover:text-brand-dark">
                        <x-icon :name="$icon" />
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Link columns + registration badges --}}
        <div class="flex flex-col gap-10 lg:col-span-7">
            <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-3">
                @foreach ($columns as $heading => $links)
                    <div>
                        <h2 class="mb-4 text-sm font-bold uppercase tracking-wider">{{ $heading }}</h2>
                        <ul class="space-y-3 text-sm text-white/90">
                            @foreach ($links as [$text, $href, $external])
                                <li><a href="{{ $href }}" class="{{ $footerLink }}"
                                        @if ($external) target="_blank" rel="noopener noreferrer" @endif>{{ $text }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-3 lg:mt-auto lg:justify-end">
                <a href="https://pse.kominfo.go.id/tdpse-detail/13864" target="_blank" rel="noopener noreferrer"
                    class="flex h-14 w-32 items-center justify-center rounded-lg bg-white p-2 transition hover:shadow-lg">
                    <img src="{{ asset('assets/img/pse.png') }}" alt="Terdaftar di PSE Kominfo" class="max-h-full max-w-full object-contain" loading="lazy">
                </a>
                <a href="https://e-katalog.lkpp.go.id/katalog/produk/detail/51361898?lang=id&type=general" target="_blank"
                    rel="noopener noreferrer" class="flex h-14 w-32 items-center justify-center rounded-lg bg-white p-2 transition hover:shadow-lg">
                    <img src="{{ asset('assets/img/lkpp.png') }}" alt="Tersedia di e-Katalog LKPP" class="max-h-full max-w-full object-contain" loading="lazy">
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white text-ink">
        <div class="relative mx-auto flex w-full max-w-7xl flex-col items-center gap-3 px-5 pb-24 pt-5 text-xs sm:flex-row sm:pb-5 sm:px-8 sm:text-sm">
            <img src="{{ asset('assets/img/Logo NCI.png') }}" alt="PT Nuansa Cerah Informasi" class="h-8 w-auto sm:h-10" loading="lazy">
            <p class="text-center text-ink/70 sm:absolute sm:left-1/2 sm:-translate-x-1/2">Copyright &copy; {{ now()->year }} PT Nuansa Cerah Informasi</p>
        </div>
    </div>
</footer>
