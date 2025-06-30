<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index() {
        $devices = Device::all();

        return view('dashboard/index', [
            "devices" => $devices,
        ]);
    }
}
