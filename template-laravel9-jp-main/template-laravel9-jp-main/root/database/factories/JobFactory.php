<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\Job;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    private int $i = 1;

    public function definition()
    {
        return [
            'name' => sprintf('JOB_%04d', $this->i++),
            'deleted_at' => null,
            'created_at' => '2021-12-30 11:22:33',
            'updated_at' => '2021-12-31 23:58:59',
        ];
    }
}

