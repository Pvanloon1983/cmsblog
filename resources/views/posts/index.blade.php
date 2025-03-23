<x-layout>
    <main class="container">
        <h1>Alle posts</h1>
        <a href="{{ route('dashboard') }}">Terug naar dashboard</a>
        {{-- Session Messages --}}
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="posts-table">
            @if ($posts->count())
            <table>
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Bekijken</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td><img width="100" src="{{ asset('storage') . '/' . $post->image }}" alt=""></td>
                            <td><a href="{{ route('posts.show', $post->id) }}">Bekijken</a></td>
                            <td><a href="{{ route('posts.edit', $post->id) }}">Bewerken</a></td>
                            <td>
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>Er zijn geen posts!</p>
            @endif
        </div>
    </main>
</x-layout>
