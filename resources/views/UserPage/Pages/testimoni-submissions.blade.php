@extends('UserPage.Layouts.app')

@section('title', 'Testimoni Masuk | NCI Medismart')
@section('robots', 'noindex, nofollow')

{{-- Admin-only (auth): testimonials sent through the public form, waiting for review. --}}
@section('content')
    <section class="bg-mist">
        <div class="page-container py-10 sm:py-14">
            <h1 class="text-2xl font-bold text-ink sm:text-3xl">Testimoni Masuk</h1>
            <p class="mt-2 text-base text-ink/70">Kiriman dari form testimoni. Belum tampil di website: salin yang layak ke menu <strong>Feedback</strong> di admin.</p>

            @if ($submissions->isEmpty())
                <p class="mt-8 rounded-xl bg-white p-8 text-center text-ink/70">Belum ada testimoni masuk.</p>
            @else
                <div class="mt-8 space-y-4">
                    @foreach ($submissions as $item)
                        <article class="rounded-xl border border-black/10 bg-white p-6 shadow-sm">
                            <div class="flex flex-wrap items-baseline justify-between gap-2">
                                <h2 class="text-lg font-bold text-ink">{{ $item['instance_name'] ?? '-' }}</h2>
                                @if ($item['submitted_at'])
                                    <time class="text-sm text-ink/50" datetime="{{ $item['submitted_at']->toIso8601String() }}">
                                        {{ $item['submitted_at']->timezone(config('app.timezone'))->format('d/m/Y H:i') }}</time>
                                @endif
                            </div>
                            <p class="mt-1 text-sm text-ink/70">
                                {{ $item['name'] ?? '-' }} · {{ $item['position'] ?? '-' }} · {{ $item['email'] ?? '-' }}
                                @if (! empty($item['phone_number'])) · {{ $item['phone_number'] }} @endif
                            </p>
                            <p class="mt-4 whitespace-pre-line text-base leading-relaxed text-ink">{{ $item['testimonial'] ?? '' }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
