<x-guest-layout>
    <x-authentication-card>
    <x-slot name="logo">
    <img src="/images/logo.png" alt="logo"  class="h-16 w-auto" > 

        <x-validation-errors class="mb-4" />

        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="username" value="{{ __('ชื่อผู้ใช้') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-label for="fristname" value="{{ __('ชื่อจริง') }}" />
                <x-input id="fristname" class="block mt-1 w-full" type="text" name="fristname" :value="old('fristname')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-label for="lastname" value="{{ __('นามสกุล') }}" />
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('อีเมล') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>


            <div class="mt-4">
                <x-label for="password" value="{{ __('รหัสผ่าน') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('ยืนยันรหัสผ่าน')}}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('มีบัญชีผู้ใช้อยู่แล้วใช่หรือไม่?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('ลงทะเบียน') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
