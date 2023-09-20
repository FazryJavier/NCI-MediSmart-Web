<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;

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
    }

    public function showContentBlog2()
    {
    }
    public function showContentBlog3()
    {
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
    public function update(Request $request, Article $article)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
