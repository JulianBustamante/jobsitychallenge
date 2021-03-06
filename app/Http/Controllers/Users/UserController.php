<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function filter(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $users = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
            ->paginate($request->input('pagination.per_page'));

        $users->load('roles');

        return $users;
    }

    /**
     * Display the specified resource.
     */
    public function showPosts(Request $request, User $user): View
    {
        return view('users.show', [
            'user' => $user,
            'posts_count' => $user->posts()->count(),
            'posts' => $user->posts()->latest()->limit(5)->get(),
        ]);
    }

    public function show($user)
    {
        return User::findOrFail($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'roles' => 'required|array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $rolesNames = array_pluck($request->roles, ['name']);
        $user->assignRole($rolesNames);

        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::disk('public')->put('avatars/'.$user->id.'/avatar.png', (string) $avatar);

        return $user;
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'string|nullable',
            'roles' => 'required|array'
        ]);

        $user = User::find($request->id);

        if ($user->name !== $request->name) {
            $avatar = Avatar::create($request->name)->getImageObject()->encode('png');
            Storage::disk('public')->put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
            $user->name = $request->name;
        }
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }
        if ($request->password !== '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $rolesNames = array_pluck($request->roles, ['name']);
        $user->syncRoles($rolesNames);

        return $user;
    }

    public function destroy($user)
    {
        return User::destroy($user);
    }

    public function count()
    {
        return User::count();
    }

    public function getUserRoles($user)
    {
        $user = User::findOrFail($user);
        $user->getRoleNames();

        return $user;
    }

}
