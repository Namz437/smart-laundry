<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Device::all();
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Device tersedia',
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
        try {
            //cek apakah request berisi users_id dan roles_id
            $validator = Validator::make($request->all(), [
                'perusahaan_id' => 'required',
                'type_cuci_id' => 'required',
                'nama_device' => 'required',
                'mac_address' => 'required|unique:device,mac_address',

            ]);
            
            //kalau tidak akan mengembalikan error
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            
            //kalau ya maka akan membuat setting_roles baru
            $data = Device::create([
                'perusahaan_id' => $request->perusahaan_id,
                'type_cuci_id' => $request->type_cuci_id,
                'nama_device' => $request->nama_device,
                'mac_address' => $request->mac_address,

            ]);
            
            //data akan di kirimkan dalam bentuk response list
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Device berhasil disimpan',
            ];
            
            //jika berhasil maka akan mengirimkan status code 200
            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => 'Gagal Menyimpan Device',
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
            $data = Device::find($id);
            if ($data == null){
                $response = [
                    'success' => false,
                    'message' => 'Device Tidak Ditemukan',
                ];
                return response()->json($response, 500);
            }
            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data Device tersedia',
            ];

            return response()->json($response, 200);
        } catch (Exception $th) {
            $response = [
                'success' => false,
                'message' => 'Device Tidak Ditemukan',
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
                'perusahaan_id' => 'required',
                'type_cuci_id' => 'required',
                'nama_device' => 'required',
                'mac_address' => 'required|unique:device,mac_address',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Device::find($id);
            $data->perusahaan_id = $request->perusahaan_id;
            $data->type_cuci_id = $request->type_cuci_id;
            $data->nama_device = $request->nama_device;
            $data->mac_address = $request->mac_address;

            $data->save();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Data device berhasil diubah',
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
            $save = Device::find($id);
            if ($save == null) {
                return response()->json(['success' => false, 'message' => 'Periksa kembali data yang akan di hapus'], 404);
            }
            $save->delete();
            $response = [
                'success' => true,
                'message' => 'Device berhasil dihapus',
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
