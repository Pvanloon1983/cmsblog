<x-layout page="posts">
    <main class="container">
        <div> <a href="{{ route('posts.index') }}">Terug naar alle berichten</a></div>
        <h1>{{ $post->title }}</h1>
        <div>Categorieën: </div>
        <img width="200px" class="post-image-cover" src="{{ asset('storage') . '/' . $post->image }}" alt="{{ $post->title }}">
        <div class="post-content">
            {{ $post->body }}
        </div>
    </main>
</x-layout>
