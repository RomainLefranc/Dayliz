<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="lastName" :value="__('Last name')" />

                <x-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required autofocus />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="firstName" :value="__('First name')" />

                <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="birthDay" :value="__('Birthday')" />

                <x-input id="birthDay" class="block mt-1 w-full" type="date" name="birthDay" :value="old('birthDay')" required autofocus />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- phoneNumber -->
            <div class="mt-4">
                <x-label for="phoneNumber" :value="__('Phone number')" />

                <x-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" :value="old('phoneNumber')" required />
            </div>

            <!-- role_id -->
            <div class="mt-4">
                <x-label for="role_id" :value="__('Role')" />
                <select name="role_id" id="role_id" value="{{ old('role_id') }}">

                    @foreach ($Roles as $Role)
                    <option name="role_id" id="role_id" value="{{ $Role->id }}"> {{ $Role->name }} </option>
                    @endforeach
                </select>

            </div>

            <!-- phoneNumber -->
            <div class="mt-4">
                <x-label for="promotion_id" :value="__('Promotion')" />

                <select name="promotion_id" id="promotion_id" value="{{ old('promotion_id') }}">

                    @foreach ($Promos as $Promo)
                    <option name="promotion_id" id="promotion_id" value="{{ $Promo->id }}"> {{ $Promo->name }} </option>
                    @endforeach
                </select>            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
