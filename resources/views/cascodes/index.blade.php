<x-app-layout>
    <x-slot name="header">
        <div class="row-">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Codis CAS') }}
            </h2>
            <div class="">
                <a href="/cascodes/create" class="btn btn-primary rounded">Afegir codi CAS</a>
            </div>
        </div>
        
    </x-slot>
    
    @if (Session::get('success'))
        <div class="alert alert-success mt-2">
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-bordered w-full">
                        <tr class="text-secondary">
                            <th>Codi CAS</th>
                            <th>Nom</th>
                            <th>FDS</th>
                            <th>Stat</th>
                        </tr>
                        @foreach ( $cascodes as $cascode )
                            <tr>
                                <td class="fw-bold">{{$cascode->cas_code}}</td>
                                <td>
                                    {{$cascode->name}}
                                </td>
                                <td>
                                    {{$cascode->fds}}
                                </td>
                                <td>
                                    {{$cascode->status}}
                                </td>
                                <!-- <td>
                                    <a href="/cascodes/{{$cascode->cas_code_id}}/edit" class="btn btn-warning">Editar</a>
                                </td> -->
                            </tr>
                        @endforeach

                    </table>
                    {{$cascodes->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
