<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeaderRequest;
use App\Http\Requests\UpdateHeaderRequest;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::latest()->paginate(5);
        return view('headers.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('headers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeaderRequest $request)
    {
        $data=$request->validated();

        $imagePath = $request->file('image')->store('headers', 'public');
        $data['image'] = $imagePath;
        Header::create($data);
        return to_route('headers.index')->with('success',' created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        return view('headers.show', compact('header'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Header $header)
    {
        return view('headers.edit', compact('header'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeaderRequest $request, Header $header)
    {
        $data=$request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($header->image);
            $imagePath = $request->file('image')->store('headers', 'public');
            $data['image'] = $imagePath;
        }

        $header->update($data);
        return to_route('headers.index')->with('success',' updated');

    }

    /**
     * Remove the specified resource from storage. 
     */
    public function destroy(Header $header)
    {
        Storage::disk('public')->delete($header->image);
        $header->delete();
        return to_route('headers.index')->with('success','deleted .');
    }
}
