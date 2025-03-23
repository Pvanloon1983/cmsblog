<x-layout>
    <main class="container">
        <h1>register</h1>

        <form class="form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-control">
                <label for="first_name">First Name</label>
                <input name="first_name" type="text" id="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="form-control">
                <label for="last_name">Last Name</label>
                <input name="last_name" type="text" id="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                <p class="error">
                    {{ $message }}
                </p>
                @enderror
            </div>
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
            <div class="form-control">
                <label for="password_confirmation">Confirm Password</label>
                <input name="password_confirmation" type="password" id="password_confirmation">
            </div>
            <div class="form-control">
                <button type="submit">Register</button>
            </div>
        </form>
    </main>
</x-layout>
