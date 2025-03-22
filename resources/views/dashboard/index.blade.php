<x-layout>
    <main class="container">
        <h1>Dashboard</h1>
        <h2>Welkom terug, {{ $user->first_name }}</h2>
        <div class="dashboard">
            {{-- Session Messages --}}
            @if (session('success'))
               <p>{{ session('success') }}</p>
            @endif
            <a class="action-handler" href="{{ route('posts.create') }}">Schrijf een nieuwe post</a>
            <a class="action-handler" href="{{ route('posts.index') }}">Bekijk alle posts</a>
        </div>
    </main>
</x-layout>
