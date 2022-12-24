@extends('layouts.main')

@section('title','Manutenção')

@section('content')

@if(empty($maintenance->id))
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-auto">
            <h1>Nova manutenção</h1>
        </div>
    </div>
    <form action="/maintenances" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car_id" class="fw-bold mt-2">Carro:</label>
                <select class="form-control shadow my-2" id="car_id" name="car_id" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->car }} - {{$car->license}}</option>
                    @endforeach
                </select>
                <label for="maintenance" class="fw-bold mt-2">Manutenção:</label>
                <input type="text" class="form-control shadow my-2" id="maintenance" name="maintenance" min="3" maxlength="150" placeholder="Digite o nome da manutenação" required>                    
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="date" class="fw-bold mt-2">Data:</label>
                <input type="date" class="form-control shadow my-2" id="date" name="date" value="{{ today()->format('Y-m-d') }}">
                <label for="progress" class="fw-bold mt-2">Progresso:</label>
                <select class="form-control shadow my-2" id="progress" name="progress" required>
                    <option value="em andamento" selected>Em andamento</option>
                    <option value="pendente">Pendente</option>
                    <option value="realizada">Realizada</option>
                </select>
            </div>
            <div class="col-12 col-md-6 form-group mt-2 text-center">
                <button type="submit" class="form-control btn btn-primary my-2 shadow w-50" id="salvar" name="salvar">
                    <ion-icon name="save-outline" class="me-2"></ion-icon>
                            Salvar
                </button>
            </div>
        </div>
    </form>
@elseif($action == 'show')
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-auto">
            <h1>Manutenção programada do carro: 
                <span class="fw-bold text-danger">
                    {{ $car }}
                </span>
            </h1>
        </div>
    </div>
    <form action="/maintenances/edit/{{ $maintenance->id }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car_id" class="fw-bold mt-2">Carro:</label>
                <input type="text" class="form-control shadow my-2" id="car_id" name="car_id" min="3" maxlength="150" placeholder="Digite o nome da manutenação" value="{{ $car }}" required readonly disabled>
                <label for="maintenance" class="fw-bold mt-2">Manutenção:</label>
                <input type="text" class="form-control shadow my-2" id="maintenance" name="maintenance" min="3" maxlength="150" placeholder="Digite o nome da manutenação" value="{{ $maintenance->maintenance }}" required readonly disabled>                    
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="date" class="fw-bold mt-2">Data:</label>
                <input type="text" class="form-control shadow my-2" id="date" name="date" value="{{ $maintenance->date->format('d/m/Y') }}" required readonly disabled>
                <label for="progress" class="fw-bold mt-2">Progresso:</label>
                <input type="text" class="form-control text-capitalize shadow my-2" id="progress" name="progress" min="3" maxlength="150" placeholder="Digite o nome da manutenação" value="{{ $maintenance->progress }}" required readonly disabled>   
            </div>
            <div class="col-12 col-md-6 form-group mt-2 text-center">
                <button type="submit" class="form-control btn btn-primary my-2 shadow w-50" id="editar" name="editar">
                    <ion-icon name="create-outline"></ion-icon>
                            Editar
                </button>
            </div>
        </div>
    </form>
@elseif($action == 'edit')
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-auto">
            <h1>Editar manutenção do carro: 
                <span class="fw-bold text-danger">
                    {{ $carName }}
                </span>
            </h1>
        </div>
    </div>
    <form action="/maintenances/update/{{ $maintenance->id }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        @method('PUT')
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car_id" class="fw-bold mt-2">Carro:</label>
                <select class="form-control shadow my-2" id="car_id" name="car_id" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ $car->id == $maintenance->car_id ? 'selected' : ''}}>{{ $car->car }}</option>
                    @endforeach
                </select>
                <label for="maintenance" class="fw-bold mt-2">Manutenção:</label>
                <input type="text" class="form-control shadow my-2" id="maintenance" name="maintenance" min="3" maxlength="150" placeholder="Digite o nome da manutenação" value="{{ $maintenance->maintenance }}" required>                    
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="date" class="fw-bold mt-2">Data:</label>
                <input type="date" class="form-control shadow my-2" id="date" name="date" value="{{ $maintenance->date->format('Y-m-d') }}">
                <label for="progress" class="fw-bold mt-2">Progresso:</label>
                <select class="form-control shadow my-2" id="progress" name="progress" required>
                    <option value="em andamento" {{ $maintenance->progress == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="pendente" {{ $maintenance->progress == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="realizada" {{ $maintenance->progress == 'realizada' ? 'selected' : '' }}>Realizada</option>
                </select>
            </div>
            <div class="col-12 col-md-6 form-group mt-2 text-center">
                <button type="submit" class="form-control btn btn-warning my-2 shadow w-50">
                    <ion-icon name="save-outline" class="me-2"></ion-icon>
                            Salvar
                </button>
            </div>
        </div>
    </form>
@endif

@endsection