<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentRequest;
use App\Http\Resources\TreatmentResource;
use App\Models\Treatment;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
//        $transactions = Treatment::with(['wallet:id,name'])->get();
        /*$studentData = Student::select('id', 'name')->with([
            'wallet:id,filename,imageable_id',
        ])->where('section_id', $id)->orderBy('id', 'ASC')->paginate();*/


//        $transaction = $transactions->section;
        $transactions = Treatment::orderBy('id', 'DESC')->paginate(5);
//        return response()->json($transactions);
        return TreatmentResource::collection($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TreatmentRequest $request
     * @return JsonResponse
     */
    public function store(TreatmentRequest $request)
    {
        $validated = $request->validated();


        if($request->type === "الدخل"){
            $this->walletBalance($request->wallet_id,$request->balance,"+");
        }else{
            $this->walletBalance($request->wallet_id,$request->balance,"-");
        }

        $validated['section_id'] = $request->section_id;
        $subsection = $request->subsection_id;

        if($subsection ==="selected"){
            $subsection = null;
        }

        $validated['subsection_id'] = $subsection;
        $validated['contact_id'] = $request->contact_id;

        $treatment = Treatment::create($validated);

        return response()->json($treatment);
    }

    public function walletBalance($wallet_id, $balance, $signal){
        $wallet = Wallet::find($wallet_id);
        $oldBalance = $wallet->balance;
        $newBalance = 0;
        switch ($signal){
            case '+':
                $newBalance = $oldBalance + $balance;
                break;
            case '-':
                $newBalance = $oldBalance - $balance;
                break;
        }
        $updated['balance'] = $newBalance;
        $wallet->update($updated);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
