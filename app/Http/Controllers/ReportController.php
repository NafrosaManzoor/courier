<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New_Parcel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    // Display the report page
    public function index()
    {
        return view('admin.report');
    }

    // Fetch filtered report data
public function generateReport(Request $request)
{
    // Log the incoming request data
    Log::info('Request Data:', $request->all());

    $status = $request->input('status');
    $dateFrom = Carbon::parse($request->input('date_from'));
    $dateTo = Carbon::parse($request->input('date_to'));

    // Log the parsed dates
    Log::info('Parsed Dates:', ['dateFrom' => $dateFrom, 'dateTo' => $dateTo]);

    // Build the query
    $query = New_Parcel::whereBetween('created_at', [$dateFrom->startOfDay(), $dateTo->endOfDay()]);

    if ($status !== 'all') {
        $query->where('type', $status);
    }

    // Log the query and bindings
    Log::info('Query:', $query->toSql());
    Log::info('Bindings:', $query->getBindings());

    $parcels = $query->get();

    return response()->json($parcels);
}
}