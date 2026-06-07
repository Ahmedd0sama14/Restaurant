<?php

namespace App\Http\Controllers\Api;

use App\Enums\Subscription\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Course;
use App\Models\Document;
use App\Models\Subscription;
use App\Services\FileService\FileService;
use App\Traits\RespondTrait;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    use RespondTrait;
    public function __construct(protected FileService $courseService) {}

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $data['image'] = $this->courseService->HandleFile($request->file('image'), null, 'subscriptions');
            if ($data['Type'] == TypeEnum::Document->value){
                $document = Document::find($data['type_id']);
                if(!$document){
                    return $this->errorResponse('Document not found');
                }
                $data['subscribable_id'] = $document->id;
                $data['subscribable_type'] = Document::class;
                $data['price'] = $document->price;
                $data['teacher_id'] = $document->teacher_id;

            } else {
                $course = Course::find($data['type_id']);
                if(!$course){
                    return $this->errorResponse('Document not found');

                }
                $data['subscribable_id'] = $course->id;
                $data['subscribable_type'] = Course::class;
                $data['price'] = $course->price;
                $data['teacher_id'] = $course->teacher_id;
            }
            $result= Subscription::create($data);
            DB::commit();
            return $this->successResponse( new SubscriptionResource($result), 'Success', 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getMessage(), 'Error');
        }
    }
}
