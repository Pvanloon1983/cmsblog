<x-layout>
    <main class="container">
        <h1>Create a new category</h1>
        <a href="{{ route('dashboard') }}">Terug naar dashboard</a>
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="name">Name</label>
                <input name="name" type="text" id="name" value="{{ old('name') }}">
                @error('name')
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
