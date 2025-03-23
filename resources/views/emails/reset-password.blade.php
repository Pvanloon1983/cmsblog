<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Wachtwoord herstellen</title>
</head>
<body>
<h1>Hallo {{ $user->first_name }},</h1>

<p>Je ontvangt deze e-mail omdat we een verzoek hebben ontvangen om je wachtwoord opnieuw in te stellen.</p>

<p>
    <a href="{{ $resetUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none;">
        Herstel wachtwoord
    </a>
</p>

<p>Als je dit niet hebt aangevraagd, hoef je verder niets te doen.</p>
</body>
</html>
