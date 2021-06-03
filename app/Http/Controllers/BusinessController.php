<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public $data_fixed = [
        [
            "Branche" => "Hotel" ,
            "Unbearbeitet" => 23 ,
            "GF" => 24 ,
            "Nicht" => 20 ,
            "Wiedervorlage" => 120 ,
            "Kein" => 150 ,
            "Zu" => 20 ,
            "Termine" => 20 ,
            "Kunden" => 50 ,
            "Blacklist" => 123 ,
            "Insgesamt" => 150
        ] ,
        [
            "Branche" => "Arzt" ,
            "Unbearbeitet" => 50 ,
            "GF" => 120 ,
            "Nicht" => 60 ,
            "Wiedervorlage" => 23 ,
            "Kein" => 0 ,
            "Zu" => 150 ,
            "Termine" => 20 ,
            "Kunden" => 50 ,
            "Blacklist" => 20 ,
            "Insgesamt" => 13
        ] ,
        [
            "Branche" => "Gym" ,
            "Unbearbeitet" => 54 ,
            "GF" => 0 ,
            "Nicht" => 10 ,
            "Wiedervorlage" => 42 ,
            "Kein" => 50 ,
            "Zu" => 20 ,
            "Termine" => 20 ,
            "Kunden" => 70 ,
            "Blacklist" => 102 ,
            "Insgesamt" => 406
        ] ,
        [
            "Branche" => "Restaurant" ,
            "Unbearbeitet" => 1 ,
            "GF" => 12 ,
            "Nicht" => 0 ,
            "Wiedervorlage" => 0 ,
            "Kein" => 0 ,
            "Zu" => 10 ,
            "Termine" => 20 ,
            "Kunden" => 58 ,
            "Blacklist" => 75 ,
            "Insgesamt" => 0
        ]
    ] ;

    public function index(Request $request)
    {
        $q = [] ;
        if ($request->has('q')) {
            $q = json_decode($request->input('q')) ;
        }
        // dd(count($q) == 0 || false !== array_search('Arzt' , array_column($q, 'name')) ) ;
        $table_data = [] ;

        foreach ($this->data_fixed as $iteme) {
            if(count($q) == 0 || false !== array_search($iteme["Branche"] , array_column($q, 'name'))  ) {
                array_push($table_data , $iteme) ;
            }
        }


        $filter_data = [] ;

        $branches = [] ;

        $footer = [
            "Unbearbeitet" => 0 ,
            "GF" => 0 ,
            "Nicht" => 0 ,
            "Wiedervorlage" => 0 ,
            "Kein" => 0 ,
            "Zu" => 0 ,
            "Termine" => 0 ,
            "Kunden" => 0 ,
            "Blacklist" => 0 ,
            "Insgesamt" => 0
            ] ;

        foreach ($table_data as $item) {
            foreach ($item as $key => $value) {
                if($key != "Branche") {
                    $footer[$key] += $value ;
                }
            }
        }

        foreach ($this->data_fixed as $item) {
            foreach ($item as $key => $value) {
                if($key == "Branche" && false === array_search($value , array_column($branches, 'name'))) {
                    array_push($branches , ["name" => $value , "code" => $value]) ;
                }
            }
        }

        $branches = json_encode($branches) ;
        return view('app' , [
            "table_data" => $table_data ,
            "filter_data" => $filter_data,
            "footer_data" => $footer ,
            "types_data" => $branches ,
            "q" => json_encode($q)
            ]);
    }
}
