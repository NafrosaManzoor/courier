<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Returns JSON data for branches
    public function getBranches() {
        $branches = [
            ['id' => 1, 'name' => 'Main Branch', 'location' => 'New York'],
            ['id' => 2, 'name' => 'Second Branch', 'location' => 'Los Angeles'],
            ['id' => 3, 'name' => 'Third Branch', 'location' => 'Chicago'],
        ];
        return response()->json($branches);
    }

    // Returns JSON data for staff
    public function getStaff() {
        $staff = [
            ['id' => 1, 'name' => 'John Doe', 'role' => 'Manager'],
            ['id' => 2, 'name' => 'Jane Smith', 'role' => 'Clerk'],
        ];
        return response()->json($staff);
    }

    // Returns JSON data for parcels
    public function getParcels() {
        $parcels = [
            ['id' => 1, 'trackingNo' => 'ABC123', 'status' => 'Shipped'],
            ['id' => 2, 'trackingNo' => 'XYZ456', 'status' => 'Delivered'],
        ];
        return response()->json($parcels);
    }

    
}
