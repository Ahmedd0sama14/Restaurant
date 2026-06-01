<?php

namespace App\Helpers;

use App\Enums\Course\CourseDiscountTypeEnum;
if(!function_exists('priceAfterDiscount')){

     function priceAfterDiscount(float $price, float $discount, string $type)
    {
        if ($type === CourseDiscountTypeEnum::Percentage->value) {
            return $price - ($price * $discount / 100);
        }
        return $price - $discount;
    }
}
