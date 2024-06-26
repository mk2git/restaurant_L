<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $users = User::all();

        // たぶん、これよりは、config定数を使ってあらかじめroleを定数にしておくとよい by candy
        // roleシステムはGateがオススメ by candy
        $roles = User::distinct()->pluck('role');

        
        return view('profile.edit', [
            'user' => $request->user(),
        ], compact('users', 'roles'));
    }

    public function updateRole($user_id, Request $request ){
        try{
            DB::beginTransaction();
            $user = User::find($user_id);
            $user->role = $request->input('role');
            $user->save();
            DB::commit();
            return redirect()->back()->with(['message' => $user->name.'の権限が変更されました', 'type' => 'success']);
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Profile updateRole', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '権限の変更に失敗しました');
        } 
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
