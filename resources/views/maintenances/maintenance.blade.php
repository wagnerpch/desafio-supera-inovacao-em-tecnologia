@extends('layouts.main')

@section('title','Manutenções programadas')

@section('content')

<div class="row justify-content-center align-items-center my-4">
    <div class="col-auto">
        <h1 class="text-center">Manutenções programadas</h1>
    </div>
    <div class="col-auto align-self-center">
        <a href="{{ route('maintenances.create') }}" class="btn btn-primary shadow px-5" alt="Adicionar novo carro">
            <ion-icon name="add-circle-outline"></ion-icon>
                Agendar
        </a>
    </div>
</div>
@if(isset($maintenances) && count($maintenances) > 0)
    <div class="row justify-content-center align-items-center mx-2 g-0" id="header-table">
        <div class="col-1 col-md-1">
            <p class="text-center my-2">#</p>
        </div>
        <div class="col-4 col-md-3">
            <p class="text-center text-wrap my-2">Manutenção</p>
        </div>
        <div class="col-2 col-md-1">
            <p class="text-center my-2">Carro</p>
        </div>
        <div class="col-2 col-md-2">
            <p class="text-center text-wrap my-2">Data</p>
        </div>
        <div class="col-3 col-md-1">
            <p class="text-center text-wrap my-2">Situação</p>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <p class="text-center my-2">Ações</p>
        </div>
    </div>
    @foreach($maintenances as $maintenance)
        <div class="row justify-content-center m-2 g-0 align-items-center shadow rounded">
            <div class="col-1 col-md-1">
                <p class="text-center my-2">{{ $loop->index + 1 }}</p>
            </div>
            <div class="col-4 col-md-3">
                <p class="text-start text-wrap text-break my-2">{{ $maintenance->maintenance }}</p>
            </div>
            @foreach($cars as $car)
                @if ($car->id == $maintenance->car_id)
                    <div class="col-2 col-md-1">
                        <p class="text-center text-wrap text-break my-2">{{ $car->car }}</p>
                    </div>
                @endif
            @endforeach
            <div class="col-2 col-md-2">
                <p class="text-center text-wrap text-break my-2">{{ $maintenance->date->format('d/m/y') }}</p>
            </div>
            <div class="col-3 col-md-1">
                <p class="text-center text-capitalize my-2">{{ $maintenance->progress }}</p>
            </div>
            <div class="col-12 col-md-4">
                <div class="row justify-content-center m-2 text-center">
                    <div class="col-6 col-lg-5 mb-1">
                        <a class="btn btn-primary shadow w-100" href="{{ route('maintenances.show', $maintenance->id) }}">
                            <ion-icon name='create-outline'></ion-icon>
                            Consultar
                        </a>
                    </div>
                    <div class="col-6 col-lg-5 mb-1">
                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST">
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
        <p class="text-center fs-5 m-4 p-4">Sem manutenções cadastradas. Se você já cadastrou um carro, <a href="{{ route('maintenances.create') }}"> então aproveite e crie uma manutenção agora</a>.</p>
    </div>
@endif

@endsection