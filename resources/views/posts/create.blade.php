<x-layout page="posts">
    <main class="container">
        <div class="dashboard">
            <h1>Bericht toevoegen</h1>
            <a class="back-to-dashboard" href="{{ route('posts.index') }}"><i class="fa-solid fa-arrow-left"></i> Terug naar alle berichten</a>
            <form class="form" action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
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
                    <textarea name="body" id="body">{{ old('body') }}</textarea>
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
                <div class="form-control bottom-no-margin">

                    <!-- Custom file input button -->
                    <label for="image" class="custom-file-label">Kies een afbeelding</label>
                    <input name="image" id="image" type="file">

                    <!-- Preview will show here -->
                    <div id="image-preview" style="margin-top: 1rem;"></div>

                    <!-- Remove button (hidden by default) -->
                    <button class="btn btn-danger" type="button" id="remove-image" style="display:none; margin-top: 0.5rem;">
                        Verwijder afbeelding
                    </button>

                    @error('image')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Toevoegen</button>
                </div>
            </form>
        </div>
    </main>
</x-layout>
