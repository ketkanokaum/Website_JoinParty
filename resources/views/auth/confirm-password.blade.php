<x-guest-layout>
    <x-<x-slot name="logo">
    <img src="/images/logo.png" alt="logo"  class="h-16 w-auto" > 
</x-slot

        <div class="mb-4 text-sm text-gray-600">
            {{ __('กรุณายืนยันรหัสผ่านของคุณก่อนดำเนินการต่อ') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
