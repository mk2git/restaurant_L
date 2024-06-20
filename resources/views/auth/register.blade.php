@extends('layouts.guest')
@section('background-class', 'register-bg')
@section('content')
<div class="container ms-3 mt-3">
    <h1 class="logo-login"><span class="logo-sm">Restaurant</span>  L</h1>
</div>
<div class="d-flex justify-content-center align-items-center pt-5">
    <div class="custom-div mt-6 p-6 bg-white rounded">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="text-center mt-4">
            <x-text-input id="name" placeholder="Name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
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
        <div class="mt-4 text-center">
           <x-text-input id="password"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required autocomplete="new-password" />                   
           <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 text-center">
            <x-text-input id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                     required autocomplete="new-password" />                   
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4 text-center float-end">
             <a class="text-secondary hover:text-gray-900" href="{{ route('login') }}">
                <small>すでに登録済み？</small>
            </a>
            <x-success-button class="m-2">登録</x-success-button>
        </div>
    </form>
    </div>
</div>
@endsection
