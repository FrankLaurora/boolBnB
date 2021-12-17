@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card pl-4 pb-3">
                

                <div class="card-body  pt-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h2 class="capitalize">Benvenut*  {{ Auth::user()->first_name }} !</h2>
                   
                </div>
                <div class="card-body">
                    <a href="{{route("admin.apartments.index")}}">Visualizza i tuoi appartamenti</a>
                </div>
                <div class="card-body">
                    <a href="{{ route("admin.users.edit") }}">Modifica il tuo profilo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
