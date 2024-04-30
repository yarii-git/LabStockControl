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
            <!-- Formulario de filtro -->
            <form action="{{ route('products.filter') }}" method="GET">
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
            <!-- Tabla de productos -->
            <table class="table table-bordered">
                <!-- Table headers -->
                <tr class="text-secondary">
                    <th>CAS</th>
                    <th>Stat</th>
                    <th>Nom</th>
                    <th>Con</th>
                    <th>Tipus</th>
                    <th>Caducitat</th>
                    <th>Capacitat</th>
                    <th>Armari</th>
                    <th>FDS</th>
                    <th>Q recipient</th>
                    <th>Q total</th>
                    <th>Consums</th>
                </tr>
                <!-- Iterate on filtered products -->
                @foreach ($filteredProducts as $product)
                    <tr>
                        <td class="fw-bold">{{ $product->cas_code }}</td>
                        <td>{{ $product->cascode->status }}</td>
                        <td>{{ $product->cascode->name }}</td>
                        <td>{{ $product->concentration }}</td>
                        <td>{{ $product->concentration_type }}</td>
                        <td>{{ $product->expiration_date }}</td>
                        <td>{{ $product->capacity }}</td>
                        <td>{{ $product->locker }}</td>
                        <td>
                            <a class="btn btn-link" href="{{ $product->cascode->fds }}" target="_blank">Enllaç</a>
                        </td>
                        <td>{{ $product->capacity - $product->consumptions()->where('product_id', $product->id)->sum('quantity') }}</td>
                        <!-- Quantity Container -->
                        <td> <!-- Total quantity -->
                            @php
                                $totalQuantity = 0;
                                foreach ($filteredProducts as $filteredProduct) {
                                    if ($filteredProduct->cas_code === $product->cas_code && $filteredProduct->concentration === $product->concentration) {
                                        $totalQuantity += $filteredProduct->capacity - $filteredProduct->consumptions->sum('quantity');
                                    }
                                }
                            @endphp
                            {{ $totalQuantity }}
                        </td>
                        @if(auth()->user() && auth()->user()->isAdmin())
                            <td>
                                <button class="btn btn-link" onclick="toggleConsumptions('{{ $product->id }}')">
                                    Veure consums
                                </button>
                                <div id="consumptions-{{ $product->id }}" class="hidden">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Usuari</th>
                                            <th>Data</th>
                                            <th>Quantitat</th>
                                            <th>Motiu</th>
                                        </tr>
                                        @foreach ($product->consumptions as $consumption)
                                            <tr>
                                                <td>{{ $consumption->user->name }}</td>
                                                <td>{{ $consumption->date_time }}</td>
                                                <td>{{ $consumption->quantity }}</td>
                                                <td>{{ $consumption->reason }}</td>
                                                <td>
                                                    <a href="/consumptions/create" class="btn btn-primary">Afegir consumició</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>

            <!-- Script para mostrar/ocultar consumos -->
            <script>
                function toggleConsumptions(productId) {
                    var consumptionsDiv = document.getElementById('consumptions-' + productId);
                    if (consumptionsDiv.classList.contains('hidden')) {
                        consumptionsDiv.classList.remove('hidden');
                    } else {
                        consumptionsDiv.classList.add('hidden');
                    }
                }
            </script>
        </div>
    </div>
</div>
@endsection
