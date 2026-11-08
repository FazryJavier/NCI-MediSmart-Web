@extends('UserPage.Layouts.app')

@section('title', "{$modul->title} - NCI Medismart")
@section('description', \Illuminate\Support\Str::limit(strip_tags((string) $modul->description), 160))

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Modul intro --}}
    <section class="reveal">
        <div class="bg-gradient-to-r from-brand to-[#28b88d]">
            <div class="page-container">
                <div class="flex flex-col items-center justify-center py-12 min-[992px]:flex-row">
                    <div class="max-w-full text-white min-[992px]:max-w-[60%] min-[992px]:pr-12">
                        <h1 class="mb-5 text-[30px] font-bold min-[1201px]:text-[34px]">{{ $modul->title }}</h1>
                        <p class="text-justify text-lg min-[1201px]:text-[22px]">{{ $modul->description }}</p>
                        <div class="mt-10">
                            @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="inline-block rounded-[10px] bg-white px-10 py-5 text-sm text-brand transition hover:bg-brand-dark hover:text-white min-[1201px]:text-base">
                                    Hubungi Kami
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @if ($imageModul1)
                        <div class="-order-1 mb-5 min-[992px]:order-none min-[992px]:mb-0">
                            <img src="{{ asset('storage/' . $imageModul1->image) }}" alt="{{ $modul->title }}"
                                class="w-full max-w-[800px] rounded-[20px]">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Advantage --}}
    <section class="reveal">
        <div class="page-container">
            <div class="min-[992px]:px-20">
                <h2 class="py-12 text-center text-[28px] font-bold text-ink">{{ $modul->title }}</h2>
                <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] items-center justify-center gap-10 text-center">
                    @foreach ($advantageModulProducts as $advantageModul)
                        <div class="p-5 text-ink">
                            <img src="{{ asset('storage/' . $advantageModul->icon) }}" alt=""
                                class="mx-auto mb-5 h-full max-h-[62px]" loading="lazy">
                            <h3 class="mb-5 text-2xl font-bold">{{ $advantageModul->title }}</h3>
                            <p class="text-lg">{{ $advantageModul->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Fasilitas --}}
    <section class="reveal py-12">
        <div class="bg-mist py-12">
            <div class="page-container">
                <h2 class="mb-12 text-center text-[28px] font-bold text-ink">Fasilitas {{ $modul->title }}</h2>
                <div class="space-y-12">
                    <div class="flex flex-col items-center justify-between gap-5 min-[992px]:flex-row">
                        @if ($imageModul2)
                            <img src="{{ asset('storage/' . $imageModul2->image) }}" alt=""
                                class="w-full max-w-[700px] rounded-[20px]" loading="lazy">
                        @endif
                        <ul class="px-5">
                            @foreach ($listfasilitasModulProducts1 as $fs1)
                                <li class="mb-5 flex text-base text-ink min-[581px]:text-xl">
                                    <x-icon name="circle-check" class="mr-2.5 mt-1 shrink-0 text-brand" />{{ $fs1->description }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-5 min-[992px]:flex-row">
                        <ul class="order-2 px-5 min-[992px]:order-none">
                            @foreach ($listfasilitasModulProducts2 as $fs2)
                                <li class="mb-5 flex text-base text-ink min-[581px]:text-xl">
                                    <x-icon name="circle-check" class="mr-2.5 mt-1 shrink-0 text-brand" />{{ $fs2->description }}
                                </li>
                            @endforeach
                        </ul>
                        @if ($imageModul3)
                            <img src="{{ asset('storage/' . $imageModul3->image) }}" alt=""
                                class="w-full max-w-[700px] rounded-[20px]" loading="lazy">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('UserPage.Layouts.testimonial-slider', [
        'testimonials' => collect($feedback)
            ->map(fn ($fd) => [
                'image' => $fd->image,
                'name' => $fd->name,
                'description' => $fd->description,
            ])
            ->values()
            ->all(),
    ])

    @include('UserPage.Layouts.question')
@endsection
