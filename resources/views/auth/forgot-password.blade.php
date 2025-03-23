<x-layout>
    <main class="container">
        <h1>Vraag een e-mail aan om je wachtwoord te herstellen</h1>

        {{-- Session Messages --}}
        @if (session('status'))
            {{ session('status') }}
        @endif

        <form class="form" action="{{ route('password.request') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="email">Email</label>
                <input name="email" type="text" id="email" value="{{ old('email') }}">
                @error('email')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button type="submit">Verzenden</button>
            </div>
        </form>
    </main>
</x-layout>
