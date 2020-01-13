<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\House;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return Transaction[]|Collection
     */
    public function index()
    {
        return Transaction::all();
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
            'author_id' => 'exists:users,id',
            'article_id' => 'exists:articles,id',
            'house_id' => 'exists:houses,id',
            'points' => 'required|numeric',
        ]);

        $transaction = Transaction::create($validated);
        $success['id'] = $transaction->id;
        $house = House::where('id', $validated['house_id'])->first();
//        return response()->json(['success' => $success, 'house' => $house], $this->successStatus);
        $house->points = $house->points + $validated['points'];
        $house->save();
        return response()->json(['success' => $success, 'house' => $house], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Transaction
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function edit(Transaction $transaction)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return void
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'author_id' => 'exists:users,id',
            'article_id' => 'exists:articles,id',
            'house_id' => 'exists:houses,id',
            'value' => 'required|number',
        ]);

        $transaction->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return void
     *
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}
