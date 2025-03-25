<x-layout page="categories">
    <main class="container">
        <h1>Alle Categorieën</h1>
        <a href="{{ route('dashboard') }}">Terug naar dashboard</a>
        {{-- Session Messages --}}
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="categories-table">
            @if ($categories->count())
                <table>
                    <thead>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{ route('categories.edit', $category->id) }}">Bewerken</a></td>
                            <td>
                                <form action="{{ route('categories.destroy', $category) }}" method="post">
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
                <p>Er zijn geen categorieën!</p>
            @endif
        </div>
    </main>
</x-layout>
