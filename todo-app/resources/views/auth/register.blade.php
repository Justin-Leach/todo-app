<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <x-application-logo />

        <x-jet-validation-errors class="mb-4" />

        <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label class="block font-medium text-sm text-gray-700" for="nameField">{{ __('Name') }}</label>
                    <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm" id="name" type="text" name="name" autofocus required :value="old('name')">
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="emailField">{{ __('Email') }}</label>
                    <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm" id="email" type="email" name="email" required :value="old('email')">
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="passwordField">{{ __('Password') }}</label>
                    <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm" id="password" type="password" name="password" required>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="confirmPasswordField">{{ __('Confirm Password') }}</label>
                    <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm" id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif --}}

                <div class="flex items-center justify-end mt-2">
                    <a class="underline text-xs text-blue-400 hover:text-blue-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <div class="flex justify-center mt-4">
                    <button class="relative w-64 inline-block text-lg group">
                        <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
                        <span class="absolute left-0 w-full h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                        <span class="relative">{{ __('Register') }}</span>
                        </span>
                        <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
