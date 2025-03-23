<x-layout>
    <main class="container">
        <h1>Herstel je wachtwoord</h1>

        {{-- Session Messages --}}
        @if (session('status'))
            {{ session('status') }}
        @endif

        <form class="form" action="{{ route('password.update') }}" method="post">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-control">
                    <label for="email">Email</label>
                    <input name="email" type="text" id="email" value="{{ old('email', request('email')) }}">
                    @error('email')
                    <p class="error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password">
                    @error('password')
                    <p class="error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="password_confirmation">Confirm Password</label>
                    <input name="password_confirmation" type="password" id="password_confirmation">
                </div>
                <div class="form-control">
                    <button type="submit">Herstel wachtwoord</button>
                </div>

        </form>
    </main>
</x-layout>
