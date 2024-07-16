<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Perusahaan::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Perusahaan tersedia',
            ];

            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Simpan ke folder perusahaan iamge
        // $file = $request->file('image');
        // $path = $file->storeAs('perusahaan_image', $file->hashName(), 'public');

         // Simpan image
        $url = null;
        if ($request->image != null) {
            $n = str_replace(' ', '-', $request->image);

            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $url = Storage::url($path);
        }

        // Buat Perusahaan 

        $perusahaan = Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'image' => $url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perusahaan created successfully.',
            'data' => $perusahaan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Perusahaan::where('id', $id)
                ->with('device')
                ->first();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Perusahaan tersedia',
            ];

            return response()->json($response, 200);

        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $url = null;
            if ($request->image != null) {
                $n = str_replace(' ', '-', $request->image);
    
                $file = $request->file('image');
                $path = $file->store('images', 'public');
                $url = Storage::url($path);
            }

            $data = Perusahaan::find($id);
            $data->nama_perusahaan = $request->nama_perusahaan;
            $data->deskripsi = $request->deskripsi;
            $data->lokasi = $request->lokasi;
            $data->image = $url;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Perusahaan berhasil di ubah pada smart laundry',
            ];

            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $save = Perusahaan::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'ID Perusahaan berhasil dihapus',
            ];
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => $th,
            ];
            return response()->json($response, 500);
        }

    }
}
