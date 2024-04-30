@extends('layouts.base')

@section('header')
    <div class="row">
        <h2 class="col-10 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar producte') }}
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

    <div class="col-12 mt-4 ">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{route('products.update', $product)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Codi CAS:</strong>

                                <select name="cas_code" class="form-select" id="cas_code">
                                    <option value="">-- Escull codi CAS --</option>
                                    @foreach($cascodes as $cascode)
                                        <option value="{{ $cascode }}">{{ $cascode }}</option>
                                    @endforeach
                                </select>

                                <input type="text" name="new_cas_code" class="form-control mt-2" placeholder="Introdueix un nou codi CAS">
                                @error('cas_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <!-- Mostrar campos adicionales si se introduce un nuevo cas_code -->
                                <div id="new_cascode_fields" style="display: none;">
                                    <strong>Nom:</strong>
                                    <input type="text" name="name" class="form-control mt-2" placeholder="Nom...">

                                    <strong>FDS:</strong>
                                    <input type="text" name="fds" class="form-control mt-2" placeholder="FDS...">

                                    <strong>Estat:</strong>
                                    <select name="status" class="form-select mt-2">
                                        <option value="S">S</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Concentració:</strong>
                                <input class="form-control" type="number" step="0.01" name="concentration" placeholder="Concentració...">
                                @error('concentration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Tipus de concentració:</strong>
                                <select name="concentration_type" class="form-select" id="">
                                    <option value="">-- Escull tipus--</option>
                                    <option value="%">%</option>
                                    <option value="mols">mols</option>
                                </select>
                                @error('concentration_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Capacitat:</strong>
                                <input class="form-control" type="number" step="0.01" name="capacity" placeholder="Capacitat...">
                                @error('capacity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Data de caducitat:</strong>
                                <input type="date" name="expiration_date" class="form-control" id="">
                                @error('expiration_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Armari:</strong>
                                <textarea class="form-control" style="height:150px" name="locker" placeholder="Armari..."></textarea>
                                @error('locker')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#cas_code, [name="new_cas_code"]').on('change keyup', function() {
                var casCodeValue = $('#cas_code').val();
                var newCasCodeValue = $('[name="new_cas_code"]').val();

                if (casCodeValue === '' && newCasCodeValue !== '') {
                    $('#new_cascode_fields').show();
                } else {
                    $('#new_cascode_fields').hide();
                }
            });
        });
    </script>
</div>
@endsection