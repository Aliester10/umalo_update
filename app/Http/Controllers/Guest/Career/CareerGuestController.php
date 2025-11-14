<?php

namespace App\Http\Controllers\Guest\Career;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CareerGuestController extends Controller
{
    public function index()
    {
        $positions = JobPosition::where('is_active', 1)->latest()->get();
        return view('guest.career.index', compact('positions'));
    }

    public function apply(Request $request)
    {
        try {
            // Validasi data input
            $validated = $request->validate([
                'position_id'  => 'required|exists:job_positions,id',
                'full_name'    => 'required|string|max:255',
                'email'        => 'required|email|max:255',
                'phone'        => 'required|string|max:20',
                'location'     => 'nullable|string|max:255',
                'linkedin'     => 'nullable|string|max:255',
                'resume'       => 'required|file|mimes:pdf,doc,docx|max:5120',
                'cover_letter' => 'nullable|string|max:5000',
            ]);

            // Validasi file resume
            if (!$request->hasFile('resume')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resume file is required'
                ], 422);
            }

            // Upload resume ke storage
            $resumePath = $request->file('resume')->store('resumes', 'public');

            $linkedinUrl = null;
            if (!empty($validated['linkedin'])) {
                $linkedin = trim($validated['linkedin']);
                if ($linkedin && !str_starts_with($linkedin, 'http://') && !str_starts_with($linkedin, 'https://')) {
                    $linkedin = 'https://' . $linkedin;
                }
                $linkedinUrl = $linkedin;
            }

            // Simpan aplikasi ke database
            JobApplication::create([
                'job_position_id' => $validated['position_id'],
                'full_name'       => $validated['full_name'],
                'email'           => $validated['email'],
                'phone'           => $validated['phone'],
                'location'        => $validated['location'] ?? null,
                'linkedin'        => $linkedinUrl,
                'resume'          => $resumePath, 
                'cover_letter'    => $validated['cover_letter'] ?? null,
                'status'          => 'pending',
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!'
            ], 200);

        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Handle other exceptions
            \Log::error('Career application error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}