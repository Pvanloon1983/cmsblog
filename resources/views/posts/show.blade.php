<x-layout page="posts">
    <main class="container">
        <div class="dashboard">
            <h1>{{ $post->title }}</h1>
            <a class="back-to-dashboard" href="{{ route('posts.index') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar alle berichten</a>
            @if ($post->categories->count())
                <div style="margin-bottom: 15px;">
                    <strong>Categorieën:</strong>
                    {{ $post->categories->pluck('name')->join(', ') }}
                </div>
            @endif

            @if ($post->image)
                <img
                    width="100%"
                    height="200px"
                    class="post-image-cover"
                    src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->title }}"
                    style="border-radius: 4px; margin-bottom: 0px; object-fit: cover; object-position: center;"
                >
            @endif

            <div class="post-content" style="line-height: 1.6; font-size: 16px;">
                {!! $post->body !!}
            </div>

            {{--
            <div class="action dashboard-table" style="margin-top: 20px;">
                <a class="btn edit" href="{{ route('posts.edit', $post->id) }}">
                    Bewerken
                </a>

                <form class="form" action="{{ route('posts.destroy', $post) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn delete" type="submit">
                        <span class="spinner" style="display: none; margin-right: 8px;"></span>
                        Verwijderen
                    </button>
                </form>
            </div>
            --}}

        </div>
    </main>
</x-layout>

