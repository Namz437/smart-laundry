<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiCucian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransaksiCucianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = TransaksiCucian::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data transaksi cucian tersedia',
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
    try {
        //cek apakah request berisi users_id dan roles_id
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'device_id' => 'required',
            'waktu_cuci' => 'required',
            'status_transaksi' => 'required',
            'total_harga' => 'required',

        ]);
        
        //kalau tidak akan mengembalikan error
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        //kalau ya maka akan membuat setting_roles baru
        $data = TransaksiCucian::create([
            'users_id' => $request->users_id,
            'device_id' => $request->device_id,
            'waktu_cuci' => $request->waktu_cuci,
            'status_transaksi' => $request->status_transaksi,
            'total_harga' => $request->total_harga,

        ]);
        
        //data akan di kirimkan dalam bentuk response list
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Data Transaksi Cucian berhasil disimpan',
        ];
        
        //jika berhasil maka akan mengirimkan status code 200
        return response()->json($response, 200);
    } catch (Exception $th) {
        $response = [
            'success' => false,
            'message' => 'Gagal Menyimpan Data Transaksi',
        ];
        //jika error maka akan mengirimkan status code 500
        return response()->json($response, 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = TransaksiCucian::find($id);
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data tersedia pada Transaksi Cucian smart laundry',
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
                'users_id' => 'required|string|max:255',
                'device_id' => 'required',
                'waktu_cuci' => 'required',
                'status_transaksi' => 'required',
                'total_harga' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = TransaksiCucian::find($id);
            $data->users_id = $request->users_id;
            $data->device_id = $request->device_id;
            $data->waktu_cuci = $request->waktu_cuci;
            $data->status_transaksi = $request->status_transaksi;
            $data->total_harga = $request->total_harga;
            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data transaksi cucian berhasil di ubah',
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
            $save = TransaksiCucian::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'transaksi cucian berhasil dihapus',
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
