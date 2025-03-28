<x-layout page="dashboard">
    <main class="container">
        <h1>Dashboard</h1>
        <h2 class="dashboad-welkom">Welkom {{ $user->first_name }}</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="dashboard">
            <div class="action-handler-box">
            <a class="action-handler" href="{{ route('posts.create') }}">Schrijf een nieuwe post</a>
            <a class="action-handler" href="{{ route('posts.index') }}">Bekijk al jouw posts</a>
            <a class="action-handler" href="{{ route('categories.index') }}">Bekijk al jouw categorieën</a>
            <a class="action-handler" href="{{ route('categories.create') }}">Voeg een nieuwe categorie toe</a>
            </div>
        </div>
    </main>
</x-layout>
