<?php

namespace App\Http\Controllers;

use App\Models\New_Branch;
use App\Models\New_Parcel;
use App\Models\New_staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NewParcelController extends Controller
{
    // Display a listing of parcels
    public function index()
    {
        $parcels = New_Parcel::orderBy('created_at', 'desc')->get();
        $branches = New_Branch::all();
        $staff = New_staff::all(); // Fetch all staff records
    
        return view('admin.list_parcel', [
            'parcels' => $parcels,
            'branches' => $branches,
            'staff' => $staff // Pass the staff data to the view
        ]);
    }

    // Show the form for creating a new parcel
  public function create()
{
    $staff = New_staff::all();
    $branches = New_Branch::all();
    $parcel = null; // Initialize parcel as null for a new parcel

    return view('admin.new_parcel', compact('staff', 'branches', 'parcel'));
}


    // Save a parcel (handles both user and admin submissions)
    public function store(Request $request, $id = null)
{
    try {
        // Common validation rules
        $validationRules = [
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'sender_address' => 'required|string|max:255',
            'sender_contact' => 'required|string|max:15',
            'recipient_name' => 'required|string|max:255',
            'recipient_email' => 'required|email|max:255',
            'recipient_address' => 'required|string|max:255',
            'recipient_contact' => 'required| string|max:15',
        ];

        // Additional validation rules for admin submissions
        if ($id) {
            $validationRules = array_merge($validationRules, [
                'type' => 'required|in:item_accepted,collected,shipped,in_transit,arrived_at_destination,out_for_delivery,ready_to_pickup,delivered,picked_up,unsuccessful_delivery',
                'weight' => 'required|numeric',
                'height' => 'required|numeric',
                'length' => 'required|numeric',
                'width' => 'required|numeric',
                'price' => 'required|numeric',
                'branch_id' => 'required|exists:new_branches,id',
                'staff_id' => 'required|exists:new_staffs,id',
            ]);
        } else {
            $validationRules['reference_number']; // This will ensure reference number is required for users
        }

        $validatedData = $request->validate($validationRules);

        // Generate reference number only for new parcels
        if (!$id) {
            $validatedData['reference_number'] = 'REF-' . time();
        }

        // Save or update the parcel
        if ($id) {
            $parcel = New_Parcel::findOrFail($id);
            $parcel->update($validatedData);
            return response()->json(['status' => 'success', 'message' => 'Parcel updated successfully.']);
        } else {
            New_Parcel::create($validatedData);
            return response()->json(['status' => 'success', 'message' => 'Parcel created successfully.']);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error: ', $e->validator->errors()->toArray());
        return response()->json(['errors' => $e->validator->errors()], 422);
    } catch (\Exception $e) {
        Log::error('Error occurred: ', [$e->getMessage()]);
        return response()->json(['status' => 'error', 'message' => 'An error occurred. Please try again later.'], 500);
    }
}

//     public function store(Request $request, $id = null)
// {
//     try {
//         // Define validation rules for admin and user
//         $userValidation = [
//             'sender_name' => 'required|string|max:255',
//             'sender_email' => 'required|email|max:255',
//             'sender_address' => 'required|string|max:255',
//             'sender_contact' => 'required|string|max:15',
//             'recipient_name' => 'required|string|max:255',
//             'recipient_email' => 'required|email|max:255',
//             'recipient_address' => 'required|string|max:255',
//             'recipient_contact' => 'required|string|max:15',
//         ];

//         $adminValidation = [
//             'type' => 'required|in:item_accepted,collected,shipped,in_transit,arrived_at_destination,out_for_delivery,ready_to_pickup,delivered,picked_up,unsuccessful_delivery',
//             'weight' => 'required|numeric',
//             'height' => 'required|numeric',
//             'length' => 'required|numeric',
//             'width' => 'required|numeric',
//             'price' => 'required|numeric',
//             'branch_id' => 'required|exists:new_branches,id',
//             'staff_id' => 'required|exists:new_staffs,id',
//         ];

//         // Check if it's an admin submission based on the presence of the $id
//         if ($id) { // If $id is provided, it's an admin submission
//             $validatedData = $request->validate($adminValidation);
//         } else { // If no $id, it's a user submission
//             $validatedData = $request->validate($userValidation);
//             // Generate reference number for new parcels only
//             $validatedData['reference_number'] = 'REF-' . time();
//         }

//         // Save or update the parcel
//         if ($id) {
//             $parcel = New_Parcel::findOrFail($id);
//             $parcel->update($validatedData);
//             return response()->json(['status' => 'success', 'message' => 'Parcel updated successfully.']);
//         } else {
//             New_Parcel::create($validatedData);
//             return response()->json(['status' => 'success', 'message' => 'Parcel created successfully.']);
//         }
//     } catch (\Illuminate\Validation\ValidationException $e) {
//         Log::error('Validation Error: ', $e->validator->errors()->toArray());
//         return response()->json(['errors' => $e->validator->errors()], 422);
//     }
// }




    // Send tracking details via email
    public function sendTrackingEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $parcel = New_Parcel::where('sender_email', $validatedData['email'])
                            ->orWhere('recipient_email', $validatedData['email'])
                            ->first();

        if ($parcel) {
            $userEmail = $validatedData['email'];

            Mail::send('emails.parcel_tracking', ['parcel' => $parcel], function ($message) use ($userEmail) {
                $message->to($userEmail)
                        ->subject('Your Parcel Tracking Details');
            });

            return response()->json(['status' => 'success', 'message' => 'Tracking details have been sent to your email.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No parcel found with the provided email.'], 404);
        }
    }

    // Edit a parcel
    // public function edit($id)
    // {
    //     $parcel = New_Parcel::find($id);
    //     $branches = New_Branch::all();
    //     $staff = New_staff::all();
    //     return view('admin.new_parcel', compact('parcel', 'branches', 'staff'));
    // }

    // Show the form for editing a parcel
public function edit($id)
{
    $parcel = New_Parcel::findOrFail($id); // Fetch the existing parcel
    $branches = New_Branch::all();
    $staff = New_staff::all();
    return view('admin.new_parcel', compact('parcel', 'branches', 'staff'));
}

// Handle updating the parcel
public function update(Request $request, $id)
{
    try {
        // Validation rules for admin edit
        $adminValidation = [
            'type' => 'required|in:item_accepted,collected,shipped,in_transit,arrived_at_destination,out_for_delivery,ready_to_pickup,delivered,picked_up,unsuccessful_delivery',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'price' => 'required|numeric',
            'branch_id' => 'required|exists:new_branches,id',
            'staff_id' => 'required|exists:new_staffs,id',
        ];

        $validatedData = $request->validate($adminValidation);

        // Update the parcel
        $parcel = New_Parcel::findOrFail($id);
        $parcel->update($validatedData);

        return response()->json(['status' => 'success', 'message' => 'Parcel updated successfully.']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error: ', $e->validator->errors()->toArray());
        return response()->json(['errors' => $e->validator->errors()], 422);
    }
}


    // Delete a parcel
    public function destroy($id)
    {
        $parcel = New_Parcel::find($id);

        if ($parcel) {
            $parcel->delete();
            return response()->json(['status' => 'success',  'message' => 'Parcel deleted successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Parcel not found.'], 404);
    }
}
