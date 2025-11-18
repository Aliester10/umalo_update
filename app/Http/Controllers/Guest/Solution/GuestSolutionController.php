<?php

namespace App\Http\Controllers\Guest\Solution;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class GuestSolutionController extends Controller
{
    /**
     * Display a listing of published solutions
     */
    public function index()
    {
        $solutions = Solution::with('features')
            ->where('status', 'published') // ✅ UBAH DARI 'active' KE 'published'
            ->orderBy('order', 'asc')
            ->get();

        return view('guest.solution.index', compact('solutions'));
    }

    /**
     * Display the specified solution
     */
    public function show($slug)
    {
        $solution = Solution::with('features')
            ->where('slug', $slug)
            ->where('status', 'published') // ✅ UBAH DARI 'active' KE 'published'
            ->firstOrFail();
            
        return view('guest.solution.show', compact('solution'));
    }

    /**
     * Download solution brochure
     */
    public function downloadBrochure($slug)
    {
        $solution = Solution::where('slug', $slug)
            ->where('status', 'published') // ✅ UBAH DARI 'active' KE 'published'
            ->firstOrFail();
        
        if (!$solution->brochure_file) {
            abort(404, 'Brochure not available for this solution.');
        }

        $filePath = public_path($solution->brochure_file);

        if (!File::exists($filePath)) {
            abort(404, 'Brochure file not found on server.');
        }
        
        $fileName = basename($solution->brochure_file);
        
        return response()->download($filePath, $fileName);
    }
}