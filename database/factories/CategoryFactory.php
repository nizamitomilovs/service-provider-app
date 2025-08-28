<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * @return array<string, string>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(nb: 2, asText: true);

        return [
            'name' => ucwords($name),
        ];
    }
}
