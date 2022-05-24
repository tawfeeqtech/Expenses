<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Section;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TreatmentDataController extends Controller
{
    public function wallets()
    {
//        echo "test";exit;
        $wallets = Wallet::all();
        return response()->json($wallets);
    }
    public function contacts()
    {
        $contacts = Contacts::all();
        return response()->json($contacts);
    }

    public function sections(Request $request)
    {
        $sectionType = Section::where('type', $request->type)->select('id','name')->get();

        if (count($sectionType) > 0) {
            return response()->json($sectionType);
        }
    }

    public function subsections(Section $section)
    {
        return response()->json($section->subsections);
    }
}
