@extends('layouts.guest')
@section('background-class', 'register-bg')
@section('content')
<div class="container ms-3 mt-3">
    <h1 class="logo-login"><span class="logo-sm">Restaurant</span>  L</h1>
</div>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        @if($one_user_admin->isEmpty())
            {{-- role --}}
            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <div class="d-flex">
                    <label for="admin" class="me-2">Admin</label>
                    <x-text-input id="admin" class="block mt-1 me-3" type="radio" name="role" value="admin" required autofocus autocomplete="role" />

                    <label for="staff" class="me-2">Staff</label>
                    <x-text-input id="staff" class="block mt-1" type="radio" name="role" value="staff" required autofocus autocomplete="role" />
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
            </div>
        @else
            <input type="hidden" name="role" value="staff">
        @endif
        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <small class="flex items-center justify-end mt-4">
            <a class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                すでに登録済み？
            </a>

            <x-primary-button class="ms-4">
                登録
            </x-primary-button>
        </small>
    </form>
    </div>
</div>
@endsection
