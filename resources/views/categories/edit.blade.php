<x-layout page="posts">
    <main class="container">
        <div class="dashboard">
        <h1>Categorie bijwerken</h1>
        <a class="back-to-dashboard" href="{{ route('categories.index') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar categorieën</a>
        <form class="form" action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-control">
                <label for="name">Naam</label>
                <input name="name" type="text" id="name" value="{{ $category->name }}">
                @error('name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Bijwerken</button>
            </div>
        </form>
        </div>
    </main>
</x-layout>
