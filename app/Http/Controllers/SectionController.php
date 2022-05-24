<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionStoreRequest;
use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
//        $incomeSections = Section::where('type', 'الدخل')->with('subsections')->get();
//        $data['incomeSections'] = $incomeSections;
//        return json_encode($data);
//        $incomeSections = Section::where('type', 'الدخل')->get();
//        $outlaySections = Section::where('type', 'المصروف')->get();

        $incomeSections = Section::where('type', 'الدخل')->with('subsections')->get();
        $outlaySections = Section::where('type', 'المصروف')->with('subsections')->get();

        return view("pages.section.index", compact('incomeSections','outlaySections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $incomeSections = Section::where('type', 'الدخل')->get();
        $outlaySections = Section::where('type', 'المصروف')->get();

        return view('pages.section.create', compact('incomeSections','outlaySections'));
    }


    /**
     * return states list.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getSectionType(Request $request)
    {
        $sectionType = Section::where('type', $request->type)->select('id','name')->get();
        if (count($sectionType) > 0) {
            return response()->json($sectionType);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param SectionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SectionStoreRequest $request)
    {
        $validated = $request->validated();
        if ($request->isVisible === "true") {
            $validated['section_id'] = $request->section_id;
            Subsection::create($validated);
            return redirect()->route('sections.index')->with('message', 'تم إنشاء القسم بنجاح');
        }

        Section::create($validated);
        return redirect()->route('sections.index')->with('message', 'تم إنشاء القسم بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $mySection
     * @return Factory|View
     */
    public function edit(Section $section)
    {

        return view('pages.section.edit', compact('section'));
    }

    public function edit_subsection(Subsection $subsection)
    {
        $subsection->section;
        $section = $subsection;
        $section['all'] = Section::where('type', $subsection->type)->get();
//        $comment = $subsection::find($subsection->id);
//        $array['subsection'] = $subsection;
//        $array['section'] = $section;
//        $sections =  ;
//        $array['section'] = $subsection;
//        return $subsection->section;
//        return $section;

//        return $comment;
//        return $subsection->section;
//        return $section;
//        return $section->subsections[0]->name;
        return view('pages.section.edit_subsection', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SectionStoreRequest $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function update(SectionStoreRequest $request, Section $section)
    {
        $validated = $request->validated();
        $array['validated'] = $validated;
        $array['request'] = $request->all();
        $array['section'] = $section;
//        $x = json_encode($array);
//        echo json_decode($array);
//        return $array;
        if (isset($request->typeHidden)) {
            $subSection = Subsection::find($request->subsection_id);
            $validated['section_id'] = $request->section_id;
//            return $subSection;
            $subSection->update($validated);
            return redirect()->route('sections.index')->with('message', 'تم تحديث القسم بنجاح');

        }

        $section->update($validated);
        return redirect()->route('sections.index')->with('message', 'تم تحديث القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function destroy(Request $request,Section $section)
    {
        if (isset($request->section_id)) {
            $subSection = Subsection::find($request->section_id);
            $subSection->delete();
            return redirect()->route('sections.index')->with('message', 'تم حذف القسم بنجاح');
        }else{
            $section->delete();
            return redirect()->route('sections.index')->with('message', 'تم حذف القسم بنجاح');
        }
    }
}
