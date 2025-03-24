<x-layout>
    <main class="container">
        <h1>Edit Post</h1>
        <div> <a href="{{ route('posts.index') }}">Terug naar alle posts</a></div>
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-control">
                <label for="title">Title</label>
                <input name="title" type="text" id="title" value="{{ $post->title }}">
                @error('title')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <label for="body">Content</label>
                <textarea name="body" id="body">
                    {{ $post->body }}
                </textarea>
                @error('body')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            @if($categories->count())
                <div class="form-control">
                    <label for="categories">Category</label>
                    <select name="categories[]" id="categories" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
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
                    Categories: n/a
                </div>
            @endif
            <div class="form-control">
                <img width="150" src="{{ asset('storage') . '/' . $post->image }}" alt="">
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
                <button type="submit">Update</button>
            </div>
        </form>
    </main>
</x-layout>
