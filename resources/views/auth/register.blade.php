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
                <!-- FirstName -->
                <div>
                    <x-label for="first_name" :value="__('First Name *')" />
    
                    <x-input id="first_name" placeholder="Enter First Name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                </div>
    
                <!-- LastName -->
                <div class="mt-4">
                    <x-label for="last_name" :value="__('Last Name *')" />
    
                    <x-input id="last_name" placeholder="Enter Last Name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required  />
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email *')" />
    
                    <x-input id="email" placeholder="Enter Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password *')" />
    
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    placeholder="Enter Password"
                                    required autocomplete="new-password" />
                                    <span class="font-weight-light"><small class="ml-2">Must contain Uppercase, Lowercase, Number and Symbols</small></span>
                </div>
    
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password *')" />
    
                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    placeholder="Enter Confirm Password"
                                    name="password_confirmation" required />
                </div>
    
                <!-- Mobile -->
                <div class="mt-4">
                    <x-label for="mobile" :value="__('Mobile *')" />
    
                    <x-input id="mobile" class="block mt-1 w-full" placeholder="Enter Mobile number" type="number" name="mobile" :value="old('mobile')"  required  />
                </div>
    
                 <!-- Address -->
                 <div class="mt-4">
                    <x-label for="address" :value="__('Address *')" />
    
                    <x-input type="text" id="address" class="block mt-1 w-full" placeholder="Enter Address" name="address" row=5 col=5 required :value="old('address')" />
                </div>
    
                <!-- ZipCode -->
                <div class="mt-4">
                    <x-label for="zip_code" :value="__('Postal Code *')" />
    
                    <x-input id="zip_code" class="block mt-1 w-full" placeholder="Enter Postal Code" type="text" name="zip_code" :value="old('zip_code')" required readonly/>
                </div>
    
                <!-- DIrections -->
                <div class="mt-4">
                    <x-label for="direction" :value="__('Direction *')" />
    
                    <x-input id="direction" class="block mt-1 w-full" placeholder="Enter Direction" type="text" name="direction" :value="old('direction')" required readonly />
                </div>
                <x-input type="hidden" id="latitude" name="latitude" value="" />
                <x-input type="hidden" id="longitude" name="longitude" value="" />
    
                <!-- Login Btn -->
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
