<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <x-application-logo />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block font-medium text-sm text-gray-700" for="emailField">{{ __('Email') }}</label>
                    <input
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        type="email" name="email" placeholder="johndoe@hotmail.com">
                    @if ($errors->has('email'))
                        <span class="text-red-500">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mt-4">
                    <div class="flex flex-row">
                        <label class="w-4/12 block font-medium text-sm text-gray-700"
                            for="passwordField">{{ __('Password') }}</label>
                        <div class="flex justify-end w-8/12">
                            <a class="text-blue-400 hover:text-blue-500 text-xs" href="{{ route('password.request') }}">
                                {{ __('Forgot Password ?') }}
                            </a>
                        </div>
                    </div>

                    <input
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                        type="password" name="password" placeholder="Password">
                </div>

                <div class="flex flex-row mt-4">
                    <div class="w-4/12">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="flex justify-end w-8/12">
                        <a class="text-xs text-blue-400 hover:text-blue-500" href="{{ route('register') }}">
                            {{ __('Create an Account') }}
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <button class="relative w-64 inline-block text-lg group">
                        <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
                        <span class="absolute left-0 w-full h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                        <span class="relative">{{ __('Log in') }}</span>
                        </span>
                        <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                    </button>
                </div>

                <div class="flex items-center justify-between pt-3">
                    <hr class="w-full border-t-slate-200">
                    <p class="px-3">or</p>
                    <hr class="w-full border-t-slate-200">
                </div>

                <div class="flex items-center justify-center space-x-16">
                    {{-- https://freeicons.io/ --}}
                    <a href="/Github">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M24.0002 0C10.747 0 0 11.0169 0 24.6076C0 35.4799 6.87679 44.7039 16.4128 47.9577C17.6123 48.1855 18.0526 47.4239 18.0526 46.7739C18.0526 46.1872 18.0304 44.2487 18.02 42.1925C11.3431 43.6811 9.93424 39.2891 9.93424 39.2891C8.84249 36.4448 7.26945 35.6885 7.26945 35.6885C5.09192 34.1613 7.43359 34.1926 7.43359 34.1926C9.84363 34.3662 11.1126 36.7285 11.1126 36.7285C13.2532 40.4904 16.7272 39.4028 18.0967 38.7741C18.3121 37.1836 18.9341 36.0981 19.6205 35.4836C14.2897 34.8613 8.6859 32.7513 8.6859 23.3224C8.6859 20.6358 9.62345 18.4406 11.1587 16.7174C10.9095 16.0976 10.088 13.5947 11.3912 10.2052C11.3912 10.2052 13.4066 9.54387 17.993 12.7276C19.9074 12.1824 21.9606 11.9089 24.0002 11.8996C26.0398 11.9089 28.0946 12.1824 30.0126 12.7276C34.5934 9.54387 36.606 10.2052 36.606 10.2052C37.9123 13.5947 37.0905 16.0976 36.8413 16.7174C38.3801 18.4406 39.3113 20.6358 39.3113 23.3224C39.3113 32.7738 33.6968 34.8548 28.3525 35.464C29.2133 36.2276 29.9804 37.7252 29.9804 40.021C29.9804 43.3135 29.9526 45.9634 29.9526 46.7739C29.9526 47.4288 30.3846 48.1961 31.6011 47.9544C41.132 44.697 48 35.4762 48 24.6076C48 11.0169 37.2546 0 24.0002 0Z" fill="#161514"/>
                            <path d="M9.16085 35.1623C9.10809 35.2833 8.92085 35.3196 8.75027 35.2365C8.57652 35.157 8.47893 34.992 8.53526 34.8706C8.58683 34.7459 8.77447 34.7112 8.94782 34.7947C9.12197 34.8742 9.22115 35.0408 9.16085 35.1623Z" fill="#161514"/>
                            <path d="M10.1312 36.263C10.0169 36.3707 9.79358 36.3207 9.64205 36.1504C9.48535 35.9806 9.456 35.7534 9.57183 35.6441C9.68965 35.5363 9.90624 35.5868 10.0633 35.7566C10.22 35.9285 10.2506 36.1541 10.1312 36.263Z" fill="#161514"/>
                            <path d="M11.0757 37.6663C10.9289 37.77 10.6889 37.6728 10.5406 37.4561C10.3938 37.2394 10.3938 36.9796 10.5437 36.8755C10.6925 36.7714 10.9289 36.865 11.0793 37.0801C11.2257 37.3004 11.2257 37.5602 11.0757 37.6663Z" fill="#161514"/>
                            <path d="M12.3697 39.0219C12.2384 39.1692 11.9588 39.1297 11.7541 38.9287C11.5446 38.7322 11.4863 38.4534 11.618 38.3062C11.7509 38.1585 12.0321 38.2001 12.2384 38.3994C12.4463 38.5955 12.5098 38.8763 12.3697 39.0219Z" fill="#161514"/>
                            <path d="M14.1548 39.8091C14.0969 40 13.8276 40.0867 13.5562 40.0056C13.2853 39.9221 13.108 39.6986 13.1627 39.5057C13.219 39.3137 13.4896 39.2233 13.7629 39.31C14.0334 39.3932 14.2112 39.6151 14.1548 39.8091Z" fill="#161514"/>
                            <path d="M16.1153 39.9552C16.122 40.1561 15.892 40.3228 15.6071 40.3264C15.3207 40.3329 15.089 40.1703 15.0859 39.9726C15.0859 39.7696 15.3108 39.6046 15.5972 39.5998C15.882 39.5941 16.1153 39.7555 16.1153 39.9552Z" fill="#161514"/>
                            <path d="M17.9397 39.6392C17.9738 39.8353 17.7759 40.0366 17.493 40.0903C17.2149 40.1419 16.9575 40.0209 16.9222 39.8264C16.8877 39.6255 17.0892 39.4241 17.3669 39.3721C17.6501 39.3221 17.9036 39.4399 17.9397 39.6392Z" fill="#161514"/>
                        </svg>
                    </a>
                    <a href="/Google">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" width="56px" height="56px"
                            viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12  c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24  c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657  C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36  c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571  c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
