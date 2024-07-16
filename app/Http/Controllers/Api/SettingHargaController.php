<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingHarga;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SettingHargaController extends Controller
{
    public function index()
    {
        try {
            $data = SettingHarga::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data addition tersedia',
            ];

            return response()->json($response, 200);
        } catch (Exception$th) {
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
            'type_cuci_id' => 'required',
            'harga_perKg' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Buat Perusahaan 

        $typecuci = SettingHarga::create([
            'type_cuci_id' => $request->type_cuci_id,
            'harga_perKg' => $request->harga_perKg,
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Setting Harga created successfully.',  
            'data' => $typecuci
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = SettingHarga::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia pada Setting Harga smart laundry',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type_cuci_id' => 'required',
                'harga_perKg' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = SettingHarga::find($id);
            $data->type_cuci_id = $request->type_cuci_id;
            $data->harga_perKg = $request->harga_perKg;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Setting Harga berhasil di ubah',
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
            $save = SettingHarga::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Setting Harga berhasil dihapus',
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
