@extends('layouts.base')

@section('header')
    <div class="row">
        <h2 class="col-10 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productes') }}
        </h2>
        <div class="col-2">
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="/products/create" class="btn btn-primary">Afegir producte</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form id="filter-form">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cas_code" class="form-label">Codi CAS:</label>
                        <select name="cas_code" id="cas_code" class="form-select">
                            <option value="">-- Tots --</option>
                            @foreach($cascodes as $cascode)
                                <option value="{{ $cascode }}">{{ $cascode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="expiration_date" class="form-label">Data de Caducitat:</label>
                        <input type="date" name="expiration_date" id="expiration_date" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div id="product-list" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Product list contents -->
            @include('products.list')
        </div>
    </div>
</div>

@endsection