<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réinitialisation du mot de passe</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; }
        .img-logo { text-align: center; }
        .copyright { text-align: center; }
        .button { display: inline-block; padding: 12px 20px; color: #fff; background-color: #e52128; text-decoration: none; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="img-logo">
        <img src="{{ asset('assets/images/logo/olten_location.png') }}" alt="Olten Logo">
    </div>
    <div class="container">
        <h2>Bonjour {{ $name }} !</h2>
        <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
        <p><a href="{{ url('/reset-password/'.$token.'?email='.$email) }}" class="button">Réinitialiser mon mot de passe</a></p>
        <p>Si vous n’avez pas fait cette demande, ignorez cet email.</p>
        <p>Merci,<br>{{ config('app.name') }}</p>
    </div>
    <div class="copyright">
        <p>© 2025 Olten</p>
    </div>
</body>
</html>
