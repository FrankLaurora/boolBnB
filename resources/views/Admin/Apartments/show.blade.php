@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12">
        
       <h3>{{$apartment->title}}</h3>
       <img src="{{asset('storage/' . $apartment->cover)}}" class="img-fluid col-4" alt="">
       <p>
            {{$apartment->description}}
       </p>
       <ul>
           <li>Indirizzo:{{$apartment->address}} {{$apartment->number}} {{$apartment->city}}</li>
           <li>Numero Stanze: {{$apartment->rooms}}</li>
           <li>Numero Ospiti: {{$apartment->guests_number}}</li> 
           <li>Superficie: {{$apartment->sql}}</li>
           
       </ul>
       <div>Sponsorizza</div>
       <div>
           <button type="button" class="btn btn-secondary">Silver</button>
           <button type="button" class="btn btn-warning">Gold</button>
           <button type="button" class="btn btn-light">Platinum</button>
        </div>
       <div>Messaggi ricevuti</div>
       <table class="table">
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
       
    
    <a class="btn btn-info" href="{{route('admin.apartments.index')}}">
        Torna a tutti gli appartamenti
    </a>
    
    </div>
    
    <script src="{{asset('js/app.js')}}"></script>


</div>
@endsection