@extends('UserPage.Layouts.app')

@section('title', 'Blog - NCI Medismart')
@section('description', 'Berita, artikel, dan update terbaru seputar SIMRS NCI Medismart.')

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Blog --}}
    <section class="reveal">
        <div class="py-10">
            <div class="page-container">
                <h1 class="mb-12 text-2xl font-bold">NCIMedismart/Blog</h1>

                @if ($articles)
                    <article class="block min-[1201px]:flex">
                        <div class="text-center min-[1201px]:flex-1">
                            <img src="{{ asset('storage/' . $articles->image) }}" alt="{{ $articles->title }}"
                                class="mx-auto w-full max-w-[800px] min-[1201px]:max-w-[1200px]">
                        </div>
                        <div class="border-b-2 border-brand px-7 py-5 min-[1201px]:flex-1 min-[1201px]:px-12">
                            <h2 class="mb-7 text-[26px] font-bold leading-[30px] text-ink">{{ $articles->title }}</h2>
                            <p class="mb-7 line-clamp-5 text-xl font-medium tracking-[2px] text-muted">
                                {{ strip_tags($articles->description) }}</p>
                            <a href="{{ url('/DetailBlog/' . $articles->id) }}"
                                class="text-lg leading-8 text-brand-link hover:underline">Pelajari Lanjut...</a>
                            <div class="mt-7 flex gap-5 text-lg">
                                <p class="font-bold text-ink">{{ optional($articles->Users)->username }}</p>
                                <time class="text-[#b9b9b9]" datetime="{{ $articles->created_at?->toIso8601String() }}">
                                    {{ $articles->created_at }}</time>
                            </div>
                        </div>
                    </article>
                @endif

                <div class="mt-5 border-b border-muted min-[1201px]:mt-12">
                    <div class="grid grid-cols-1 gap-x-7 gap-y-5 md:grid-cols-2 min-[1201px]:gap-x-12 min-[1201px]:gap-y-[60px]">
                        @foreach ($articles2 as $ar2)
                            <article class="p-5">
                                <div class="overflow-hidden text-center">
                                    <img src="{{ asset('storage/' . $ar2->image) }}" alt="{{ $ar2->title }}"
                                        class="mx-auto mb-2.5 w-full max-w-[450px]" loading="lazy">
                                </div>
                                <div class="p-2.5">
                                    <h3 class="mb-2.5 text-xl font-bold text-ink">{{ $ar2->title }}</h3>
                                    <p class="mb-2.5 line-clamp-4 text-justify text-base text-muted">
                                        {{ strip_tags($ar2->description) }}</p>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('/DetailBlog/' . $ar2->id) }}"
                                        class="text-lg text-brand-link hover:underline">Pelajari Lanjut</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('UserPage.Layouts.question')

    {{-- Article list --}}
    <section class="reveal">
        <div class="py-10" x-data="loadMore({ initial: 3, step: 2, total: {{ count($articles3) }} })">
            <div class="page-container">
                <div class="grid gap-7">
                    @foreach ($articles3 as $ar3)
                        <article class="block min-[992px]:flex" x-show="{{ $loop->index }} < visible"
                            @if ($loop->index >= 3) x-cloak @endif>
                            <img src="{{ asset('storage/' . $ar3->image) }}" alt="{{ $ar3->title }}"
                                class="w-full max-w-[500px] shrink-0" loading="lazy">
                            <div class="px-7 py-5">
                                <h3 class="mb-5 text-[22px] font-bold">{{ $ar3->title }}</h3>
                                <p class="mb-7 line-clamp-5 text-lg text-muted">{{ strip_tags($ar3->description) }}</p>
                                <a href="{{ url('/DetailBlog/' . $ar3->id) }}"
                                    class="text-lg text-brand-link hover:underline">Pelajari Lanjut</a>
                            </div>
                        </article>
                    @endforeach

                    <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                        <button type="button" @click="more()"
                            class="inline-block rounded-[10px] border border-brand px-[60px] py-4 text-xl text-brand transition hover:bg-brand hover:text-white">
                            Muat Lebih Banyak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
