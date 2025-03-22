<x-layout>
    <main class="container">
        <h1>Create a new post</h1>
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
                <label for="body">Content</label>
                <textarea name="body" id="body">
                    {{ old('body') }}
                </textarea>
                @error('body')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <label for="image">Cover Image</label>
                <input name="image" id="image" type="file">
                @error('image')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button type="submit">Create</button>
            </div>
        </form>
    </main>
</x-layout>
