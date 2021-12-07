@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12">
        
       <h3>{{$apartment->title}}</h3>
       <img src="{{asset('storage/app/public/apartments_cover/' . $apartment->cover)}}" alt="">
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
       <div>Messaggi ricevuti</div>
       
    </div>


</div>
@endsection