@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h2>Benvenut*  {{ Auth::user()->first_name }} !</h2>
                   
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
