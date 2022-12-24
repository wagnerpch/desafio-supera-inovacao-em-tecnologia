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
    <div class="row justify-content-center align-items-center mx-2 g-0 d-none d-md-flex" id="header-table">
        <div class="col-1 col-md-1">
            <p class="text-center my-2">#</p>
        </div>
        <div class="col-4 col-md-2">
            <p class="text-center text-wrap my-2">Manutenção</p>
        </div>
        <div class="col-2 col-md-2">
            <p class="text-center my-2">Carro</p>
        </div>
        <div class="col-2 col-md-2">
            <p class="text-center text-wrap my-2">Data</p>
        </div>
        <div class="col-3 col-md-2">
            <p class="text-center text-wrap my-2">Situação</p>
        </div>
        <div class="col-md-3 d-none d-md-block">
            <p class="text-center my-2">Ações</p>
        </div>
    </div>
    @foreach($maintenances as $maintenance)
        <div class="row justify-content-center m-2 p-3 g-0 align-items-center shadow rounded rows-items">
            <div class="col-12 col-md-1 d-none d-md-flex">
                <p class="text-center my-2">{{ $loop->index + 1 }}</p>
            </div>
            <div class="col-12 col-md-2">
                <span class="d-sm-none"><strong>Manutenção: </strong></span>
                <p class="text-sm-center text-md-start text-wrap text-break my-2">{{ $maintenance->maintenance }}</p>
            </div>
            @foreach($cars as $car)
                @if ($car->id == $maintenance->car_id)
                    <div class="col-12 col-md-2">
                        <span class="d-sm-none"><strong>Carro: </strong></span>
                        <p class="text-sm-center text-md-center text-wrap text-break my-2">{{ $car->car }}</p>
                    </div>
                @endif
            @endforeach
            <div class="col-12 col-md-2">
                <span class="d-sm-none"><strong>Data: </strong></span>
                <p class="text-sm-center text-md-center text-wrap text-break my-2">{{ $maintenance->date->format('d/m/y') }}</p>
            </div>
            <div class="col-12 col-md-2">
                <span class="d-sm-none"><strong>Ações: </strong></span>
                <p class="text-sm-center text-md-start text-capitalize my-2">{{ $maintenance->progress }}</p>
            </div>
            <div class="col-12 col-md-3">
                <div class="row justify-content-center my-2 text-center">
                    <div class="col-6 col-lg-5 mb-1 p-lg-1">
                        <a class="btn btn-primary shadow w-100 p-md-2" href="{{ route('maintenances.show', $maintenance->id) }}">
                            <ion-icon name='create-outline'></ion-icon>
                            <small>Consultar</small>
                        </a>
                    </div>
                    <div class="col-6 col-lg-5 mb-1 p-lg-1">
                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger shadow w-100 p-md-2">
                                <ion-icon name='trash-outline'></ion-icon>
                                <small>Deletar</small>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row justify-content-center g-0 align-items-centerh-50 p-3 p-md-5">
        <div class="col-10 col-md-6 col-lg-5 m-2 m-md-5 p-md-1">
            <p class="text-center fs-5 m-4 m-md-5 p-md-5 shadow rounded rows-msg">Sem manutenções cadastradas.</p>
            <p class="text-center fs-5 m-4 m-md-5 p-md-5 shadow rounded rows-msg"> Se você já cadastrou um carro, 
                <a href="{{ route('maintenances.create') }}"> então aproveite e crie uma manutenção agora</a>.
            </p>
        </div>
    </div>
@endif

@endsection