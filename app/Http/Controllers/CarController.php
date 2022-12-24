<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Maintenance;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

class CarController extends Controller
{

    public function cars(){
        $user = auth()->user();
        $cars = $user->cars;
        $maintenances = $user->maintenances;
        $dados = array();
        $index = 0;
        foreach($cars as $car){
            $i = 0;
            $dados[$index]['car_id'] = $car->id;
            $dados[$index]['car_name'] = $car->car;
            $dados[$index]['car_license'] = $car->license;
            foreach($maintenances as $maintenance){
                if($maintenance->car_id == $car->id){
                    $i++;
                }
            }
            $dados[$index]['car_maintenance'] = $i;
            $index++;
        }
        $cars = collect($dados)->sortBy('car_name')->toArray();
        return view('cars.car', compact('cars'));
    }

    public function create(){
        return view('cars.car-details');
    }

    public function store(Request $request){
        $car = new Car;
        $car->car = $request->car;
        $car->license = $request->license;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->version = $request->version;
        $user = auth()->user();
        $car->user_id = $user->id;
        $car->save();
        return redirect('/cars')->with('msg', 'Carro cadastrado!');
    }

    public function show($id) {
        $action = 'show';
        $user = auth()->user();
        try {
            $car = Car::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $car = false;
        }
        if ($car) {
            if($user->id == $car->user_id){
                return view('cars.car-details', compact('car', 'action'));
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
            $car = Car::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $car = false;
        }
        if ($car) {
            if($user->id == $car->user_id){
                return view('cars.car-details', compact('car', 'action'));
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
            $car = Car::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            $car = false;
        }
        if ($car) {
            if($user->id == $car->user_id){
                $car->update($data);
                return redirect('/cars')->with('msg', 'Dados do carro editados!');
            }else{
                return redirect('/cars')->with('msg', 'Não foi possível editar os dados!');
            }
        }else{
            return redirect('/dashboard');
        }
    }

    public function destroy($id){
        $user = auth()->user();
        try {
            $car = Car::findOrFail($id);
            try {
                $maintenances = Maintenance::where('car_id',$id);
            } catch (ModelNotFoundException $e) {
                $maintenances = false;
            }   
        } catch (ModelNotFoundException $e) {
            $car = false;
        }
        if($maintenances){
            $maintenances->delete();
        }
        if($car) {
            if($user->id == $car->user_id){
                $car->delete();
                return redirect('/cars')->with('msg', 'Carro excluído do seu cadastro!');
            }else{
                return redirect('/cars')->with('msg', 'Não foi possível excluir os dados!');
            }
        }else{
            return redirect('/dashboard');
        }
    }  

}