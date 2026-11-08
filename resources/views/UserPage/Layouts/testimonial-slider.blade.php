{{--
    Testimonial carousel shared by product and modul pages.
    @param array<int, array{image: ?string, name: ?string, description: ?string}> $testimonials
    @param int $desktopSlides slides per view from 991px (default 2)
--}}
@php($desktopSlides = $desktopSlides ?? 2)
<section class="reveal bg-mist py-5">
    <div class="page-container">
        <h2 class="pb-10 pt-2.5 text-center text-xl min-[361px]:text-2xl min-[581px]:text-[28px] min-[801px]:text-[32px]">
            Apa kata klien tentang kami</h2>
        <div class="swiper text-center" x-data
            x-init="initSwiper($el, { slidesPerView: 1, loop: {{ count($testimonials) > $desktopSlides ? 'true' : 'false' }}, spaceBetween: 10, breakpoints: { 991: { slidesPerView: {{ $desktopSlides }}, spaceBetween: 30 } } })">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide mb-12 px-5 py-5 text-ink min-[581px]:px-12 xl:px-[100px]">
                        @if ($testimonial['image'])
                            <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                alt="Logo {{ $testimonial['name'] }}" class="mx-auto w-full max-w-[100px]"
                                loading="lazy">
                        @endif
                        <h3 class="py-2.5 text-lg font-medium min-[361px]:text-xl">{{ $testimonial['name'] }}</h3>
                        <p class="text-sm min-[361px]:text-base">{{ $testimonial['description'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next nav-btn !bg-mist max-[900px]:!hidden"></div>
            <div class="swiper-button-prev nav-btn !bg-mist max-[900px]:!hidden"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
