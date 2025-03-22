<x-layout>
    <main class="container">
        <h1>Alle posts</h1>
        <div class="posts-table">
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

                @if ($posts)
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><img width="100" src="{{ asset('storage') . '/' . $post->image }}" alt=""></td>
                        <td>Bekijken</td>
                        <td>Bewerken</td>
                        <td>Verwijderen</td>
                    </tr>
                @endforeach
                @else
                    <p>Er zijn geen posts!</p>
                @endif



                </tbody>
            </table>
        </div>
    </main>
</x-layout>
