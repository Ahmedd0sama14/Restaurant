<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\Restaurant;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Restaurant $restaurant)
    {
        $restaurant->load('branches');
        return view('admin.branch.index',compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create  (Restaurant $restaurant )
    {
        return view('admin.branch.create',compact('restaurant'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request, Restaurant $restaurant)
    {

        $data = $request->validated();
        $data['restaurant_id'] = $restaurant->id;
        Branch::create($data);
        return redirect()->route('admin.restaurants.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Restaurant $restaurant,Branch $branch)
    {
        return view('admin.branch.edit',compact('branch','restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request,Restaurant $restaurant ,Branch $branch)
    {
        $data = $request->validated();
        $branch->update($data);
        return redirect()->route('admin.restaurants.show',$restaurant)->with('success','Branch Updated Successfully');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant,Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.restaurants.show',$restaurant)->with('success','Branch Deleted Successfully');
    }
}
