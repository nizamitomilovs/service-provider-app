@extends('layouts.main')

@section('content')
    <div class="container py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Service Providers</h1>
            <p class="text-gray-600">Find the best service providers for your needs</p>
        </div>

        <!-- Category Filter -->

        <div class="mb-4">
            <form action="{{ url('/') }}" method="GET" class="w-full max-w-xs">
                <label for="category_id" class="block text-xs font-medium text-gray-600 mb-1 ml-1">
                    Filter by Category
                </label>

                <div class="relative">
                    <select
                        name="category_id"
                        id="category_id"
                        onchange="this.form.submit()"
                        class="block p-2 w-44 md:w-56 appearance-none rounded-lg border border-gray-300 bg-white py-2 pl-3 pr-9 text-sm shadow-sm
                       hover:border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 transition"
                    >
                        <option value="">All</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Providers Grid -->
        @if($providers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($providers as $provider)
                    <div
                        class="provider-card bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ $provider->logo }}"
                                     alt="{{ $provider->name }} logo"
                                     class="w-16 h-16 rounded-lg object-cover"
                                     loading="lazy">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('providers.show', $provider) }}" class="hover:text-blue-600">
                                        {{ $provider->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($provider->short_description, 120) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                        {{ $provider->category->name }}
                                    </span>
                                    <a href="{{ route('providers.show', $provider) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Profile →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $providers->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-500 text-lg">
                    No providers found.
                </div>
            </div>
        @endif
    </div>
@endsection
