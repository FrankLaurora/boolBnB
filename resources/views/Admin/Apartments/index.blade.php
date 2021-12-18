@extends('layouts.app')

@section('content')

<div class="container col-10">
    <table class="table">
        <h1 class="mb-4">I Tuoi Appartamenti</h1>
        <a href="{{route("admin.apartments.create")}}">
            <button type="button" class="btn ms-button mt-2 mb-3">Aggiungi un nuovo appartamento</button>
        </a>
    </table> 
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
    @endif   
        <table class="table apartment_index ms_capitalize">
            <thead >
                <tr >
                    <th scope="col">Annuncio</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">N° civico</th>
                    <th scope="col">Cosa vuoi fare?</th>
                    <th>Visibilità</th>
                </tr>
            </thead>
            <tbody class="mt-3 ">
                @foreach ($apartments as $apartment)
                    <tr class="ms_fontweight">
                        <td>{{$apartment->id}}</td>
                        <td>{{$apartment->title}}</td>
                        <td class="capitalize">{{$apartment->address}}</td>
                        <td>{{$apartment->number}}</td>
                        <td>
                            <a href="{{route("admin.apartments.update", $apartment['id'])}}">
                                <button type="button" class="btn ms-btn_white">Visualizza</button>
                            </a>
                            <a href="{{route("admin.apartments.edit",$apartment['id'])}}">
                                <button type="button" class="btn ms-btn_light">Modifica</button>
                            </a>
                        </td>
                        <td>
                            <form action="{{route("admin.apartments.update", $apartment->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="visibility" name="visibility" {{old('visibility') ? 'checked' : ($apartment->visibility ? 'checked':'')}} disabled/>
                                    <label class="custom-control-label" for="visibility"></label>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
@endsection