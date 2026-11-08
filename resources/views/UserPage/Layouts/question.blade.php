{{--
    Call-to-action "Konsultasi" banner. Hidden until a CTA title has been configured.

    The uploaded CTA image is a complete banner: a rounded card plus a transparent area above it, so the
    person's head overflows the card. It is therefore shown as-is (no background colour, no clipping,
    no cropping) and the text is laid over the card area on the right. On smaller screens, where the
    banner would be too short for the text, a plain gradient card is shown instead.
--}}
@if (filled($ctaContent['titleView']))
    @php
        $ctaWa = collect($whatsappContent['whatsappView'])->first();
        $ctaImage = $ctaContent['imageView'];
    @endphp
    <section class="reveal w-full bg-mist py-12 sm:py-16">
        <div class="page-container">
            @if ($ctaImage)
                <div class="relative hidden lg:block">
                    <img src="{{ $ctaImage }}" alt="" class="block h-auto w-full" loading="lazy" decoding="async">
                    {{-- The card starts ~20% from the top of the banner; text is centred inside the card on the right. --}}
                    <div class="absolute bottom-0 right-0 top-[20%] flex w-[60%] items-center pr-[5%]">
                        @include('UserPage.Layouts.question-text', ['ctaWa' => $ctaWa])
                    </div>
                </div>
            @endif

            <div class="{{ $ctaImage ? 'lg:hidden' : '' }} rounded-3xl bg-gradient-to-r from-brand to-[#15596b] px-6 py-12 sm:rounded-[40px] sm:px-12 sm:py-16">
                @include('UserPage.Layouts.question-text', ['ctaWa' => $ctaWa])
            </div>
        </div>
    </section>
@endif
