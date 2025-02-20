<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class services extends Controller
{
    use Illuminate\Support\Facades\File;

public function index()
{
    // Fetch services from JSON file
    $jsonPath = storage_path('app/services.json');
    if (services::exists($jsonPath)) {
        $services = json_decode(services::get($jsonPath), true);
    } else {
        $services = []; // Handle case if file doesn't exist
    }

    // Pass services data to the view
    return view('service', compact('services'));
}

    
}
