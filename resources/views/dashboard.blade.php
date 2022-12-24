@extends('layouts.main')

@section('title','Manutenção de carros')

@section('content')

<div class="row justify-content-center align-items-center my-4">
    <div class="col-auto">
        <h1>Dashboard</h1>
    </div>
</div>
<div class="row justify-content-center align-items-center my-4">
    <div class="col-6 col-sm-5 col-md-3">
        <div class="card border-secundary mb-3">
            <div class="card-body">
                <p class="card-title text-center fs-3 fw-bold">{{isset($maintenance)?count($maintenance):'0'}}</p>
                <p class="card-text text-center">manutenções</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-5 col-md-3">
        <div class="card border-secundary mb-3">
            <div class="card-body">
                <p class="card-title text-center fs-3 fw-bold">{{isset($progress_toDo)?count($progress_toDo):'0'}}</p>
                <p class="card-text text-center">pendentes</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-5 col-md-3">
        <div class="card border-secundary mb-3">
            <div class="card-body">
                <p class="card-title text-center fs-3 fw-bold">{{isset($progress_doing)?count($progress_doing):'0'}}</p>
                <p class="card-text text-center">em andamento</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-5 col-md-3">
        <div class="card border-secundary mb-3">
            <div class="card-body">
                <p class="card-title text-center fs-3 fw-bold">{{isset($progress_done)?count($progress_done):'0'}}</p>
                <p class="card-text text-center">realizadas</p>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="accordion" id="accordionDashboard">
        @for($i = 0; $i < count($cars); $i++)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{$i}}">
                    <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="{{ ($i == 0) ? 'true' : 'false' }}" aria-controls="collapse{{$i}}">
                        <p class="m-0">Manutenções programada para 
                            <strong>
                                {{ $cars[$i][0] }}
                            </strong>
                        </p>
                    </button>
                </h2>
                <div id="collapse{{$i}}" class="accordion-collapse collapse {{ ($i == 0) ? 'show' : '' }}" aria-labelledby="heading{{$i}}" data-bs-parent="#accordionDashboard">
                    @if(count($cars[$i])>1)
                        <div class="accordion-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                                @for($o = 1; $o < count($cars[$i]); $o++)
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header text-center">
                                            <h4 class="card-title my-2">{{ $cars[$i][$o]->maintenance }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center fw-bold mb-3">{{ $cars[$i][$o]->car }}</h5>
                                            <p class="card-text text-uppercase">Placa: {{ $cars[$i][$o]->license }}</p>
                                            <p class="card-text">Marca: {{ $cars[$i][$o]->brand }}</p>
                                            <p class="card-text text-capitalize">Modelo: {{ $cars[$i][$o]->model }}</p>
                                            <p class="card-text">Versao: {{ $cars[$i][$o]->version }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <p class="card-text text-center">Situacao: {{ $cars[$i][$o]->progress }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    @else
                        <div class="accordion-body col-auto">
                            <h5 class="card-text text-center my-4">Sem manutenções programadas para esta data.</h5>
                        </div>
                    @endif
                </div>
            </div>
        @endfor
    </div>
</div>

@endsection