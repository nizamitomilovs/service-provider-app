<?php

declare(strict_types=1);

namespace Feature\Http\Controllers\ProviderController;

use Database\Factories\ProviderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ProviderControllerShowTest extends TestCase
{
    use RefreshDatabase;

    public function testProviderPageIsDisplayed(): void
    {
        $provider = ProviderFactory::new()->create();

        $response = $this->get('/providers/' . $provider->id);

        $response->assertOk();
        $response->assertViewIs('providers.show');
        $response->assertViewHas('provider');

        $viewProvider = $response->viewData('provider');
        $this->assertEquals($provider->id, $viewProvider->id);
        $this->assertEquals($provider->name, $viewProvider->name);
    }

    public function testReturnsUnprocessableEntityIfProviderIdIsInvalid(): void
    {
        $response = $this->get('/providers/invalid-id');

        $response->assertUnprocessable();
    }

    public function testReturnsNotFoundIfProviderDoesNotExist(): void
    {
        $response = $this->get('/providers/' . Uuid::uuid7());

        $response->assertNotFound();
    }
}
