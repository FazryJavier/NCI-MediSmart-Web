{{-- Call-to-action "Konsultasi" banner. Hidden until a CTA title has been configured. --}}
@if (filled($ctaContent['titleView']))
    @php($ctaWa = collect($whatsappContent['whatsappView'])->first())
    <section class="reveal w-full bg-mist py-12">
        <div class="page-container">
            <div class="relative flex justify-end overflow-hidden rounded-3xl bg-brand-dark bg-cover bg-center px-6 py-14 sm:rounded-[40px] sm:px-12 sm:py-20 lg:py-24"
                @if ($ctaContent['imageView']) style="background-image: url('{{ $ctaContent['imageView'] }}')" @endif>
                {{-- Keeps the text readable on any uploaded background image. --}}
                <div class="absolute inset-0 bg-gradient-to-l from-black/60 via-black/30 to-transparent" aria-hidden="true"></div>
                <div class="relative w-full text-white md:w-[60%]">
                    <h2 class="text-2xl font-bold leading-tight sm:text-3xl lg:text-[2rem]">{{ $ctaContent['titleView'] }}</h2>
                    @if (filled($ctaContent['descriptionView']))
                        <p class="mt-4 text-base font-medium text-white/90 sm:text-lg">{{ $ctaContent['descriptionView'] }}</p>
                    @endif
                    @if ($ctaWa)
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($ctaWa) }}" target="_blank"
                            rel="noopener noreferrer" class="btn btn-primary mt-8">
                            <x-icon name="whatsapp" />Konsultasi
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
