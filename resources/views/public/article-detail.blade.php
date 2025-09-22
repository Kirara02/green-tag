@extends('layouts.public')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6"
            aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('landing') }}"
                        class="text-gray-600 hover:text-green-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        {{ __('public.home') }}
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <a href="{{ route('educations.public.index') }}"
                        class="text-gray-600 hover:text-green-700 transition-colors">{{ __('public.educations_breadcrumb') }}</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700">{{ Str::limit($article->title, 30) }}</span>
                </li>
            </ol>
        </nav>

        <!-- Article Content -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- @if ($article->image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                        class="w-full h-64 md:h-80 object-cover">
                    <div class="absolute top-4 left-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            {{ $article->category }}
                        </span>
                    </div>
                </div>
            @else
                <div
                    class="w-full h-64 md:h-80 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
            @endif --}}

            @php
                // Panggil helper untuk mendapatkan URL embed yang benar
                $embedUrl = getYoutubeEmbedUrl($article->video_url);
            @endphp

            {{-- Prioritaskan Video Jika Ada, Jika Tidak Tampilkan Gambar --}}
            @if ($embedUrl)
                <div class="relative w-full pt-[56.25%] bg-black rounded-t-xl overflow-hidden">
                    <iframe src="{{ $embedUrl }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="absolute top-0 left-0 w-full h-full">
                    </iframe>
                </div>
            @elseif ($article->image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                        class="w-full h-64 md:h-80 object-cover">
                </div>
            @else
                <div
                    class="w-full h-64 md:h-80 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
            @endif

            <div class="p-8">
                <!-- Article Header -->
                <div class="mb-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ __('public.article_detail_author') }}:
                                {{ $article->author->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ __('public.article_detail_published') }}:
                                {{ $article->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $article->category }}</span>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    {!! $article->content !!}
                </div>

                <!-- Article Footer -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ $article->category }}
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related Articles -->
        @if ($relatedArticles->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ __('public.article_detail_related') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedArticles as $relatedArticle)
                        <article
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                            @if ($relatedArticle->image)
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $relatedArticle->image) }}"
                                        alt="{{ $relatedArticle->title }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            {{ $relatedArticle->category }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3
                                    class="font-bold text-lg text-gray-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2">
                                    {{ $relatedArticle->title }}
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($relatedArticle->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">
                                        {{ $relatedArticle->created_at->format('d M Y') }}
                                    </span>
                                    <a href="{{ route('public.article', $relatedArticle->slug) }}"
                                        class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm transition-colors">
                                        {{ __('public.read_more') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back to Articles -->
        <div class="mt-12 text-center">
            <a href="{{ route('educations.public.index') }}"
                class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                {{ __('public.article_detail_back') }}
            </a>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop"
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 opacity-0 invisible">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <script>
        // Scroll to top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
@endsection
