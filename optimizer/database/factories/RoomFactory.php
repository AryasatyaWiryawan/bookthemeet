<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            // supply a random but non-null name
            'name' => 'Room ' . $this->faker->unique()->randomLetter(),
        ];
    }
}
