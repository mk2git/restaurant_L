@extends('layouts.guest')
@section('background-class', 'login-bg')
@section('content')
    <div class="container ms-3 mt-3">
        <h1 class="logo-login"><span class="logo-sm">Restaurant</span>  L</h1>
    </div>

    <div class=" d-flex justify-content-center align-items-center pt-5">
        <div class="w-50 mt-6 p-6 bg-white rounded">
            {{-- {{ $slot }} --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                 <!-- Name -->
                 <div class="text-center mt-4">
                    <div class="row">
                        <div class="col text-end">
                            <x-input-label for="name" :value="__('Name')" />
                        </div>
                        <div class="col text-start">
                            <x-text-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div class="mt-4 text-center">
                    <div class="row">
                        <div class="col text-end">
                            <x-input-label for="password" :value="__('Password')" />
                        </div>
                        <div class="col text-start">
                          <x-text-input id="password" class="mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />                   
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>    
                </div>

                <small class="d-flex align-items-center justify-content-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-secondary hover:text-gray-900" href="{{ route('password.request') }}">
                           パスワードを忘れましたか？
                        </a>
                    @endif
                    <x-success-button class="m-3">
                        ログイン
                    </x-success-button>
                </small>
            </form>
            <div class="mt-4 text-center">
              <hr class="w-75 mx-auto">   
              <a href="{{route('register')}}" class="btn btn-secondary m-3 w-25 text-white">新規登録</a>
            </div>
            
        </div>
    </div>
@endsection

