<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();

        return view('AdminPage.Pages.Blog.index', compact('articles'));
    }

    public function showContentBlog1()
    {
        $articles = Article::where('prioritize', 1)->first();
        if (!$articles) {
            abort(404);
        }
        $articles2 = Article::where('prioritize', 2)->latest('created_at')->take(3)->get();
        $articles3 = Article::where('prioritize', 3)->get();

        return view('UserPage.Pages.blog', compact('articles', 'articles2', 'articles3'));
    }

    public function showContentdetailBlog($id)
    {
        $articles = Article::where('id', $id)->first();
        $articles2 = Article::where('id', '!=', $id)
            ->where('prioritize', 2)
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('UserPage.Pages.detail', compact('articles', 'articles2'));
    }

    public function showContentHome()
    {
        $articles = Article::latest('id')->take(12)->get();

        $titleView = $articles->pluck('title');
        $descriptionView = $articles->pluck('description');
        $imageView = $articles->pluck('image');
        $idView = $articles->pluck('id');
        return [
            'titleView' => $titleView,
            'descriptionView' => $descriptionView,
            'imageView' => $imageView,
            'idView' => $idView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('AdminPage.Pages.Blog.create', compact('users'));
        // return view('AdminPage.Pages.Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'adminId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'prioritize' => 'nullable',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }
        // dd($validatedData);
        Article::create($validatedData);
        return redirect('/Article')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $id)
    {

        $articleShow = Article::find($id);

        return view('AdminPage.Pages.Blog.index', compact('articleShow'));
    }

    public function showContent(Article $id)
    {
        $articleShow = Article::find($id);

        if (!$articleShow) {
            abort(404);
        }

        return view('UserPage.Pages.detail', compact('articleShow'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $articles = Article::where('id', $id)->firstorfail();

        $users = User::all();

        return view('AdminPage.Pages.Blog.update', compact('articles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $content = [
            'adminId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'prioritize' => 'nullable',
        ];

        $validatedData = $request->validate($content);

        $articles = Article::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }
        // dd($validatedData);
        $articles->update($validatedData);
        return redirect('/Article')->with('success', 'Data updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        $articles->delete();

        return redirect('/Article')->with('error', 'Data deleted successfully!');
    }
}
