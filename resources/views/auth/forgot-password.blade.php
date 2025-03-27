<x-layout page="auth">
    <main class="container">
        <div class="auth-top-box">
            <h1>Vraag een e-mail aan om je wachtwoord te herstellen</h1>

            {{-- Session Messages --}}
            @if (session('status'))
                <p class="status">{{ session('status') }}</p>
            @endif
        </div>

        <form class="form" action="{{ route('password.request') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="email">E-mail</label>
                <input name="email" type="text" id="email" value="{{ old('email') }}">
                @error('email')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Verzenden</button>
            </div>
        </form>
    </main>
</x-layout>
