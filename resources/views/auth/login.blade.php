@extends('layouts.guest')
@section('background-class', 'login-bg')
@section('content')
    <div class="container ms-3 mt-3">
        <h1 class="logo-login"><span class="logo-sm">Restaurant</span>  L</h1>
    </div>

    <div class=" d-flex justify-content-center align-items-center pt-5">
        <div class="custom-div mt-6 p-6 bg-white rounded">
            {{-- {{ $slot }} --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                 <!-- Name -->
                 <div class="text-center mt-4">
                    <x-text-input id="name" type="text" name="name" placeholder="Name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                 </div>

                <!-- Password -->
                <div class="mt-4 text-center">
                   <x-text-input id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    required autocomplete="current-password" />                   
                   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <p class="d-block text-center mt-4">
                    <x-success-button class="custom-text-size">
                        ログイン
                    </x-success-button>
                </p>
            </form>
            <div class="mt-4 text-center">
              <hr class="w-75 mx-auto">   
              <a href="{{route('register')}}" class="btn btn-secondary mb-3 text-white">新規登録</a>
            </div>
            
        </div>
    </div>
@endsection

