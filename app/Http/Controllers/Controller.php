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
        for ($i = 0; $i < 7; $i++){
            $dados[$i][] = date('d/m/Y', strtotime(today().'+'.($i+1).' days'));
            foreach($cars as $car){
                if($car->date == date('Y-m-d H:i:s', strtotime(today().'+'.($i+1).' days'))){
                    $dados[$i][] = $car;
                    $maintenance[] = $i;
                    if($car->progress == 'pendente'){
                        $progress_toDo[] = $i;
                    }elseif($car->progress == 'em andamento'){
                        $progress_doing[] = $i;
                    }else{
                        $progress_done[] = $i;
                    }
                }
            }
        }
        $cars = $dados;
        return view('dashboard', compact('cars','maintenance','progress_toDo','progress_doing','progress_done'));
    }

}