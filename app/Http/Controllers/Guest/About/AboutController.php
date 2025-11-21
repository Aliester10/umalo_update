<?php

namespace App\Http\Controllers\Guest\About;

use App\Http\Controllers\Controller;
use App\Models\CompanyParameter;
use App\Models\BrandPartner;
use App\Models\TeamMember;
use App\Models\CoreValue;
use App\Models\ProcessStep;
use App\Helpers\TranslateHelper;

class AboutController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        // Data Perusahaan
        $company = CompanyParameter::first();
        if ($company && $company->description) {
            $company->description = TranslateHelper::translate($company->description, $locale);
        }

        // ==========================
        // TEAM MEMBERS (WITH SOCIALS)
        // ==========================
        $team = TeamMember::with('socials')
                ->orderBy('order', 'asc')
                ->get();

        // ==========================
        // CORE VALUES
        // ==========================
        $coreValues = CoreValue::orderBy('order')->get();

        // ==========================
        // PRODUCTION STEPS
        // ==========================
        $processSteps = ProcessStep::orderBy('step_number')->get();

        // ==========================
        // BRAND PARTNERS
        // ==========================
        $brands = BrandPartner::where('type', 'brand')->orderBy('id', 'asc')->get();

        return view('guest.about.about', compact(
            'company',
            'team',
            'coreValues',
            'processSteps',
            'brands'
        ));
    }
}
