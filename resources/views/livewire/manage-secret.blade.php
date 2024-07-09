<div
x-on:secret-updated.window="$wire.refreshProfileData" x-on:payment-paid.window="$wire.refreshProfileData" x-on:ppp-secret-enabled.window="$wire.refreshProfileData" x-on:ppp-secret-disabled.window="$wire.refreshProfileData">
    @if ($action == "update")
        <x-update-secret :profile="$profile" />
    @else
        <x-show-secret :profile="$profile" />
    @endif
</div>
