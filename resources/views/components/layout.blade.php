<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CMS Blog App' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}">Home</a>
            </div>
            <nav class="navbar">
                <ul>
                    <li class="nav-item"><a href="#">Home</a></li>
                    <li class="nav-item"><a href="#">Blog</a></li>
                    <li class="nav-item"><a href="#">About</a></li>
                    <li class="nav-item"><a href="#">Contact</a></li>

                    @guest()
                        <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}">Register</a></li>
                    @endguest

                    @auth()
                    <li class="nav-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>
    {{ $slot }}
</body>
</html>
