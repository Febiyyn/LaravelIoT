<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(){

        $device = Device::paginate(10);

        return view('device.index', compact('device'));
    }

    public function create(){

        return view('device.create');
    }

    public function store(Request $request){
        $request->validate([
            "serial_number" => ["required"],
            "meta_data" => ["required"],
        ], [
            "serial_number"=> "Serial Number harus disi",
            "meta_data"=> "Meta Data harus disi",
        ]);

        $deviceData = [
            "serial_number" => $request->serial_number,
            "meta_data" => $request->meta_data,
        ];

        Device::create($deviceData);

        return redirect('/device')->with('success', 'Berhasil menambahkan device');
    }

    public function edit($id){
        $device = Device::findOrFail($id);

        return view('device.edit', [
            'device' => $device,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "serial_number" => ["required"],
            "meta_data" => ["required"],
        ], [
            "serial_number"=> "Serial Number harus disi",
            "meta_data"=> "Meta Data harus disi",
        ]);

        $deviceData = [
            "serial_number" => $request->serial_number,
            "meta_data" => $request->meta_data,
        ];

        $device = Device::findOrFail($id)->update($deviceData);

        return redirect('/device')->with('success', 'Berhasil mengubah data device');
    }

    public function delete($id){
        $device = Device::findOrFail($id);
        $Device = Device::findOrFail($id);
        $Device->delete();

        return redirect('/device')->with('success', 'Berhasil menghapus data device dengan no seri ' . $device->serial_number);
    }
}
