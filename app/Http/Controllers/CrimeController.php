<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CrimeController extends Controller
{
 public function store(Request $request)
{
    // 1. Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|string|max:100',
        'location' => 'required|string|max:255',
        'incident_date' => 'required|date|before_or_equal:today',
        'status' => 'nullable|in:open,under investigation,closed',
    ]);

    // 2. Generate unique case number (e.g. "CASE-20250513-ABC123")
    $case_number = 'CASE-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

    // 3. Add user ID and case number
    $validated['user_id'] = Auth::id();
    $validated['case_number'] = $case_number;

    // 4. Create the record
    Crime::create($validated);

    // 5. Redirect or respond
    return redirect()->back()->with('success', 'Crime report submitted successfully.');
}

public function delete($id)
{
    // Optional: check if the report exists first
    $crime = Crime::findOrFail($id); // throws 404 if not found
    

    // Delete the record
    $crime->delete();

    // Return a redirect or Inertia response
    return redirect()->back()->with('success', 'Report deleted successfully.');
}

}
