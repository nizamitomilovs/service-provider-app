<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProviderIndexRequest;
use App\Services\CategoryService;
use App\Services\ProviderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

final class ProviderController extends Controller
{
    public function __construct(
        private readonly ProviderService $providerService,
        private readonly CategoryService $categoryService,
    ) {
    }

    public function index(ProviderIndexRequest $request): Factory|View
    {
        $providers  = $this->providerService->getPaginatedProviders($request);
        $categories = $this->categoryService->getAllCategoriesCached();

        return view('providers.index', compact('providers', 'categories'));
    }

    public function show(string $id): Factory|View
    {
        if (false === Str::isUuid($id, 7)) {
            throw new UnprocessableEntityHttpException('Invalid provider id format.');
        }

        try {
            $provider = $this->providerService->getProvider($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundHttpException('Provider not found', $e);
        }

        return view('providers.show', compact('provider'));
    }
}
