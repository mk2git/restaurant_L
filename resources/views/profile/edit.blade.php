<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            各種設定
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container m-5">
        @if (session('message'))
          <x-alert-message :type="session('type')" :message="session('message')" />
        @else

        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h2 class="text-center">User管理</h2>
            </div>
            <div class="card-body text-center">
                <table class="mx-auto w-100">
                    <thead>
                        <tr>
                            <th>User名</th>
                            <th>権限</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                          <tr>
                              <td>{{$user->name}}</td>
                              <td>
                                  <form action="{{route('profile.updateRole', $user->id)}}" method="post">
                                     @csrf
                                     @method('put')
                                  <select name="role" class="form-control">
                                      @foreach ($roles as $role)
                                         <option value="{{$role}}" @if($role == $user->role)  selected @endif>{{$role}}</option>
                                      @endforeach
                                  </select>
                              </td>
                              <td>
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-success w-50">変更</button>
                                </form>
                              </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>

