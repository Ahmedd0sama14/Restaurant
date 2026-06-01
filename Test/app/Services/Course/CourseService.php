<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\FileService\FileService;
use Illuminate\Support\Facades\DB;

use function App\Helpers\priceAfterDiscount;

class CourseService
{
    public function __construct(protected FileService $fileService) {}


    public function create(array $data): Course
    {
        try {
            DB::beginTransaction();
            $data['price_after_discount'] = priceAfterDiscount($data['price'], $data['discount'], $data['discount_type']);
            $data['image'] = $this->fileService->HandleFile($data['image'], null, 'courses');
            $data['introduction_video'] = $this->fileService->HandleFile($data['introduction_video'], null, 'introduction_video');
            $course = Course::create($data);
            DB::commit();
            return $course;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function update(array $data, Course $course): void
    {
        DB::beginTransaction();

        try {
            if (isset($data['image'])) {
                $data['image'] = $this->fileService->handleFile($data['image'], $course->image, 'image');
            }
            if (isset($data['introduction_video'])) {
                $data['introduction_video'] = $this->fileService->handleFile($data['introduction_video'], $course->introduction_video, 'introduction_video');
            }
            $data['discount_type'] = $data['discount_type'] ?? $course->discount_type;
            $data['discount'] = $data['discount'] ?? $course->discount;
            $data['price_after_discount'] = priceAfterDiscount($data['price'], $data['discount'], $data['discount_type']);
            $course->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function delete(Course $course): void
    {
        try {
            DB::beginTransaction();
            $this->fileService->deleteFile($course->image);
            $this->fileService->deleteFile($course->introduction_video);
            $course->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
