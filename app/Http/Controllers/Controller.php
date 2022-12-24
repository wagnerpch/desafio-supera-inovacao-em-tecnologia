<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('welcome');
    }

    public function dashboard(){
        $user = auth()->user();
        $date_start = date('Y-m-d H:i:s', strtotime(today()."+1 days"));
        $date_end = date('Y-m-d H:i:s', strtotime(today()."+7 days"));
        $dados = [];
        $maintenance = [];
        $progress_toDo = [];
        $progress_doing = [];
        $progress_done = [];
        $cars = DB::table('cars')
            ->join('maintenances', 'cars.id', '=', 'car_id')
            ->where('maintenances.user_id', '=' ,$user->id)
            ->where('maintenances.date', '>=', $date_start)
            ->where('maintenances.date', '<=', $date_end)
            ->orderby('cars.car')
            ->orderby('maintenances.date')
            ->get()->toArray();

        
        for ($i = 0; $i < 7; $i++) {
            $dados[$i][] = date('d/m/Y', strtotime(today().'+'.($i+1).' days'));
            for ($car = 0; $car < count($cars); $car++) {
                if(date('Y-m-d', strtotime($cars[$car]->date)) == date('Y-m-d', strtotime(today().'+'.($i+1).' days'))){
                    $dados[$i][] = $cars[$car];
                    $maintenance[] += 1;
                    if($cars[$car]->progress == 'pendente'){
                        $progress_toDo[] += 1;
                    }elseif($cars[$car]->progress == 'em andamento'){
                        $progress_doing[] += 1;
                    }else{
                        $progress_done[] += 1;
                    }
                }
            }
        }
        $cars = $dados;
        return view('dashboard', compact('cars','maintenance','progress_toDo','progress_doing','progress_done'));
    }

}