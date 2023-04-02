<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="flex flex-col items-center justify-center w-screen h-screen bg-gray-200 text-gray-700">

    {{-- <!-- Component Start -->
    <h1 class="font-bold text-2xl">Todo App</h1>

    <form method="POST" action="/login" class="flex flex-col bg-white rounded-lg shadow-lg px-2 py-6 mt-6 w-4/12">
        {!! csrf_field() !!}

        <label class="font-semibold text-xs" for="emailField">Email</label>
        <input class="flex items-center h-12 px-4 w-full bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2"
            type="email" name="email">
        @if ($errors->has('email'))
        <span class="text-red-500">{{ $errors->first('email') }}</span>
        @endif


        <label class="font-semibold text-xs mt-3" for="passwordField">Password</label>
        <input class="flex items-center h-12 px-4 w-full bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2"
            type="password" name="password">

        <button
            class="flex items-center justify-center h-12 px-6 w-full bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700"
            type="submit">
            Login
        </button>

        <div class="flex mt-6 justify-center text-xs">
            <a class="text-blue-400 hover:text-blue-500" href="#">Forgot Password</a>
            <span class="mx-2 text-gray-300">/</span>
            <a class="text-blue-400 hover:text-blue-500" href="/register">Sign Up</a>
        </div>

    </form> --}}

</body>

</html>
