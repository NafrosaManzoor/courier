<?php

namespace App\Http\Controllers;

use App\Models\New_Branch; // model name
use Illuminate\Http\Request;

class NewBranchController extends Controller
{
    // Display a listing of branches
    public function index()
    {
        $branches = New_Branch::orderBy('branch_id')->orderBy('street')->orderBy('city')->orderBy('state')->get();
        return view('admin.list_branch', compact('branches'));
    }

    // Show the form for creating a new branch
    public function create()
    {
        return view('admin.new_branch');
    }

    // Save branch data (handle both create and update)
    public function saveBranch(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'branch_id' => 'required|string|max:50',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
        ]);

        if ($id) {
            // Update existing branch
            $branch = New_Branch::findOrFail($id);
            $branch->update($validatedData);
            return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
        } else {
            // Create new branch
            New_Branch::create($validatedData);
            return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
        }
    }

    // Edit a branch
    public function editBranch($id)
    {
        $branch = New_Branch::find($id);
        return view('admin.new_branch', compact('branch'));
    }

    // Delete a branch
    public function destroy($id)
    {
        $branch = New_Branch::find($id);

        if ($branch) {
            $branch->delete();
            return response()->json(['status' => 'success', 'message' => 'Branch successfully deleted.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Branch not found.'], 404);
    }
}
