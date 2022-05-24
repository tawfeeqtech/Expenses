<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentStatisticsResource;
use App\Models\Treatment;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */


    public function index()
    {
        $data = array();


        /*start  تقرير اليوم*/
        $transactionThisDay = Treatment::orderBy('id', 'DESC')->where('date', '>=', Carbon::now()->subdays(1))->get(['balance', 'section_id']);
        $today = TreatmentStatisticsResource::collection($transactionThisDay);
        $todayData = $this->collectionData($today);
        $data['today'] = $todayData;
        /*end  تقرير اليوم*/

        /*start  تقرير امس*/
        $transactionLastDay = Treatment::orderBy('id', 'DESC')->where('date', '=', Carbon::yesterday())->get(['balance', 'section_id']);
        $yesterday = TreatmentStatisticsResource::collection($transactionLastDay);
        $yesterdayData = $this->collectionData($yesterday);
        $data['yesterdays'] = $yesterdayData;
        /*end  تقرير امس*/


        /*start  تقرير الاسبوع السابق*/
        $getLastWeek = $this->getLastWeek();
        $start_week = $getLastWeek['start_week'];
        $end_week = $getLastWeek['end_week'];
        $transactionLastWeek = Treatment::orderBy('id', 'DESC')->whereBetween('date', [$start_week, $end_week])->get(['balance', 'section_id']);
        $lastWeek = TreatmentStatisticsResource::collection($transactionLastWeek);
        $lastWeekData = $this->collectionData($lastWeek);
        $data['lastWeeks'] = $lastWeekData;
        /*end  تقرير الاسبوع السابق*/


        /*start  تقرير الاسبوع الحالي*/
        $getCurrentWeek = $this->getCurrentWeek();
        $star = $getCurrentWeek['start_week'];
        $end = $getCurrentWeek['end_week'];
        $transactionCurrentWeek = Treatment::orderBy('id', 'DESC')->whereBetween('date', [$star, $end])->get(['balance', 'section_id']);
        $currentWeek = TreatmentStatisticsResource::collection($transactionCurrentWeek);
        $currentWeekData = $this->collectionData($currentWeek);
        $data['currentWeek'] = $currentWeekData;
        /*end  تقرير الاسبوع الحالي*/

//        return $data;

        /*start  تقرير الشهر الحالي*/
        $transactionThisMonth = Treatment::orderBy('id', 'DESC')->where('date', '>=', Carbon::now()->subdays(30))->get(['balance', 'section_id']);
        $thisMonth = TreatmentStatisticsResource::collection($transactionThisMonth);
        $thisMonthData = $this->collectionData($thisMonth);
        $data['thisMonth'] = $thisMonthData;
        /*end  تقرير الشهر الحالي*/


        /*start  تقرير الشهر الحالي*/
        $transactionLastMonth = Treatment::orderBy('id', 'DESC')->whereMonth('date', '=', Carbon::now()->subMonth()->month)->get(['balance', 'section_id']);
        $previousMonth = TreatmentStatisticsResource::collection($transactionLastMonth);
        $previousMonthData = $this->collectionData($previousMonth);
        $data['previousMonth'] = $previousMonthData;
        /*end  تقرير الشهر الحالي*/


        return view('pages.dashboard', compact('data'));
    }

    public function getWeekSt()
    {
        /*start  تقرير قبل 7 ايام*/
        $now = Carbon::now(); //22-05 --- 15-05

        $last7 = $this->getReport($now);
        $data_last7 = $this->reportAsWeek($last7);
        /*end  تقرير قبل 7 ايام*/
        /*start  تقرير قبل 14 يوم*/
        $last14 = $this->getReport($last7); //15-05 --- 08-05
        $data_last14 =$this->reportAsWeek($last14);
        /*end  تقرير قبل 14 يوم*/

        /*start  تقرير قبل 21 يوم*/
        $last21 = $this->getReport($last14); //08-05 --- 01-05
        $data_last21 = $this->reportAsWeek($last21);
        /*end  تقرير قبل 21 يوم*/

        /*start  تقرير قبل 21 يوم*/
        $last28 = $this->getReport($last21); //08-05 --- 01-05
        $data_last28 = $this->reportAsWeek($last28);
        /*end  تقرير قبل 21 يوم*/


        $data = [
            '7' => $data_last7,
            '14' => $data_last14,
            '21' => $data_last21,
            '28' => $data_last28
        ];
        return response()->json($data);
    }

    public function reportAsWeek($date)
    {
        $lastDay = Treatment::orderBy('id', 'DESC')->where('date', '>', $date)->get(['balance', 'section_id']);
        $collection = TreatmentStatisticsResource::collection($lastDay);
        return $this->collectionData($collection);
    }

    public function getReport($now)
    {
        return $now->subDays(7)->endOfDay(); // 15
    }

    public function collectionData($today)
    {
        $countA = 0;
        $countB = 0;
        foreach ($today as $day) {
            if ($day->section->type === 'المصروف') {
                $countA += $day->balance;
            } else {
                $countB += $day->balance;
            }
        }
        $todayData['الدخل'] = $countB;
        $todayData['المصروف'] = $countA;
        return $todayData;
    }

    public function getLastWeek()
    {
        return $this->getWeek('-1');
    }

    public function getCurrentWeek()
    {
        return $this->getWeek('0');
    }

    public function getWeek($text)
    {
        $previous_week = strtotime($text . " week +1 day");
        $start_week = strtotime("last saturday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);
        $data['start_week'] = $start_week;
        $data['end_week'] = $end_week;
        return $data;
    }

}
