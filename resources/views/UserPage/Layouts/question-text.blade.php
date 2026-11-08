{{-- Text block of the CTA banner (used on the image banner and on the mobile gradient card). --}}
<div class="text-white">
    <h2 class="text-2xl font-bold leading-tight sm:text-3xl xl:text-[2rem]">{{ $ctaContent['titleView'] }}</h2>
    @if (filled($ctaContent['descriptionView']))
        <p class="mt-3 line-clamp-3 text-base font-medium text-white/90 xl:mt-4 xl:text-lg">{{ $ctaContent['descriptionView'] }}</p>
    @endif
    @if ($ctaWa)
        <a href="https://api.whatsapp.com/send?phone={{ urlencode($ctaWa) }}" target="_blank" rel="noopener noreferrer"
            class="btn btn-primary mt-6 shadow-lg xl:mt-8">
            <x-icon name="whatsapp" />Konsultasi
        </a>
    @endif
</div>
