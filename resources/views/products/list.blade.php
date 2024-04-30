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
    <!-- Iterate on products -->
    @foreach ($groupedProducts as $groupedProduct)
        @foreach ($groupedProduct['products'] as $product)
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
            <td>{{ $product->capacity - $product->consumptions()->where('product_id', $product->id)->sum('quantity') }}</td> <!-- Quantity Container -->
            <td> <!-- Total quantity -->
            @php
                $totalQuantity = 0;
                foreach ($groupedProducts as $groupedProduct) {
                    foreach ($groupedProduct['products'] as $productItem) {
                        if ($productItem->cas_code === $product->cas_code && $productItem->concentration === $product->concentration) {
                            $totalQuantity += $productItem->capacity - $productItem->consumptions->sum('quantity');
                        }
                    }
                }
            @endphp
            {{ $totalQuantity }}
            </td>
            @if(auth()->user() && auth()->user()->isAdmin())
                <td>
                    <button onclick="toggleConsumptions('{{ $product->id }}')">
                        <span class="material-symbols-outlined">
                            expand_more
                        </span>
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
    @endforeach
</table>

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
