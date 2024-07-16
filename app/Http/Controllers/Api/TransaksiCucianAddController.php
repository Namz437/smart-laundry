<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiCucianAdd;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransaksiCucianAddController extends Controller
{
    
    public function index()
    {
        try {
            $data = TransaksiCucianAdd::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Transaksi cucian additional tersedia',
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
            'transaksi_cucian_id' => 'required',
            'addition_id' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Buat Perusahaan 

        $typecuci = TransaksiCucianAdd::create([
            'transaksi_cucian_id' => $request->transaksi_cucian_id,
            'addition_id' => $request->addition_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi cucian Additional created successfully.',  
            'data' => $typecuci
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = TransaksiCucianAdd::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia pada Transaksi cucian add smart laundry',
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
                'transaksi_cucian_id' => 'required',
                'addition_id' => 'required',
                'jumlah' => 'required',
                'total_harga' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = TransaksiCucianAdd::find($id);
            $data->transaksi_cucian_id = $request->transaksi_cucian_id;
            $data->addition_id = $request->addition_id;
            $data->jumlah = $request->jumlah;
            $data->total_harga = $request->total_harga;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data transaksi cucian additional berhasil di ubah',
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
            $save = TransaksiCucianAdd::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Transaksi cucian Additional berhasil dihapus',
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
