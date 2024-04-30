@extends('layouts.base')

@section('header')
    <div class="row">
        <h2 class="col-10 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Afegir consumició') }}
        </h2>
        <div class="col-2">
            <a href="{{route('products.index')}}" class="btn btn-primary">Torna enrere</a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    @if (Session::get('success'))
        <div class="alert alert-success mt-2">
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif

    <div class="col-12 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <form action="{{route('consumptions.store')}}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>ID d'usuari:</strong>
                                <select name="user_id" class="form-select" id="user_id">
                                    <option value="">-- Escull usuari --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user }}">{{ $user }}</option>
                                    @endforeach
                                </select>
                                @error('message'){{$message}} @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>ID del producte:</strong>
                                <select name="product_id" class="form-select" id="product_id">
                                    <option value="">-- Escull producte --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product }}">{{ $product }}</option>
                                    @endforeach
                                </select>
                                @error('message'){{$message}} @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Quantitat</strong>
                                <input class="form-control" type="number" step="0.01" name="quantity" placeholder="Quantitat...">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Motiu:</strong>
                                <select name="reason" class="form-select" id="">
                                    <option value="">-- Escull motiu --</option>
                                    <option value="consumption">Consumició</option>
                                    <option value="adjustment">Ajustament</option>
                                    <option value="Other">Altres</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
