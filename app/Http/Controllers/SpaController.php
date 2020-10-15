<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaController extends Controller
{
    public function index(){
        return view('app');
    }
    public function saveRecords(Request $request){
        $date = date("Y/m/d");
        $count = count($request->record);
        for($i = 0;$i < $count;$i++){
            if($request->record[$i]['Event'] != null && $request->record[$i]['Event'] != ""){
                DB::table("calendar")->insert([
                    'event' => $request->record[$i]['Event'],
                    'date_event' => $request->record[$i]['Date'],
                    'created_date' => $date,
                    'created_by' => 'Jerome'
                ]);
            }
        }
        return response()->json(['status' => 'success'], 200);
    }
}
