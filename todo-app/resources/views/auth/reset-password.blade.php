<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <x-application-logo />

        <x-jet-validation-errors class="mb-4" />

        <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="block">
                    <label class="block font-medium text-sm text-gray-700" for="email">{{ __('Email') }}</label>
                    <input
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        type="email" name="email" :value="old('email', $request->email)" required autofocus>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password">{{ __('Password') }}</label>
                    <input
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        id="password" type="password" name="password" required autocomplete="new-password">
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="relative w-56 inline-block text-lg group">
                        <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
                        <span class="absolute left-0 w-full h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                        <span class="relative">{{ __('Reset Password') }}</span>
                        </span>
                        <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
