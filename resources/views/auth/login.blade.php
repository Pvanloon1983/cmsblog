<x-layout page="auth">
    <main class="container">
        <div class="auth-top-box">
        <h1>Inloggen</h1>
        {{-- Session Messages --}}
        @if (session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif
        </div>
        <form class="form" action="{{ route('login') }}" method="post">
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
                <label for="password">Wachtwoord</label>
                <input name="password" type="password" id="password">
                @error('password')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="form-control remember-forgot">
                <div class="remember-me-box">
                    <input name="remember" type="checkbox" id="remember">
                    <label for="remember">Onthoud mij</label>
                </div>
                <div class="forgot-password-box">
                    <a href="{{ route('password.request') }}">Wachtwoord vergeten? Klik hier</a>
                </div>
            </div>

            @error('failed')
            <p class="error wrong-auth">
                {{ $message }}
            </p>
            @enderror

            <div class="form-control">
                <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Login</button>
            </div>
        </form>
    </main>
</x-layout>
