@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card pl-4 pb-3  ms_bg_light ms_card">
                

                <div class="card-body  pt-4 ms_bg_light">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h2 class="ms_capitalize ms_dark">Benvenut*  {{ Auth::user()->first_name }} !</h2>
                   
                </div>
                <div class="card-body">
                    <a href="{{route("admin.apartments.index")}}" class="ms_a">Visualizza i tuoi appartamenti</a>
                </div>
                <div class="card-body">
                    <a href="{{ route("admin.users.edit") }}" class="ms_a">Modifica il tuo profilo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
