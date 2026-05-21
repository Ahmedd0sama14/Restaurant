<?php

namespace App\Services;

use App\Enums\Course\CourseDiscountTypeEnum;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class StoreCourseService
{
    public function priceAfterDiscount(float $price, float $discount, string $type): float
    {
        if ($type ==CourseDiscountTypeEnum::Percentage->value) {
            return $price - ($price * $discount / 100);
        } elseif ($type == CourseDiscountTypeEnum::Amount->value) {
            return $price - $discount;
        }
        return $price;
    }
    public function storeimage($image): string
    {
        return $image->store('courses', 'public');
    }
    public function storeVideo($video): string
    {
        return $video->store('course_videos', 'public');
    }

    public function insertCourse(array $data): void
    {
        DB::beginTransaction();
        try {
            $data['price_after_discount'] = $this->priceAfterDiscount($data['price'], $data['discount'], $data['discount_type']);
            $data['image'] = $this->storeimage($data['image']);
            $data['introduction_video'] = $this->storeVideo($data['introduction_video']);
            Course::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
