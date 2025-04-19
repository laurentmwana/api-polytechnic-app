<x-mail::message>
    # Hey !

    Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

    <x-mail::button :url="''">
        Réinitialisation du mot de passe
    </x-mail::button>

    <p>
        Ce lien de réinitialisation du mot de passe expirera dans 60 minutes.
    </p>

    <p>
        Si vous n'avez pas demandé de réinitialisation de mot de passe, vous pouvez ignorer ce message.
    </p>

    Cordialement,<br>
    {{ config('app.name') }}
</x-mail::message>