<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 100%;
            padding: 40px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #eee;
        }

        .header {
            background-color: #ff3c00;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
        }

        .field {
            margin-bottom: 25px;
        }

        .label {
            font-weight: bold;
            color: #ff3c00;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1.2px;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            font-size: 16px;
            color: #2d2d2d;
            padding: 5px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .message-title {
            font-weight: bold;
            color: #ff3c00;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1.2px;
            margin-top: 25px;
            display: block;
        }

        .message-box {
            background: #fff5f2;
            padding: 20px;
            border-radius: 8px;
            border-left: 1px solid #ff3c00;
            color: #444;
            margin-top: 10px;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            padding: 25px;
            font-size: 11px;
            color: #aaa;
            background-color: #fafafa;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h2>Nouveau Message de Contact</h2>
            </div>

            <div class="content">
                <div class="field">
                    <span class="label">Expéditeur</span>
                    <div class="value"><strong>{{ $contact['name'] }}</strong> — {{ $contact['email'] }}</div>
                </div>

                <div class="field">
                    <span class="label">Objet du message</span>
                    <div class="value">{{ $contact['subject'] }}</div>
                </div>

                <span class="message-title">Contenu du message</span>
                <div class="message-box">
                    {!! nl2br(e($contact['message'] ?? 'Aucun contenu fourni.')) !!}
                </div>
            </div>

            <div class="footer">
                Ceci est une notification automatique envoyée par votre plateforme.
            </div>
        </div>
    </div>
</body>

</html>
