<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            各種設定
        </h2>
    </x-slot>

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
                                      <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                      <option value="staff" @if($user->role == 'staff') selected @endif>Staff</option>
                                  </select>
                              </td>
                              <td>
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

