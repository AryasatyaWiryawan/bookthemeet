<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MeetingRequest;
use Carbon\Carbon;

class MeetingRequestFactory extends Factory
{
    protected $model = MeetingRequest::class;

    public function definition()
    {
        $start = Carbon::instance($this->faker->dateTimeBetween('-1 week','+1 week'));
        return [
            'title'      => $this->faker->sentence(3),
            'start_time' => $start,
            'end_time'   => (clone $start)->addMinutes($this->faker->numberBetween(30,120)),
        ];
    }
}
