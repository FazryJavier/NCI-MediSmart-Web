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
        $articles2 = Article::where('prioritize', 2)->take(3)->get();
        $articles3 = Article::where('prioritize', 3)->get();
        // dd($articles2);

        return view('UserPage.Pages.blog', compact('articles', 'articles2', 'articles3'));
    }

    public function showContentdetailBlog($id)
    {
        $articles = Article::where('id', $id)->first();
        $articles2 = Article::where('prioritize', 2)->take(3)->get();

        return view('UserPage.Pages.detail', compact('articles', 'articles2'));
        // dd($id);
    }

    public function showContentHome()
    {
        $titleView = Article::pluck('title');
        $descriptionView = Article::pluck('description');
        $imageView = Article::pluck('image');

        return [
            'titleView' => $titleView,
            'descriptionView' => $descriptionView,
            'imageView' => $imageView,
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
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'prioritize' => 'nullable',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }
        // dd($validatedData);
        Article::create($validatedData);
        return redirect('/Article');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $id)
    {

        $articleShow = Article::find($id);

        return view('AdminPage.Pages.Blog.index', compact('articleShow'));
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
            'image' => 'image|mimes:jpeg,png,jpg,gif',
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
        return redirect('/Article');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        $articles->delete();

        return redirect('/Article');
    }
}
