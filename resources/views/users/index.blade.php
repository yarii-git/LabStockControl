@extends('layouts.base')

@section('header')
    <div class="row">
        <h2 class="col-10 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuaris') }}
        </h2>
        <div class="col-2">
            <a href="/users/create" class="btn btn-primary">Nou usuari</a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table table-bordered w-full">
                <tr class="text-secondary">
                    <th>Nom</th>
                    <th>Rol</th>
                    <th>Email</th>
                </tr>
                @foreach ( $users as $user )
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            <a href="/users/{{$user->id}}/edit" class="btn btn-warning">Editar</a>

                            <form action="{{route('users.destroy', $user)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Realment vols eliminar l\'usuari?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection