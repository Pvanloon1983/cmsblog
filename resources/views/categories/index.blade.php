<x-layout page="categories">
    <main class="container">
        <div class="dashboard">
        <h1>Alle Categorieën</h1>
        <div class="btn-box">
            <a class="back-to-dashboard" href="{{ route('dashboard') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar dashboard</a>
            <a href="{{ route('categories.create') }}"><button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Categorie toevoegen</button></a>
        </div>
        {{-- Session Messages --}}
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        <div class="dashboard-table categories-table">
            @if ($categories->count())
                <div class="dashboard-table-wrapper">
                <table>
                    <thead>
                    <th>ID</th>
                    <th>Naam</th>
                    <th colspan="2">Actie</th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="action">
                                <a class="btn edit" href="{{ route('categories.edit', $category->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form class="form" action="{{ route('categories.destroy', $category) }}" method="post">
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
                <p>Er zijn geen categorieën!</p>
            @endif
        </div>
        </div>
    </main>
</x-layout>
