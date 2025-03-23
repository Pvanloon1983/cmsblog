<x-layout>
    <main class="container">
    <h1>Bevestig je e-mailadres via de e-mail die we je hebben gestuurd.</h1>

    {{-- Session Messages --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>Geen e-mail ontvangen?</p>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf

        <button>Opnieuw verzenden</button>
    </form>
    </main>
</x-layout>
