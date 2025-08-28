<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

final class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    /**
     * @return array<string, string>
     */
    public function definition(): array
    {
        $name     = $this->faker->company();
        $category = Category::query()->inRandomOrder()->first();

        if (null === $category) {
            $category = Category::factory()->create();
        }

        return [
            'name'              => $name,
            'category_id'       => $category->id,
            'logo'              => FakerPicsumImagesProvider::imageUrl(),
            'short_description' => $this->faker->sentence(12),
        ];
    }
}
