<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Maintenance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MaintenanceController extends Controller
{

    public function maintenances(){
        $user = auth()->user();
        $cars = $user->cars;
        $maintenances = $user->maintenances;
        $collection = $maintenances;
        $sorted = $collection->sortBy('maintenance');
        $maintenances = $sorted->values()->all();
        return view('maintenances.maintenance', compact('maintenances', 'cars'));
    }

    public function create(){
        $user = auth()->user();
        $cars = $user->cars;
        $collection = $cars;
        $sorted = $collection->sortBy('car');
        $cars = $sorted->values()->all();
        return view('maintenances.maintenance-details', compact('cars'));
    }

    public function store(Request $request){
        $maintenance = new Maintenance;
        $maintenance->maintenance = $request->maintenance;
        $maintenance->progress = $request->progress;
        $maintenance->date = $request->date;
        $maintenance->car_id = $request->car_id;
        $user = auth()->user();
        $maintenance->user_id = $user->id;
        $maintenance->save();
        return redirect('/maintenances')->with('msg', 'Manutenção programada cadastrada!');
    }

    public function show($id) {
        $action = 'show';
        $user = auth()->user();
        try {
            $maintenance = Maintenance::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $maintenance = false;
        }
        if ($maintenance) {
            if($user->id == $maintenance->user_id){
                $car = Car::findOrFail($maintenance->car_id)->car;
                return view('maintenances.maintenance-details', compact('maintenance', 'car', 'action'));
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/dashboard');
        }
    }

    public function edit($id){
        $action = 'edit';
        $user = auth()->user();
        try {
            $maintenance = Maintenance::findOrFail($id);
            try {
                $car = Car::findOrFail($maintenance->car_id);
                $cars = $user->cars;
                $collection = $cars;
                $sorted = $collection->sortBy('car');
                $cars = $sorted->values()->all();
                $carName = $car->car;
            } catch (ModelNotFoundException $e) {
                $cars = false;
            }
        } catch (ModelNotFoundException $e) {
            $maintenance = false;
        }
        if ($maintenance && $cars) {
            if($user->id == $maintenance->user_id){
                return view('maintenances.maintenance-details', compact('maintenance', 'cars', 'carName', 'action'));
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/dashboard');
        }
    }

    public function update(Request $request){
        $data = $request->all();
        $user = auth()->user();
        try {
            $maintenance = Maintenance::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            $maintenance = false;
        }
        if($maintenance){
            if($user->id == $maintenance->user_id){
                $maintenance->update($data);
                return redirect('/maintenances')->with('msg', 'Dados da manutenção editados!');
            }else{
                return redirect('/maintenances')->with('msg', 'Não foi possível editar os dados!');
            }
        }else{
            return redirect('/dashboard');
        }
    }

    public function destroy($id){
        $user = auth()->user();
        try {
            $maintenance = Maintenance::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $maintenance = false;
        }
        if($maintenance){
            if($user->id == $maintenance->user_id){
                $maintenance->delete();
                return redirect('/maintenances')->with('msg', 'Manutenção excluída!');
            }else{
                return redirect('/maintenances')->with('msg', 'Não foi possível excluir os dados!');
            }
        }else{
            return redirect('/dashboard');
        }
    }

}
