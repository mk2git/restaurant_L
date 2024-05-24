@extends('layouts.guest')
@section('background-class', 'login-bg')
@section('content')
    <div class="container ms-3 mt-3">
        <h1 class="logo-login"><span class="logo-sm">Restaurant</span>  L</h1>
    </div>

    <div class="min-h-screen d-flex justify-content-center align-items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{-- {{ $slot }} --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                 <!-- Name -->
                 <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <small class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                           パスワードを忘れましたか？
                        </a>
                    @endif
                    <x-primary-button class="ms-3">
                        ログイン
                    </x-primary-button>
                </small>
            </form>
            <div class="mt-4 text-center">
              <hr>   

              <a href="{{route('register')}}" class="btn bg-gray-800 mt-3 w-25 text-white hover:bg-gray-700">新規登録</a>
            </div>
            
        </div>
    </div>
@endsection

