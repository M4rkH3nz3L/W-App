@extends('layout.base')

@section('content')
    @php
        // Lekérjük a konfigurációs beállítást
        $homepageType = Config::get('welcome.homepage.type', 'Blog');
    @endphp
    <br>
    @if($homepageType === 'Blog')
    <div class="container mx-auto px-4">
        @if(isset($posts))
        <h1 class="text-4xl font-bold my-4">Blog</h1>
            @foreach ($posts as $post)
                <div class="mb-4 p-4 border rounded shadow">
                    <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                    <p class="text-gray-700">{{ $post->excerpt }}</p>
                    <a href="" class="text-blue-500 hover:underline">Read more</a>
                </div>
            @endforeach

            <!-- Pagination links -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <p>No posts available.</p>
        @endif
    </div>
    @elseif($homepageType === 'Shop')
    <h1 class="text-4xl font-bold my-4">Shop</h1>
    <div class="container mx-auto px-4">
        @if(isset($offers))
            @foreach ($offers as $offer)
                <div class="mb-4 p-4 border rounded shadow">
                    <h2 class="text-2xl font-semibold">{{ $offer->name }}</h2>
                    <p class="text-gray-700">{{ $offer->description }}</p>
                    <p class="font-bold">Price: ${{ $offer->unit_price }}</p>
                    <a href="" class="text-blue-500 hover:underline">View Offer</a>
                </div>
            @endforeach

            <!-- Pagination links -->
            <div class="mt-4">
                {{ $offers->links() }}
            </div>
        @else
            <p>No offers available.</p>
        @endif
    </div>
    @else
    <div class="container mx-auto px-4">
        @if(isset($page))
        <h1 class="text-4xl font-bold my-4">Page</h1>
            <h1 class="text-4xl font-bold my-4">{{ $page->title }}</h1>
            <div class="prose">
                {!! $page->content !!}
            </div>
        @else
            <p>Page not found.</p>
        @endif
    </div>
    @endif
@endsection
