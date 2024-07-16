<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class WebUserController extends Controller
{
    public function index()
    {
        try {
            $dat = User::all();
            return view('user', ['dat' => $dat]);
        } catch (Exception $th) {
            return redirect()->route('user')->with('error', 'Terjadi kesalahan saat mengambil data user.');
        }
    }

    public function create()
    {
        $user = User::all();
        return view('createuser'); // nama view sesuai
    }

    // Belum bisa menambahkan data users
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

            return redirect()->route('user')->with('success', 'User created successfully.');
    }
    
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('user')->with('error', 'User not found');
        }

        $user->delete();
        return redirect()->route('user')->with('success', 'User ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('user')->with('error', 'Users tidak ditemukan');
        }

        return view('edituser', ['user' => $user]); // Menggunakan view yang berbeda untuk edit
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('table')->with('error', 'User tidak ditemukan');
        }

        $user->name = $request->input('name', $user->name);
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil diperbarui');
    }

}
