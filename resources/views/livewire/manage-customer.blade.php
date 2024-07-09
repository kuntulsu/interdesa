<div x-on:payment-paid.window="$wire.$refresh()">
    @if ($action == "update")
        <x-update-customer :customerForm="$customerForm" />
    @else
        <x-show-customer :customerForm="$customerForm" />
    @endif
</div>
