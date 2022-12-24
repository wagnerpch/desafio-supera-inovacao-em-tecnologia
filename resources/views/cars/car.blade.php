@extends('layouts.main')

@section('title','Carros')

@section('content')

<div class="row justify-content-center align-items-center my-4">
    <div class="col-auto">
        <h1 class="text-center">Carros</h1>
    </div>
    <div class="col-auto align-self-center">
        <a href="{{ route('cars.create') }}" class="btn btn-primary shadow px-5" alt="Adicionar novo carro">
            <ion-icon name="add-circle-outline"></ion-icon>
                Novo
        </a>
    </div>
</div>

@if(isset($cars) && count($cars) > 0)
    <div class="row justify-content-center align-items-center mx-2 g-0" id="header-table">
        <div class="col-1 col-md-1">
            <p class="text-center my-2">#</p>
        </div>
        <div class="col-3 col-md-2">
            <p class="my-2">Carro</p>
        </div>
        <div class="col-3 col-md-2">
            <p class="my-2">Placa</p>
        </div>
        <div class="col-4 col-md-2">
            <p class="text-center text-wrap my-2">Qtde de manutenções</p>
        </div>
        <div class="col-md-5 d-none d-md-block">
            <p class="text-center my-2">Ações</p>
        </div>
    </div>
    @foreach($cars as $car)
        <div class="row justify-content-center m-2 g-0 align-items-center shadow rounded">
            <div class="col-1 col-md-1">
                <p class="text-center my-2">{{ $loop->index + 1 }}</p>
            </div>
            <div class="col-3 col-md-2">
                <p class="text-start my-2">{{ $car['car_name'] }}</p>
            </div>
            <div class="col-3 col-md-2">
                <p class="text-start text-uppercase my-2">{{ $car['car_license'] }}</p>
            </div>
            <div class="col-4 col-md-2">
                <p class="text-center my-2">{{ $car['car_maintenance'] }}</p>
            </div>
            <div class="col-12 col-md-5">
                <div class="row justify-content-center m-2 text-center">
                    <div class="col-6 col-lg-5 mb-1">
                        <a class="btn btn-primary shadow w-100" href="{{ route('cars.show', $car['car_id']) }}">
                            <ion-icon name="search-outline"></ion-icon>
                                Consultar
                        </a>
                    </div>
                    <div class="col-6 col-lg-5 mb-1">
                        <form action="{{ route('cars.destroy', $car['car_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger shadow w-100">
                                <ion-icon name='trash-outline'></ion-icon>
                                    Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row justify-content-center m-2 g-0 align-items-center shadow rounded">
        <p class="text-center fs-5 m-4 p-4">Sem carros cadastrados, <a href="{{ route('cars.create') }}"> aproveite e crie um agora</a>.</p>
    </div>
@endif

@endsection