<?php

namespace App\Http\Controllers;

use App\Models\New_Staff;
use App\Models\New_Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewStaffController extends Controller
{
    // Display a listing of staff members
    public function index()
    {
        // Fetch staff with associated branch
        $staffs = New_Staff::with('branch')->orderBy('last_name')->orderBy('first_name')->get();
        $branches = New_Branch::orderBy('street')->orderBy('city')->orderBy('state')->get(); 
        return view('admin.list_staff', compact('staffs', 'branches'));
    }

    // Show the form for creating a new staff member
    public function create()
    {
        $branches = New_Branch::orderBy('street')->orderBy('city')->orderBy('state')->get();
        return view('admin.new_staff', compact('branches'));
    }

    // Save staff data (handle both create and update)
    public function saveStaff(Request $request, $id = null)
    {
        // Validation logic
        $validatedData = $request->validate([
            'staff_id' => 'required|string|max:255|unique:new_staffs,staff_id,' . ($id ?? 'NULL'), // Validate uniqueness of staff_id
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:new_branches,id',
            'email' => 'required|email|unique:new_staffs,email,' . ($id ?? 'NULL'),
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
        ]);

        if ($id) {
            // Update existing staff
            $staff = New_Staff::findOrFail($id);
            $staff->update(array_filter([
                'staff_id' => $validatedData['staff_id'], // Update staff_id
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'branch_id' => $validatedData['branch_id'],
                'email' => $validatedData['email'],
            ]));

            if ($request->filled('password')) {
                $staff->update(['password' => Hash::make($request->password)]);
            }

            return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
        } else {
            // Create new staff
            New_Staff::create([
                'staff_id' => $validatedData['staff_id'], // Create with staff_id
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'branch_id' => $validatedData['branch_id'],
                'email' => $validatedData['email'],
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
        }
    }

    // Edit a staff member
    public function editStaff($id)
    {
        $staff = New_Staff::findOrFail($id);
        $branches = New_Branch::orderBy('street')->orderBy('city')->orderBy('state')->get();
        return view('admin.new_staff', compact('staff', 'branches'));
    }

    // Delete a staff member
    public function destroy($id)
    {
        $staff = New_Staff::findOrFail($id);

        if ($staff) {
            $staff->delete();
            return response()->json(['status' => 'success', 'message' => 'Staff successfully deleted.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Staff not found.'], 404);
    }
}
