<x-mail::message>
# Vérification de votre adresse e-mail

Bonjour {{ $name }},

Merci de vous être inscrit sur notre plateforme. Avant de pouvoir accéder à toutes les fonctionnalités, nous avons besoin de vérifier votre adresse e-mail.

Cliquez sur le bouton ci-dessous pour confirmer votre adresse e-mail :

<x-mail::button :url="$url">
    Vérifier mon e-mail
</x-mail::button>

Si vous n'avez pas demandé cette vérification, ignorez simplement ce message.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
