<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdditionController extends Controller
{
    public function index()
    {
        try {
            $data = Addition::all();
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
            'nama_addition' => 'required|string|max:255',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Buat Perusahaan 

        $typecuci = Addition::create([
            'nama_addition' => $request->nama_addition,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Addition created successfully.',  
            'data' => $typecuci
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Addition::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia pada Addition smart laundry',
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
                'nama_addition' => 'required|string|max:255',
                'harga' => 'required',
                'deskripsi' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Addition::find($id);
            $data->nama_addition = $request->nama_addition;
            $data->harga = $request->harga;
            $data->deskripsi = $request->deskripsi;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Addition berhasil di ubah',
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
            $save = Addition::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Addition berhasil dihapus',
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
