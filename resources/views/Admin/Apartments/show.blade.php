@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 pt-4">
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
      <h2 class="pb-4">Il tuo appartamento</h2> 
      <h3>{{$apartment->title}}</h3>
      <img src="{{asset('storage/' . $apartment->cover)}}" class="img-fluid col-4 pt-4" alt="">
      <p class="pt-4">
            {{$apartment->description}}
      </p>
      <ul class="nav flex-column pb-4">
          <li class="nav-item"> <strong> Indirizzo: </strong> {{$apartment->address}} {{$apartment->number}} {{$apartment->city}}</li>
          <li class="nav-item"> <strong> Numero Stanze: </strong> {{$apartment->rooms}}</li>
          <li class="nav-item"> <strong> Numero Ospiti: </strong> {{$apartment->guests_number}}</li> 
          <li class="nav-item"> <strong> Mq: </strong> {{$apartment->sqm}}</li>
      </ul>
      <ul class="nav flex-column pb-4">
        <h3>Servizi disponibili</h3>
          @foreach ($apartment->services as $service)
            <li>{{$service->name}}</li>
          @endforeach
      </ul>
      <div class="mb-3">
        <h3>Immagini aggiuntive</h3>
        @if ($apartment->images != [])
            @foreach ($apartment->images as $image)
                <img width="100px" src="{{asset('./storage/' . $image->url)}}" alt="{{$apartment->title}}" class="mb-2 mt-2">                                              
            @endforeach
        @endif
        <div class="pt-4">
          <a href="{{route('admin.images.create', $apartment->id)}}">
            <button type="button" class="btn btn-info mb-4">
                Aggiungi altre immagini
            </button>
          </a>
        </div>
    </div>
      <h3 class="pb-2">Sponsorizza</h3>
      <div class="pb-5">
        @foreach ($sponsorships as $sponsorship)
          <a href="{{route('admin.sponsorships', ['apartment_id'=> $apartment->id, 'sponsorship_id' => $sponsorship->id])}}">
            <button type="button" class="btn btn-secondary">{{$sponsorship->title}}</button>
          </a>
        @endforeach
        {{-- <button type="button" class="btn btn-warning">Gold</button>
        <button type="button" class="btn btn-light">Platinum</button> --}}
      </div>
      <h3 class="pb-2">Messaggi ricevuti</h3>
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">Mittente</th>
            <th scope="col">Email</th>
            <th scope="col">Messaggio</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        @if (count($messages) > 0)
          <tbody>
            @foreach ($messages->reverse() as $message)    
            <tr>
              <td>{{$message->name}}</td>
              <td>{{$message->email}}</td>
              <td>{{$message->content}}</td>
              <td>{{$message->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
          @else
          <tbody>
            <tr>
              <td>Non hai ricevuto messaggi per questo appartamento.</td>
            </tr>
          </tbody>
        @endif
        
      </table>

      <div class="pt-4">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
            Elimina annuncio
        </button>
        <a class="btn btn-dark" href="{{route("admin.apartments.edit",$apartment['id'])}}">
          Modifica
        </a>
        <a href="{{route('admin.apartments.index')}}">
            <button type="button" class="btn btn-primary">
                Torna indietro
            </button>
        </a>
      </div>
       

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
                      Vuoi cancellare definitivamente questo annuncio?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Si</button>
                  </div>
              </div>
          </div>
      </form>
  </div>

<script src="{{asset('js/prova.js')}}"></script>
</div>
@endsection