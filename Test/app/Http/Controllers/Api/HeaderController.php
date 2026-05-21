<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeaderRequest;
use App\Http\Requests\UpdateHeaderRequest;
use App\Http\Resources\HeaderResource;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::latest()->paginate(5);
        return response()->json([
            'message' => 'success',
            'data' => HeaderResource::collection($headers),
        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeaderRequest $request)
    {
        $data = $request->validated();

        $imagePath = $request->file('image')->store('headers', 'public');
        $data['image'] = $imagePath;
        $header = Header::create($data);
        return response()->json([
            'message' => 'success',
            'data' => new HeaderResource($header),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        return response()->json([
            'message' => 'success',
            'data' => new HeaderResource($header),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeaderRequest $request, Header $header)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($header->image);
            $imagePath = $request->file('image')->store('headers', 'public');
            $data['image'] = $imagePath;
        }

        $header->update($data);
        return response()->json([
            'message' => 'Updated successfully',
            'data' => new HeaderResource($header),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Header $header)
    {
        Storage::disk('public')->delete($header->image);
        $header->delete();
        return response()->json([
            'message' => ' deleted ',

        ],200);
    }
}