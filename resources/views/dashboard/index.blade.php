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
            <p>Add HTMLPurifier</p>
            <a class="action-handler" href="{{ route('posts.index') }}">Alle berichten</a>
            <a class="action-handler" href="{{ route('categories.index') }}">Alle categorieën</a>
            </div>
        </div>
    </main>
</x-layout>
