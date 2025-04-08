<x-layout page="posts">
    <main class="container">
        <div class="dashboard">
        <h1>Alle berichten</h1>
        <div class="btn-box">
            <a class="back-to-dashboard" href="{{ route('dashboard') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar dashboard</a>
            <a href="{{ route('posts.create') }}"><button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Bericht toevoegen</button></a>
        </div>
        {{-- Session Messages --}}
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        <div class="dashboard-table">
            @if ($posts->count())
            <div class="dashboard-table-wrapper">
            <table>
                <thead>
                    <th>ID</th>
                    <th class="title">Title</th>
                    <th>Categorieën</th>
                    <th>Image</th>
                    <th colspan="3">Actie</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td style="white-space: nowrap" class="title">{{ $post->title }}</td>
                            @if($post->categories->count())
                                <td style="white-space: nowrap">{{ $post->categories->implode('name', ', ') }}</td>
                            @else
                                <td>n/a</td>
                            @endif
                            <td><img width="100" src="{{ asset('storage') . '/' . $post->image }}" alt=""></td>
                            <td class="action">
                                <a class="btn info" href="{{ route('posts.show', $post->id) }}"><i class="fa-solid fa-eye"></i></a>
                                <a class="btn edit" href="{{ route('posts.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form class="form" action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete" type="submit">
                                        <span class="spinner" style="display: none; margin-right: 8px;"></span>
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @else
                <p>Er zijn geen berichten!</p>
            @endif
        </div>
        </div>
    </main>
</x-layout>
