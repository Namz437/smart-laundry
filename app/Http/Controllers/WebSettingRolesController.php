<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\SettingRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;


class WebSettingRolesController extends Controller
{
    public function index()
    {
        $dat = SettingRoles::with(['Users', 'Roles'])->get();
        return view('settingroles', ['dat' => $dat]);
    }

    public function create()
    {
        $users = User::all();
        $roles = Roles::all();
        return view('createsettingroles', compact('users', 'roles'));
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'roles_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $settingroles = SettingRoles::create([
                'users_id' => $request->users_id,
                'roles_id' => $request->roles_id,
            ]);

            return redirect()->route('settingroles')->with('success', 'Setting Roles created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());

            return redirect()->route('settingroles')->with('error', 'Terjadi kesalahan saat menambahkan Setting Roles.');
        }
    }

    public function destroy($id)
    {
        $settingroles = SettingRoles::find($id);

        if (empty($settingroles)) {
            return redirect()->route('settingroles')->with('error', 'Setting Roles not found');
        }

        $settingroles->delete();
        return redirect()->route('settingroles')->with('success', 'Setting Roles ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $settingroles = SettingRoles::find($id);

        if (is_null($settingroles)) {
            return redirect()->route('settingroles')->with('error', 'Setting Roles tidak ditemukan');
        }

        $user = User::all();
        $roles = Roles::all();

        $users_selected = $settingroles->user ? $settingroles->user->id : null;
        $roles_selected = $settingroles->Roles ? $settingroles->Roles->id : null;

        return view('editsettingroles', compact('settingroles', 'user', 'roles', 'users_selected', 'roles_selected'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'users_id' => ['required'],
            'roles_id' => ['required'],
        ]);

        $settingroles = SettingRoles::find($id);

        if (empty($settingroles)) {
            return redirect()->route('settingroles')->with('error', 'Setting Roles tidak ditemukan');
        }

        $settingroles->users_id = $request->users_id;
        $settingroles->roles_id = $request->roles_id;
        $settingroles->save();

        return redirect()->route('settingroles')->with('success', 'Setting Roles berhasil diperbarui');
    }
}
