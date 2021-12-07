@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table">
        <h1>Your apartments</h1>
        <a href="{{route("admin.apartments.create")}}">
            <button type="button" class="btn btn-success">Crea annuncio</button>
        </a>
    </table> 
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
    @endif   
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Address</th>
                    <th scope="col">Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{$apartment->id}}</td>
                        <td>{{$apartment->title}}</td>
                        <td>{{$apartment->address}}</td>
                        <td>{{$apartment->number}}</td>
                        <td>
                            <a href="{{route("admin.apartments.show",$apartment['id'])}}">
                                <button type="button" class="btn btn-dark">Visualizza</button>
                            </a>
                            <a href="{{route("admin.apartments.edit",$apartment['id'])}}">
                                <button type="button" class="btn btn-success">Modifica</button>
                            </a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
@endsection