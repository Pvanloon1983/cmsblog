<x-layout>
    <main class="container">
        <h1>Login</h1>
        <form class="form" action="{{ route('login') }}" method="post">
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
                <label for="password">Password</label>
                <input name="password" type="password" id="password">
                @error('password')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>

            @error('failed')
            <p>
                {{ $message }}
            </p>
            @enderror

            <div class="form-control">
                <button type="submit">Login</button>
            </div>
        </form>
    </main>
</x-layout>
