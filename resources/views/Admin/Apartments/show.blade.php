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
       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
        Elimina annuncio
    </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal">
        <form action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Conferma Cancellazione Annuncio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Vuoi cancellare definitivamente il tuo profilo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Si</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/app.js')}}"></script>


</div>
@endsection