<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar codi CAS') }}
        </h2>
        <div>
            <a href="{{route('cascodes.index')}}" class="btn btn-primary">Torna enrere</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{route('cascodes.update')}}" method="PUT">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Codi CAS:</strong>
                                <textarea class="form-control" style="height:150px" name="cas_code" placeholder="Codi cas..."></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Nom:</strong>
                                <textarea class="form-control" style="height:150px" name="name" placeholder="Nom..."></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>FDS:</strong>
                                <textarea class="form-control" style="height:150px" name="fds" placeholder="FDS..."></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Stat:</strong>
                                <select name="status" class="form-select" id="">
                                    <option value="">-- Escull stat--</option>
                                    <option value="S">S</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
