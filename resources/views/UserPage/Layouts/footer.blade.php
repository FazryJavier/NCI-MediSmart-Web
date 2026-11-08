{{-- Site footer. --}}
@php
    $footerLink = 'block hover:text-brand-dark';
    $socialLink = 'transition hover:-translate-y-1 hover:text-brand-dark';
@endphp
<footer>
    <div
        class="grid grid-cols-[repeat(auto-fit,minmax(200px,auto))] gap-10 bg-brand px-[11%] pb-[70px] pt-20 text-white">
        <div>
            <img src="{{ asset('assets/img/white-logo.png') }}" alt="NCI Medismart" class="mb-5 w-[172px]"
                loading="lazy">
            <div class="mb-7 max-w-[350px] space-y-1 break-words">
                <p class="font-bold">HEAD OFFICE</p>
                <p>{{ $footerContent->address_head }}</p>
                <p>{{ $footerContent->phone_head }}</p>
                <p>{{ $footerContent->fax_head }}</p>
            </div>
            <div class="mb-7 max-w-[350px] space-y-1 break-words">
                <p class="font-bold">BRANCH OFFICE</p>
                <p>{{ $footerContent->address_branch }}</p>
                <p>{{ $footerContent->phone_branch }}</p>
                <p>{{ $footerContent->fax_branch }}</p>
            </div>
            <div class="mt-5 flex gap-5 text-2xl">
                <a href="https://www.instagram.com/ncimedismart/" target="_blank" rel="noopener noreferrer"
                    aria-label="Instagram NCI Medismart" class="{{ $socialLink }}"><i
                        class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/@simrsncimedismart2282/featured" target="_blank"
                    rel="noopener noreferrer" aria-label="YouTube NCI Medismart" class="{{ $socialLink }}"><i
                        class="fa-brands fa-youtube"></i></a>
                <a href="https://www.linkedin.com/company/pt-nuansa-cerah-informasi/" target="_blank"
                    rel="noopener noreferrer" aria-label="LinkedIn PT Nuansa Cerah Informasi"
                    class="{{ $socialLink }}"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

        <div aria-hidden="true"></div>

        <div>
            <h4 class="mb-6 text-lg font-bold min-[581px]:mt-12">NCIMEDISMART</h4>
            <ul class="space-y-4">
                @foreach ($navbarContent as $navbarItem)
                    @if ($navbarItem->products)
                        <li>
                            <a href="{{ url('/ProductView/' . $navbarItem->products->id) }}"
                                class="{{ $footerLink }}">{{ $navbarItem->products->title }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="mb-6 text-lg font-bold min-[581px]:mt-12">Perusahaan</h4>
            <ul class="space-y-4">
                <li><a href="http://nuansa.com/2019/" target="_blank" rel="noopener noreferrer"
                        class="{{ $footerLink }}">Informasi Perusahaan</a></li>
                <li><a href="{{ url('/Blog') }}" class="{{ $footerLink }}">Blog</a></li>
                <li><a href="{{ url('/Sitemap') }}" class="{{ $footerLink }}">Sitemap</a></li>
            </ul>
            <a href="https://pse.kominfo.go.id/tdpse-detail/13864" target="_blank" rel="noopener noreferrer"
                class="mt-5 block">
                <img src="{{ asset('assets/img/pse.png') }}" alt="Terdaftar di PSE Kominfo" class="w-[172px]"
                    loading="lazy">
            </a>
            <a href="https://e-katalog.lkpp.go.id/katalog/produk/detail/51361898?lang=id&type=general"
                target="_blank" rel="noopener noreferrer" class="mt-5 block">
                <img src="{{ asset('assets/img/lkpp.png') }}" alt="Tersedia di e-Katalog LKPP" class="w-[172px]"
                    loading="lazy">
            </a>
        </div>
    </div>

    <div
        class="flex flex-col items-center gap-4 bg-white px-5 py-4 text-center font-light min-[1501px]:relative min-[1501px]:flex-row">
        <img src="{{ asset('assets/img/Logo NCI.png') }}" alt="PT Nuansa Cerah Informasi"
            class="w-full max-w-[240px] min-[501px]:max-w-[298px] min-[1501px]:ml-[200px]" loading="lazy">
        <p
            class="text-xs min-[501px]:text-base min-[1501px]:absolute min-[1501px]:left-1/2 min-[1501px]:-translate-x-1/2">
            Copyright &copy; {{ now()->year }} PT NUANSA CERAH INFORMASI
        </p>
    </div>
</footer>
