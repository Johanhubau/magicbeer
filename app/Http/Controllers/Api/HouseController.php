<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\House;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HouseController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return House[]|Collection
     */
    public function index()
    {
        return House::all();
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
            'points' => 'required|number',
        ]);

//        $user = Auth::user();
//        if (!$user->is_admin) {
//            return response()->json(['error' => 'User not admin', 403]);
//        }

        $house = House::create($validated);
        $success['id'] = $house->id;
        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param House $house
     * @return House
     */
    public function show(House $house)
    {
        return $house;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param House $house
     * @return void
     */
    public function edit(House $house)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param House $house
     * @return void
     */
    public function update(Request $request, House $house)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'points' => 'required|number',
        ]);

        $house->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param House $house
     * @return void
     *
     * @throws \Exception
     */
    public function destroy(House $house)
    {
        $house->delete();
    }
}
