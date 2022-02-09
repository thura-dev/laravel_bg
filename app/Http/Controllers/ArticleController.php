<?php

namespace App\Http\Controllers;

use view;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $data
        ]);
    }
    public function detail($id)
    {
        $data = Article::find($id);
        return view('articles.detail', [
            "article" => $data
        ]);
    }
    public function add()
    {
        $data = [
            ["id" => 1, "name" => "Tech"],
            ["id" => 2, "name" => "New"]
        ];
        return view('articles.add', [
            "categories" => $data
        ]);
    }
    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = Article::create([
            'title' => request()->title,
            'body' => request()->body,
            'category_id' => request()->category_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect('/articles');
    }
    public function delete($id)
    {
        $article = Article::find($id);
        if (Gate::allows('article-delete', $article)) {
            $article->delete();

            return redirect('/articles')->with('info', "Article Successfully Deleted");
        }
    }
}
