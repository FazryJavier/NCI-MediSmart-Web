<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/** Public blog: /blog and /blog/{id}-{slug}. */
class BlogController extends Controller
{
    private const COLUMNS = ['id', 'adminId', 'title', 'description', 'image', 'prioritize', 'created_at', 'updated_at'];

    public function index(): View
    {
        $articles = Article::query()->with('Users:id,username')->latest('id')->get(self::COLUMNS);

        // Admin "prioritize": 1 = featured, 2 = highlighted, 3 = list. Fall back to the newest
        // articles so the page never 404s or shows empty blocks when priorities are not set.
        $featured = $articles->firstWhere('prioritize', 1) ?? $articles->first();
        $rest = $articles->reject(fn ($a) => $featured && $a->is($featured));
        $highlights = $rest->where('prioritize', 2)->take(3);
        if ($highlights->isEmpty()) {
            $highlights = $rest->take(3);
        }
        $others = $rest->reject(fn ($a) => $highlights->contains($a))->values();

        return view('UserPage.Pages.blog', [
            'featured' => $featured,
            'highlights' => $highlights->values(),
            'others' => $others,
        ]);
    }

    public function show(string $slug): View|RedirectResponse
    {
        $article = Article::query()->with('Users:id,username')->findOrFail(Article::idFromSlug($slug));

        if ($slug !== $article->publicSlug()) {
            return redirect()->to($article->publicUrl(), 301);
        }

        $recommended = Article::query()->where('id', '!=', $article->id)->where('prioritize', 2)->latest('id')->limit(3)->get(self::COLUMNS);
        if ($recommended->isEmpty()) {
            $recommended = Article::query()->where('id', '!=', $article->id)->latest('id')->limit(3)->get(self::COLUMNS);
        }

        return view('UserPage.Pages.detail', [
            'article' => $article,
            'recommended' => $recommended,
        ]);
    }
}
