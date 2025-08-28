<?php

declare(strict_types=1);

namespace Feature\Http\Controllers\ProviderController;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

final class ProviderControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testProvidersPageIsDisplayed(): void
    {
        Category::factory()->count(5)->create();
        Provider::factory()->count(10)->create();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertViewIs('providers.index');
        $response->assertViewHas('providers');
        $response->assertViewHas('categories');
    }

    public function testWhenCategoryIdIsInvalid(): void
    {
        $response = $this->get('/?category_id=invalid-id');

        $response->assertUnprocessable();
    }

    public function testProvidersPageIsDisplayedWithPagination(): void
    {
        Category::factory()->count(5)->create();
        Provider::factory()->count(50)->create();

        $response = $this->get('/');

        $response->assertOk();

        $viewProviders = $response->viewData('providers');
        $this->assertCount(20, $viewProviders);
        $this->assertTrue($viewProviders->hasPages());
    }

    public function testItFiltersProvidersByCategory(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $provider1 = Provider::factory()->create(['category_id' => $category1->id]);
        $provider2 = Provider::factory()->create(['category_id' => $category2->id]);

        $response = $this->get('/?category_id=' . $category1->id);

        $response->assertOk();
        $response->assertSee($provider1->name);
        $response->assertDontSee($provider2->name);
    }

    public function testItDisplaysCachedCategories(): void
    {
        $categories = Category::factory()->count(5)->create();

        $this->get('/');

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($categories);

        $response = $this->get('/');

        $response->assertOk();
        $viewCategories = $response->viewData('categories');
        $this->assertCount(5, $viewCategories);
    }
}
