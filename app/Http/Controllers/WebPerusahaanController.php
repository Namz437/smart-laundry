<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class WebPerusahaanController extends Controller
{
    public function index()
    {
        try {
            $datas = Perusahaan::all();
            return view('table', ['datas' => $datas]);
        } catch (Exception $th) {
            return redirect()->route('table')->with('error', 'Terjadi kesalahan saat mengambil data perusahaan.');
        }
    }

    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('createperusahaan'); // nama view sesuai
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $url = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $url = Storage::url($path);
        }

        try {
            $perusahaan = Perusahaan::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'image' => $url
            ]);

            return redirect()->route('table')->with('success', 'Perusahaan created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('table')->with('error', 'Terjadi kesalahan saat menambahkan perusahaan.');
        }
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::find($id);

        if (empty($perusahaan)) {
            return redirect()->route('table')->with('error', 'Perusahaan not found');
        }

        $perusahaan->delete();
        return redirect()->route('table')->with('success', 'Perusahaan ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::find($id);

        if (empty($perusahaan)) {
            return redirect()->route('table')->with('error', 'Perusahaan tidak ditemukan');
        }

        return view('editperusahaan', ['perusahaan' => $perusahaan]); // Menggunakan view yang berbeda untuk edit
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_perusahaan' => ['required'],
            'deskripsi' => ['required'],
            'lokasi' => ['required'],
            'image' => ['nullable', 'image'],
        ]);

        $perusahaan = Perusahaan::find($id);

        if (empty($perusahaan)) {
            return redirect()->route('table')->with('error', 'Perusahaan tidak ditemukan');
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $url = Storage::url($path);
            $perusahaan->image = $url; // Perbarui URL gambar hanya jika ada file baru
        }

        $perusahaan->nama_perusahaan = $request->input('nama_perusahaan', $perusahaan->nama_perusahaan);
        $perusahaan->deskripsi = $request->deskripsi;
        $perusahaan->lokasi = $request->lokasi;
        $perusahaan->save();

        return redirect()->route('table')->with('success', 'Perusahaan berhasil diperbarui');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Log Out berhasil');
    }
}
