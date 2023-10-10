<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Produk --}}
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/ProductView/' . $product->id) }}</loc>
            <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Modul --}}
    @foreach ($moduls as $modul)
        <url>
            <loc>{{ url('/Modul/' . $modul->id) }}</loc>
            <lastmod>{{ $modul->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    {{-- Lainnya --}}
    <url>
        <loc>{{ url('/HealthcareSolution') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <url>
        <loc>{{ url('/Testimoni') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <url>
        <loc>{{ url('/Blog') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <url>
        <loc>{{ url('/Demo') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Kontak --}}
    @foreach ($whatsappContent['whatsappView'] as $phone_number)
        <url>
            <loc>https://api.whatsapp.com/send?phone={{ $phone_number }}</loc>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    {{-- Blog --}}
    @foreach ($articles as $article)
        <url>
            <loc>{{ url('/DetailBlog/' . $article->id) }}</loc>
            <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
