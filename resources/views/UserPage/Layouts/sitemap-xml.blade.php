{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @php
        $lastmod = fn ($model) => optional($model->updated_at)->tz('UTC')->toAtomString();
        $pages = [
            ['route' => 'home', 'freq' => 'weekly', 'priority' => '1.0'],
            ['route' => 'about', 'freq' => 'monthly', 'priority' => '0.6'],
            ['route' => 'testimoni', 'freq' => 'monthly', 'priority' => '0.5'],
            ['route' => 'blog.index', 'freq' => 'weekly', 'priority' => '0.6'],
            ['route' => 'demo', 'freq' => 'yearly', 'priority' => '0.5'],
            ['route' => 'sitemap', 'freq' => 'monthly', 'priority' => '0.3'],
        ];
    @endphp

    {{-- Halaman utama --}}
    @foreach ($pages as $page)
        <url>
            <loc>{{ route($page['route']) }}</loc>
            <changefreq>{{ $page['freq'] }}</changefreq>
            <priority>{{ $page['priority'] }}</priority>
        </url>
    @endforeach

    {{-- Produk --}}
    @foreach ($products as $product)
        <url>
            <loc>{{ $product->publicUrl() }}</loc>
            @if ($lastmod($product))<lastmod>{{ $lastmod($product) }}</lastmod>@endif
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Modul --}}
    @foreach ($moduls as $modul)
        <url>
            <loc>{{ $modul->publicUrl() }}</loc>
            @if ($lastmod($modul))<lastmod>{{ $lastmod($modul) }}</lastmod>@endif
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    {{-- Blog --}}
    @foreach ($articles as $article)
        <url>
            <loc>{{ $article->publicUrl() }}</loc>
            @if ($lastmod($article))<lastmod>{{ $lastmod($article) }}</lastmod>@endif
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
