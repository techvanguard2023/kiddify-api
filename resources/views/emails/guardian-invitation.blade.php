<!DOCTYPE html>
<html>
<head>
    <title>Convite para o Kiddify</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Olá!</h2>
    <p>
        Você foi convidado por <strong>{{ $inviter->name }}</strong> para ajudar a gerenciar as tarefas e recompensas de uma família no Kiddify.
    </p>
    <p>
        Kiddify é uma plataforma para ensinar educação financeira para crianças de forma divertida.
    </p>
    <p>
        Para aceitar o convite, clique no botão abaixo:
    </p>
    <a href="{{ $acceptUrl }}" style="background-color: #4f46e5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
        Aceitar Convite
    </a>
    <p>
        Se você não esperava este convite, pode ignorar este e-mail com segurança.
    </p>
    <p>
        Atenciosamente,<br>
        Equipe Kiddify
    </p>
</body>
</html>