@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 pt-4">
       <h2 class="pb-4">Il tuo appartamento</h2> 
       <h3>{{$apartment->title}}</h3>
       <img src="{{asset('storage/' . $apartment->cover)}}" class="img-fluid col-4" alt="">
       <p>
            {{$apartment->description}}
       </p>
       <ul class="nav flex-column pb-4">
           <li class="nav-item"> <strong>Indirizzo:</strong>  {{$apartment->address}} {{$apartment->number}} {{$apartment->city}}</li>
           <li class="nav-item"> <strong> Numero Stanze:</strong> {{$apartment->rooms}}</li>
           <li class="nav-item"> <strong> Numero Ospiti:</strong> {{$apartment->guests_number}}</li> 
           <li class="nav-item"> <strong>Mq:</strong>  {{$apartment->sql}}</li>
           
       </ul>
       <div class="pb-2">Sponsorizza</div>
       <div class="pb-5">
           <button type="button" class="btn btn-secondary">Silver</button>
           <button type="button" class="btn btn-warning">Gold</button>
           <button type="button" class="btn btn-light">Platinum</button>
        </div>
       <div class="pb-2">Messaggi ricevuti</div>
       <table class="table ">
        <thead>
          <tr>
            <th scope="col">Mittente</th>
            <th scope="col">Messaggio</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Franco</td>
            <td>Ciao!Bello l'appartamento, è disponibile il bla bla bla?</td>
            <td>07/12/2021</td>
          </tr>
        </tbody>
      </table>

      <div class="pt-4">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
            Elimina annuncio
        </button>
    
        <a href="{{route('admin.apartments.index')}}">
            <button type="button" class="btn btn-success">
                Torna indietro
            </button>
        </a>
      </div>
       

    </div>
    
    <script src="{{asset('js/app.js')}}"></script>


</div>
@endsection