<x-layout page="auth">
    <main class="container">
        <div class="auth-top-box">
        <h1>Herstel je wachtwoord</h1>

        {{-- Session Messages --}}
        @if (session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif
        </div>

        <form class="form" action="{{ route('password.update') }}" method="post">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-control">
                    <label for="email">E-mail</label>
                    <input name="email" type="text" id="email" value="{{ old('email', request('email')) }}">
                    @error('email')
                    <p class="error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="password">Wachtwoord</label>
                    <input name="password" type="password" id="password">
                    @error('password')
                    <p class="error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="password_confirmation">Wachtwoord bevestigen</label>
                    <input name="password_confirmation" type="password" id="password_confirmation">
                </div>
                <div class="form-control">
                    <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Herstel wachtwoord</button>
                </div>

        </form>
    </main>
</x-layout>
