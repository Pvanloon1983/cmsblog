<x-layout page="auth">
    <main class="container">
        <div class="auth-top-box">
        <h1>Registreren</h1>
        </div>

        <form class="form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="first_name">Voornaam</label>
                <input name="first_name" type="text" id="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <label for="last_name">Achternaam</label>
                <input name="last_name" type="text" id="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
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
            <div class="form-control">
                <label for="password_confirmation">Bevestig wachtwoord</label>
                <input name="password_confirmation" type="password" id="password_confirmation">
            </div>
            <div class="form-control remember-forgot">
                <div class="forgot-password-box">
                    <a href="{{ route('login') }}">Al geregistreerd? klik hier</a>
                </div>
            </div>
            <div class="form-control">
                <button class="btn" type="submit">Registreren</button>
            </div>
        </form>
    </main>
</x-layout>
