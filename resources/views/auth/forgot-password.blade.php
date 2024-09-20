<x-guest-layout>
    <x-authentication-card>
    <x-slot name="logo">
    <img src="/images/logo.png" alt="logo"  class="h-16 w-auto" > 
</x-slot

        <div class="mb-4 text-sm text-gray-600">
            {{ __('ลืมรหัสผ่านใช่หรือไม่? ไม่มีปัญหา กรุณาแจ้งที่อยู่อีเมลของคุณให้เราทราบ เราจะส่งลิงก์สำหรับรีเซ็ตรหัสผ่านไปทางอีเมล เพื่อให้คุณสามารถเลือกรหัสผ่านใหม่ได้') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('อีเมล') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('รีเซ็ตรหัสผ่าน') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
