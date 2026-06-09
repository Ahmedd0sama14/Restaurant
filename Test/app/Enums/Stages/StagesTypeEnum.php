<?php

namespace App\Enums\Stages;

use App\Enums\Education\TypeEnum;

enum StagesTypeEnum: int
{
    case COLLEGE = 1;
    case DEPARTMENT = 2;
    case PHASE = 3;
    case YEAR = 4;
    case SEMESTER = 5;

    public function label(): string
    {
        return match ($this) {
            self::COLLEGE => 'College',
            self::DEPARTMENT => 'Department',
            self::PHASE => 'Phase',
            self::YEAR => 'Year',
            self::SEMESTER => 'Semester',
        };
    }

    public function academic(): ?self
    {
        return match ($this) {
            self::COLLEGE    => self::DEPARTMENT,
            self::DEPARTMENT => self::PHASE,
            self::PHASE      => null,
        };
    }

    public function primary(): ?self
    {
        return match ($this) {
            self::PHASE    => self::YEAR,
            self::YEAR     => self::SEMESTER,
            self::SEMESTER => null,
        };
    }
  public function next(int $educationTypeValue): ?self
{
    return match ($educationTypeValue) {
        1 => $this->primary(),
        2 => $this->academic(),
    };
}
}
