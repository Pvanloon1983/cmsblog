<x-layout page="posts">
    <main class="container">
        <h1>Voeg een nieuw bericht toe</h1>
        <a href="{{ route('dashboard') }}">Terug naar dashboard</a>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-control">
                <label for="title">Title</label>
                <input name="title" type="text" id="title" value="{{ old('title') }}">
                @error('title')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <label for="body">Inhoud</label>
                <textarea name="body" id="body">
                    {{ old('body') }}
                </textarea>
                @error('body')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            @if($categories->count())
            <div class="form-control">
                <label for="categories">Categorie</label>
                <select name="categories[]" id="categories" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            @else
                <div>
                    Categorieën: n/a
                </div>
            @endif
            <div class="form-control">
                <label for="image">Afbeelding</label>
                <input name="image" id="image" type="file">
                @error('image')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button type="submit">Toevoegen</button>
            </div>
        </form>
    </main>
</x-layout>
