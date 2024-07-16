<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Perusahaan;
use App\Models\TypeCuci;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class WebDeviceController extends Controller
{
    public function index()
    {
        $dat = Device::with(['Perusahaan', 'TypeCuci'])->get();
        return view('device', ['dat' => $dat]);
    }

    public function create()
    {
        $perusahaan = Perusahaan::all();
        $tipecuci = TypeCuci::all();
        return view('createdevice', compact('perusahaan', 'tipecuci'));
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perusahaan_id' => 'required',
            'type_cuci_id' => 'required',
            'nama_device' => 'required',
            'mac_address' => 'required',
            'status_booking' => 'required',
            'status_mesin' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $device = Device::create([
                'perusahaan_id' => $request->perusahaan_id,
                'type_cuci_id' => $request->type_cuci_id,
                'nama_device' => $request->nama_device,
                'mac_address' => $request->mac_address,
                'status_booking' => $request->status_booking,
                'status_mesin' => $request->status_mesin,
                'status' => $request->status
            ]);

            return redirect()->route('device')->with('success', 'Device created successfully.');
        } catch (Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());

            return redirect()->route('device')->with('error', 'Terjadi kesalahan saat menambahkan Device.');
        }
    }

    public function destroy($id)
    {
        $device = Device::find($id);

        if (empty($device)) {
            return redirect()->route('device')->with('error', 'Device not found');
        }

        $device->delete();
        return redirect()->route('device')->with('success', 'Device ID ' . $id . ' successfully deleted');
    }

    public function edit($id)
    {
        $device = Device::find($id);

        if (is_null($device)) {
            return redirect()->route('device')->with('error', 'Device tidak ditemukan');
        }

        $perusahaan = Perusahaan::all();
        $tipecuci = TypeCuci::all();

        $type_cuci_selected = $device->TypeCuci ? $device->TypeCuci->id : null;
        $perusahaan_selected = $device->perusahaan ? $device->perusahaan->id : null;

        return view('editdevice', compact('device', 'perusahaan', 'tipecuci', 'type_cuci_selected', 'perusahaan_selected'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'perusahaan_id' => ['required'],
            'type_cuci_id' => ['required'],
            'nama_device' => ['required'],
            'mac_address' => ['required'],
            'status_booking' => ['required'],
            'status_mesin' => ['required'],
            'status' => ['required'],
        ]);

        $device = Device::find($id);

        if (empty($device)) {
            return redirect()->route('device')->with('error', 'Device tidak ditemukan');
        }

        $device->perusahaan_id = $request->perusahaan_id;
        $device->type_cuci_id = $request->type_cuci_id;
        $device->nama_device = $request->nama_device;
        $device->mac_address = $request->mac_address;
        $device->status_booking = $request->status_booking;
        $device->status_mesin = $request->status_mesin;
        $device->status = $request->status;
        $device->save();

        return redirect()->route('device')->with('success', 'Device berhasil diperbarui');
    }
}
