<x-layout page="posts">
    <main class="container">
        <div class="dashboard">
        <h1>Voeg een categorie toe</h1>
        <a class="back-to-dashboard" href="{{ route('categories.index') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar alle categorieën</a>
        <form class="form" action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="name">Naam</label>
                <input name="name" type="text" id="name" value="{{ old('name') }}">
                @error('name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Toevoegen</button>
            </div>
        </form>
        </div>
    </main>
</x-layout>
