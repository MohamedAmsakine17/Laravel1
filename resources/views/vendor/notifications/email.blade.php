<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Bonjour!')
@endif
@endif

{{-- Intro Lines --}}
@lang('Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.')

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@lang('Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.')


{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Merci'),<br>
DevMarketplace
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Si vous ne parvenez pas à cliquer sur le bouton \":actionText\", copiez et collez l'URL ci-dessous\n\". dans votre navigateur Web :",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
