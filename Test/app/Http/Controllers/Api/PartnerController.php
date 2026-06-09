<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\StoreRequest;
use App\Http\Requests\Partner\UpdateRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Traits\RespondTrait;


class PartnerController extends Controller
{
    use RespondTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return $this->successResponse( PartnerResource::collection($partners), 'Success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $partner = Partner::create($data);
        return $this->successResponse(new PartnerResource($partner), 'Success', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return $this->errorResponse('Partner not found', 404);
        }
        return $this->successResponse(new PartnerResource($partner), 'Success', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $partner = Partner::findOrFail($id);
        $partner->update($data);
        return $this->successResponse(new PartnerResource($partner), 'Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return $this->errorResponse('Partner not found', 404);
        }
        $partner->delete();
        return $this->successResponse([], 'Success', 200);
    }
}
