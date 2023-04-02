@extends('layouts')

<div class="flex flex-col items-center justify-center w-screen h-screen bg-gray-200 text-gray-700">

    <h1 class="font-bold text-2xl">Forgot Password</h1>

    <form method="POST" action="/reset-password" class="flex flex-col bg-white rounded-lg shadow-lg px-4 py-6 mt-6 w-4/12">
        <label class="font-semibold text-xs" for="emailField">Email</label>
        <input class="flex items-center h-12 px-5 w-full bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2"
            type="email" name="email">
        @if ($errors->has('email'))
            <span class="text-red-500">{{ $errors->first('email') }}</span>
        @endif

        <div class="flex justify-center">
            <button
                class="flex items-center justify-center h-12 px-6 w-7/12 bg-blue-600 mt-4 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700"
                type="submit">
                Send Link
            </button>
        </div>

        <div class="flex mt-6 justify-center text-xs">
            <a class="text-blue-400 hover:text-blue-500" href="/">Cancel</a>
        </div>
</div>
