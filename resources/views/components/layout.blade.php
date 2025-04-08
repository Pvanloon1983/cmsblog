@props(['page' ?? ''])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CMS Blog App' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tiny.cloud/1/j5vyzkmwlkh5kh6jymkaa6cmou8q08qwjo5fqpzh1hzxaqxw/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ $page }}">
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}"><img width="60px" src="{{ asset('storage/images/mosque.png') }}" alt=""></a>
            </div>
            <nav class="navbar">
                <ul>
                    <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a href="#">Blog</a></li>
                    <li class="nav-item"><a href="#">About</a></li>
                    <li class="nav-item"><a href="#">Contact</a></li>

                    @guest()
                        <li class="nav-item"><a href="{{ route('login') }}">Inloggen</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}">Registreren</a></li>
                    @endguest

                    @auth()
                    <li class="nav-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form class="form" action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn" id="submitButton" type="submit"> <span id="submitSpinner" class="spinner" style="display: none; margin-right: 8px;"></span>Uitloggen</button>
                        </form>
                    </li>
                    @endauth

                </ul>
            </nav>
            <div class="menu-btn-toggle">
                <button class="btn-toggle"><i class="fa-solid fa-bars"></i></button>
            </div>
        </div>
    </header>
    {{ $slot }}
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>
</body>
</html>
