<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: arial, sans-serif;width: 600px;margin: 0 auto;">

<h2 style="font-family: 'Times New Roman', Times, serif; color: #fff;font-size: 30px;background: #bb0037; padding: 10px; display: block; font-weight: 300;letter-spacing: 0;line-height: 30px;">
    <img src="<?php echo asset('site_assets/images/logo.png');?>" alt="" />
</h2>

<div style="font-family: arial, sans-serif;">
    <h3 style="font-family: arial, sans-serif;">Demande de mise à jour du mot de passe sur www.rjne.ch</h3>

    <p style="font-family: arial, sans-serif;line-height: 25px;">Bonjour, <br/>
        Cet email a été envoyé suite à votre demande de réinitialisation de mot de passe. Veuillez cliquer sur le lien ci-dessous.
    </p>
    <p style="font-family: arial, sans-serif;line-height: 25px;">
        <a style="text-align:center;font-size:13px;font-family:arial,sans-serif;
			color:white;font-weight:bold;background-color: #bb0037;border: 1px solid #bb0037;
			text-decoration:none;display:inline-block;min-height:27px;padding-left:8px;padding-right:8px;
			line-height:27px;border-radius:2px;border-width:1px" href="{{ url('password/reset/'.$token) }}">Réinitialiser le mot de passe </a></p>
    <p style="font-family: arial, sans-serif;line-height: 20px;color: #858585;font-size: 13px;">Pour des raisons de sécurité, ce lien n'est valide que pendant {{ Config::get('auth.reminder.expire', 60) }} minutes.
        <br/>Si vous ne cliquez pas sur ce lien avant ce délai, vous devrez recommencer la procédure de réinitialisation de mot de passe.</p>
    <p><a style="font-size:11px;color:#9a9a9a;" href="{{ url('/') }}">www.rjne.ch</a></p>

</div>

</body>
</html>
