<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class WebRolesController extends Controller
{
    public function index()
    {
        try {
            $datas = Roles::all();
            return view('roles', ['datas' => $datas]);
        } catch (Exception $th) {
            return redirect()->route('roles')->with('error', 'Terjadi kesalahan saat mengambil data roles.');
        }
    }

    public function create()
    {
        $perusahaan = Roles::all();
        return view('createroles'); // nama view sesuai
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $role = Roles::create([
                'nama_role' => $request->nama_role,
            ]);

            return redirect()->route('role')->with('success', 'Roles created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('role')->with('error', 'Terjadi kesalahan saat menambahkan Roles.');
        }
    }

    public function destroy($id)
    {
        $role = Roles::find($id);

        if (empty($role)) {
            return redirect()->route('role')->with('error', 'Roles not found');
        }

        $role->delete();
        return redirect()->route('role')->with('success', 'Roles ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $role = Roles::find($id);

        if (empty($role)) {
            return redirect()->route('role')->with('error', 'Roles tidak ditemukan');
        }

        return view('editroles', ['role' => $role]); // Menggunakan view yang berbeda untuk edit
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_role' => ['required'],
        ]);

        $role = Roles::find($id);

        if (empty($role)) {
            return redirect()->route('role')->with('error', 'Roles tidak ditemukan');
        }

        $role->nama_role = $request->input('nama_role', $role->nama_role);
        $role->save();

        return redirect()->route('role')->with('success', 'Roles berhasil diperbarui');
    }

}
