<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stage\StoreStageRequest;
use App\Http\Requests\Stage\UpdateStageRequest;
use App\Models\EducationType\EducationTypes;
use App\Models\Stages\Stages;


class StagesController extends Controller
{
    public function index(EducationTypes $EducationType)
    {
        $stages = Stages::with('parent')->whereNull('parent_id')->where('education_type_id', $EducationType->id)->get();
        return view('admin.stages.index', compact('stages', 'EducationType'));
    }
    public function show(EducationTypes $EducationType, Stages $Stage)
    {
        $children = Stages::where('parent_id', $Stage->id)->get();
        $next = null;
        if ($Stage->type && $EducationType->type) {
            $next = $Stage->type->next($EducationType->type->value);
        }
        return view('admin.stages.show', compact('Stage', 'EducationType', 'children', 'next'));
    }
    public function create(EducationTypes $EducationType)
    {

        $parentId = request('parent_id');
        $parent = null;
        $next = null;
        if ($parentId) {
            $parent = Stages::findOrFail($parentId);

            if ($parent->type && $EducationType->type) {
                $next = $parent->type->next($EducationType->type->value);
            }
        }

        return view('admin.stages.create', compact('EducationType', 'parentId', 'parent', 'next'));
    }
    public function store(StoreStageRequest $request)
    {

        $data = $request->validated();
        $stage = Stages::create($data);
        return redirect()->route('EducationTypes.Stages.index', $stage->education_type_id);
    }
    public function edit(EducationTypes $EducationType, Stages $Stage)
    {
        $Stage->load('translations');

        return view('admin.stages.edit', compact('EducationType', 'Stage'));
    }
    public function update(UpdateStageRequest $request,EducationTypes $EducationType, Stages $Stage)
    {
        $data = $request->validated();
        $Stage->update($data);
        return redirect()->route('EducationTypes.Stages.index', $EducationType);
    }

    public function destroy(EducationTypes $EducationType, Stages $Stage)
    {
        $Stage->delete();
        return redirect()->route('EducationTypes.Stages.index', $EducationType->id);
    }
}
