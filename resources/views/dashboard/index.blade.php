<x-layout>
    <main class="container">
        <h1>Dashboard</h1>
        <h2>Welkom terug, {{ $user->first_name }}</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="dashboard">
            <a class="action-handler" href="{{ route('posts.create') }}">Schrijf een nieuwe post</a>
            <a class="action-handler" href="{{ route('posts.index') }}">Bekijk al jouw posts</a>
        </div>
    </main>
</x-layout>
