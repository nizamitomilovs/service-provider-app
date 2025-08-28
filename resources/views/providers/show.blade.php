@extends('layouts.main')

@push('head')
    <link rel="preload" as="image" href="{{ $provider->logo }}">

    <meta name="description" content="{{ Str::limit($provider->short_description, 160) }}">
@endpush

@section('content')
    <div class="container max-w-6xl mx-auto py-8 lg:py-12">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center gap-1 text-sm text-gray-500">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Providers</a>
                </li>
                <li aria-hidden="true" class="px-1 text-gray-400">/</li>
                <li class="text-gray-900 font-medium">{{ $provider->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-7 gap-8">

            <!-- Main -->
            <div class="lg:col-span-5">
                <!-- Hero Card -->
                <section
                    class="relative overflow-hidden rounded-2xl border border-gray-200 bg-gradient-to-tr from-white to-slate-50 shadow-sm">
                    <div class="p-6 sm:p-8">
                        <div class="flex items-start gap-5">
                            <div class="flex-shrink-0 pr-5">
                                <img
                                    src="{{ $provider->logo }}"
                                    alt="{{ $provider->name }} logo"
                                    class="w-24 h-24 rounded-xl object-cover ring-1 ring-gray-200 shadow-sm"
                                    width="96" height="96"
                                    fetchpriority="high"
                                    decoding="async"
                                >
                            </div>

                            <div class="min-w-0 flex-1">
                                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                                    {{ $provider->name }}
                                </h1>

                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span
                                    class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 ring-1 ring-blue-200 px-3 py-1 text-xs font-medium">
                                    {{ $provider->category->name }}
                                </span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">About {{ $provider->name }}</h2>
                            <div class="prose prose-sm max-w-none text-gray-700">
                                {!! nl2br(e($provider->short_description)) !!}
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-2">
                <div class="space-y-4">
                    <a href="{{ url('/') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition">
                        ← Back to Providers
                    </a>
                </div>
            </aside>

        </div>
    </div>
@endsection
