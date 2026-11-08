{{-- Call-to-action "Konsultasi" banner. --}}
<section class="reveal w-full bg-mist py-12">
    <div class="px-[5%] py-2.5">
        <div class="flex justify-end rounded-[40px] bg-cover bg-center px-10 py-20 min-[721px]:px-0 min-[721px]:py-[100px]"
            @if ($ctaContent['imageView']) style="background-image: url('{{ $ctaContent['imageView'] }}')" @endif>
            <div class="w-full text-white min-[721px]:w-[65%] min-[721px]:pr-[70px]">
                <h2 class="mb-5 text-lg font-bold min-[381px]:text-2xl min-[581px]:text-[32px] min-[581px]:leading-tight">
                    {{ $ctaContent['titleView'] }}</h2>
                <p class="mb-12 text-xs font-medium min-[381px]:text-base min-[581px]:text-xl">
                    {{ $ctaContent['descriptionView'] }}</p>
                @foreach ($whatsappContent['whatsappView'] as $phone_number)
                    <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="inline-block rounded-[10px] bg-brand px-5 py-1.5 text-center text-xs text-white transition hover:bg-[#09331b] min-[381px]:px-7 min-[381px]:py-2.5 min-[381px]:text-base min-[581px]:px-[60px] min-[581px]:py-4 min-[581px]:text-xl">
                        Konsultasi
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
