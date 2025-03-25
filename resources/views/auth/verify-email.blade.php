<x-layout page="auth">
    <main class="container">
    <div class="auth-top-box">
    <h1>Bevestig je e-mailadres via de e-mail die we je hebben gestuurd.</h1>

    {{-- Session Messages --}}
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <p>Geen e-mail ontvangen?</p>
    </div>

    <form class="form" action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button class="btn" type="submit">Opnieuw verzenden</button>
    </form>
    </main>
</x-layout>
