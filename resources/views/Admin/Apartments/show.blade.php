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
       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
        Elimina annuncio
    </button>
    <a href="{{route('admin.images.create', $apartment->id)}}">
        <button type="button" class="btn btn-info">
            Aggiungi immagini
        </button>
    </a>

    <a href="{{route('admin.apartments.index')}}">
        <button type="button" class="btn btn-info">
            Torna indietro
        </button>
    </a>
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