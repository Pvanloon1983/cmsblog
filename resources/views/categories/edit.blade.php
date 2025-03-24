<x-layout>
    <main class="container">
        <h1>Edit Category</h1>
        <div> <a href="{{ route('categories.index') }}">Terug naar categorieen</a></div>
        <form action="{{ route('categories.update', $category->id) }}" method="post">
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
                <button type="submit">Update</button>
            </div>
        </form>
    </main>
</x-layout>
