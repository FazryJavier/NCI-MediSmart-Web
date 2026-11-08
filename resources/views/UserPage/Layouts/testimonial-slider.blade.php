{{--
    Testimonial carousel shared by product and modul pages.
    @param array<int, array{image: ?string, name: ?string, description: ?string}> $testimonials
    @param int $desktopSlides slides per view from 991px (default 2)
--}}
@php($desktopSlides = $desktopSlides ?? 2)
@if (! empty($testimonials))
<section class="reveal bg-white py-12 sm:py-14">
    <div class="page-container">
        <h2 class="pb-8 text-center text-2xl text-ink sm:text-3xl">Apa kata <strong>Klien</strong> tentang <strong>Kami</strong></h2>
        <div class="swiper text-center" x-data
            x-init="initSwiper($el, { slidesPerView: 1, loop: {{ count($testimonials) > $desktopSlides ? 'true' : 'false' }}, spaceBetween: 10, breakpoints: { 991: { slidesPerView: {{ $desktopSlides }}, spaceBetween: 30 } } })">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide mb-12 px-5 py-5 text-ink min-[581px]:px-12 xl:px-[100px]">
                        @if ($testimonial['image'])
                            <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                alt="Logo {{ $testimonial['name'] }}" class="mx-auto h-16 w-auto max-w-[140px] object-contain"
                                loading="lazy">
                        @endif
                        <h3 class="pt-4 text-base font-medium">{{ $testimonial['name'] }}</h3>
                        <p class="mx-auto mt-3 max-w-md text-sm leading-relaxed text-ink/75">&ldquo;{{ $testimonial['description'] }}&rdquo;</p>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next nav-btn !bg-white max-[900px]:!hidden"></div>
            <div class="swiper-button-prev nav-btn !bg-white max-[900px]:!hidden"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
