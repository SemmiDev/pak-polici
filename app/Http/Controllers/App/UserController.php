<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): View
    {
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.nip',
                'users.email',
                DB::raw('GROUP_CONCAT(roles.name) as roles')
            )
            ->where('users.id', '!=', auth()->user()->id)
            ->groupBy('users.id', 'users.name', 'users.nip', 'users.email')
            ->get();

        return view('app.users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('app.users.create', compact('roles'));
    }

    public function editRole(User $user)
    {
        $userRoles = ModelHasRole::where('model_id', $user->id)
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name', 'roles.id')
            ->get();

        $roles = Role::all();

        foreach ($roles as $role) {
            $role->checked = $userRoles->contains('id', $role->id);
        }

        return view('app.users.edit-role', compact('user',  'roles'));
    }

    public function editPassword(User $user)
    {
        return view('app.users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return view('app.users.credential', [
            'email' => $user->email,
            'password' => $request->password,
            'nip' => $user->nip,
        ])->with('success', 'Password berhasil diubah');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => ['required'],
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('app.users.index')->with('success', 'Role berhasil diubah');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validRoles = Role::all()->pluck('name')->toArray();

            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'nip' => ['required', 'unique:users,nip'],
                'password' => ['required', Rules\Password::defaults()],
                'roles' => ['required', 'array', 'min:1'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
            ]);

            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }

            DB::commit();
            return view('app.users.credential', [
                'email' => $user->email,
                'nip' => $user->nip,
                'password' => $request->password,
            ])->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('app.users.index')->with('success', 'User berhasil dihapus');
    }
}