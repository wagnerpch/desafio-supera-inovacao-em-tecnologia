@extends('layouts.main')

@section('title','Carro')

@section('content')

@if(empty($car->id))
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-auto">
            <h1>Novo carro</h1>
        </div>
    </div>
    <form action="/cars" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car" class="fw-bold mt-2">Carro:</label>
                <input type="text" class="form-control shadow my-2" id="car" name="car" min="3" maxlength="150" placeholder="Digite o nome do carro" required>
                <label for="license" class="fw-bold mt-2">Placa:</label>
                <input type="text" class="form-control text-uppercase shadow my-2" id="license" name="license" min="8" maxlength="8" placeholder="AAA-9999 ou AA9-A999" required>
                <label for="brand" class="fw-bold mt-2">Marca:</label>
                <input type="text" class="form-control shadow my-2" id="brand" name="brand" min="3" maxlength="150" placeholder="Digite a marca do carro" required>
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="model" class="fw-bold mt-2">Modelo:</label>
                <select class="form-control shadow my-2" id="model" name="model" required>
                    <option value="hatchs" selected>Hatchs</option>
                    <option value="sedans">Sedans</option>
                    <option value="suvs">SUVs</option>
                    <option value="picapes">Picapes</option>
                    <option value="utilitarios">Utilitários</option>
                </select>
                <label for="version" class="fw-bold mt-2">Versão:</label>
                <input type="text" class="form-control shadow my-2" id="version" name="version" min="3" maxlength="150" placeholder="Digite a versão do carro" required>
            </div>
            <div class="col-12 col-md-6 form-group mt-2 text-center">
                <button type="submit" class="form-control btn btn-primary my-2 shadow w-50" id="salvar" name="salvar">
                    <ion-icon name="save-outline" class="me-2"></ion-icon>
                            Salvar novo carro
                </button>
            </div>
        </div>
    </form>
@elseif($action == 'show')
    <div class="row justify-content-center align-items-center my-4">
        <div class="col-auto">
            <h1>Cadastro do carro: 
                <span class="fw-bold text-danger">
                    {{ $car->car }}
                </span>
            </h1>
        </div>
    </div>
    <form action="/cars/edit/{{ $car->id }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car" class="fw-bold mt-2">Carro:</label>
                <input type="text" class="form-control shadow my-2" id="car" name="car" value="{{ $car->car }}" required readonly disabled>
                <label for="license" class="fw-bold mt-2">Placa:</label>
                <input type="text" class="form-control text-uppercase shadow my-2" id="license" name="license" value="{{ $car->license }}" required readonly disabled>
                <label for="brand" class="fw-bold mt-2">Marca:</label>
                <input type="text" class="form-control shadow my-2" id="brand" name="brand" value="{{ $car->brand }}" required readonly disabled>
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="model" class="fw-bold mt-2">Modelo:</label>
                <input type="text" class="form-control shadow my-2 text-capitalize" id="model" name="model" value="{{ $car->model }}" required readonly disabled>
                <label for="version" class="fw-bold mt-2">Versão:</label>
                <input type="text" class="form-control shadow my-2" id="version" name="version" value="{{ $car->version }}" required readonly disabled>
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
            <h1>Editar cadastro do carro: 
                <span class="fw-bold text-danger">
                    {{ $car->car }}
                </span>
            </h1>
        </div>
    </div>
    <form action="/cars/update/{{ $car->id }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        @method('PUT')
        <div class="row justify-content-center align-items-start my-4">
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="car" class="fw-bold mt-2">Carro:</label>
                <input type="text" class="form-control shadow my-2" id="car" name="car" min="3" maxlength="150" placeholder="Digite o nome do carro" value="{{ $car->car }}" required>
                <label for="license" class="fw-bold mt-2">Placa:</label>
                <input type="text" class="form-control text-uppercase shadow my-2" id="license" name="license" min="8" maxlength="8" placeholder="Formato AAA-9999 ou AA9-A999"  value="{{ $car->license }}" required>
                <label for="brand" class="fw-bold mt-2">Marca:</label>
                <input type="text" class="form-control shadow my-2" id="brand" name="brand" min="3" maxlength="150" placeholder="Digite a marca do carro"  value="{{ $car->brand }}" required>
            </div>
            <div class="col-12 col-md-5 form-group mt-2">
                <label for="model" class="fw-bold mt-2">Modelo:</label>
                <select class="form-control shadow my-2" id="model" name="model" required>
                    <option value="hatchs" {{ $car->model == 'hatchs' ? 'selected' : '' }}>Hatchs</option>
                    <option value="sedans" {{ $car->model == 'sedans' ? 'selected' : '' }}>Sedans</option>
                    <option value="suvs" {{ $car->model == 'suvs' ? 'selected' : '' }}>SUVs</option>
                    <option value="picapes" {{ $car->model == 'picapes' ? 'selected':'' }}>Picapes</option>
                    <option value="utilitarios" {{ $car->model == 'utilitarios' ? 'selected' : '' }}>Utilitários</option>
                </select>
                <label for="version" class="fw-bold mt-2">Versão:</label>
                <input type="text" class="form-control shadow my-2" id="version" name="version" min="3" maxlength="150" placeholder="Digite a versão do carro"  value="{{ $car->version }}" required>
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