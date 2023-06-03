@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <i class="bi bi-code-square brand-icon"></i> DEVMARKETPLACE
{{-- @if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif --}}
</a>
</td>
</tr>
