<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return Article[]|Collection
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'value' => 'required|numeric',
            'active' => 'numeric'
        ]);

//        $user = Auth::user();
//        if (!$user->is_admin) {
//            return response()->json(['error' => 'User not admin', 403]);
//        }

        $article = Article::create($validated);
        $success['id'] = $article->id;
        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Article
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return void
     */
    public function edit(Article $article)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return void
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => 'min:2|max:255',
            'value' => 'numeric',
            'active' => 'numeric'
        ]);
//        return response()->json(['a' => $validated], $this->successStatus);
        $article->update($validated);
        return response()->json(['article' => $article], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return void
     *
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }
}
