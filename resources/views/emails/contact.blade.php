<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body style="padding: 20px;">
        <h2 style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 20px;">Message depuis le site rjne.ch</h2>
        <div style="font-family: Arial, Helvetica, sans-serif;">
            <p style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 10px;">{{ $remarque }}</p>
            <p style="font-family: Arial, Helvetica, sans-serif;"><strong>{{ $nom }}</strong> - <a href="mailto:{{ $email }}">{{ $email }}</a></p>
        </div>
        <p><a style="color: #444; font-size: 13px;" href="http://www.droitdutravail.ch">www.rjne.ch</a></p>
    </body>
</html>