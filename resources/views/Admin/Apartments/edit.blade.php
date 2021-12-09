@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-3 mb-3">
        <div class="col-8 offset-md-2">
            <div class="row">
                <div class="col-6">
                    <a href="{{route('admin.images.create', $apartment->id)}}">
                        <button type="button" class="btn btn-info">
                            Aggiungi immagini
                        </button>
                    </a>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                        Elimina annuncio
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-md-2">
            <form action="{{route("admin.apartments.update", $apartment->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                {{-- input per il titolo dell'appartamento --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{old('title') ?? $apartment->title}}" placeholder="Inserisci il titolo">
                    @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per il numero di stanze dell'appartamento --}}
                <div class="mb-3">
                    <label for="rooms" class="form-label">Stanze</label>
                    <input type="number" name="rooms" class="form-control @error('rooms') is-invalid @enderror" id="rooms" value="{{old('rooms') ?? $apartment->rooms}}" placeholder="Seleziona il numero di stanze">
                    @error('rooms')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per posti letto dell'appartamento --}}
                <div class="mb-3">
                    <label for="guests_number" class="form-label">Posti letto</label>
                    <input type="number" name="guests_number" class="form-control @error('guests_number') is-invalid @enderror" id="guests_number" value="{{old('guests_number') ?? $apartment->guests_number}}" placeholder="Posti letto">
                    @error('guests_number')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per il numero di bagni dell'appartamento --}}
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bagni</label>
                    <input type="number" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" value="{{old('bathrooms') ?? $apartment->bathrooms}}" placeholder="Bagni">
                    @error('bathrooms')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per l'estensione dell'appartamento --}}
                <div class="mb-3">
                    <label for="sqm" class="form-label">Metri quadrati</label>
                    <input type="number" name="sqm" class="form-control @error('sqm') is-invalid @enderror" id="sqm" value="{{old('sqm') ?? $apartment->sqm}}" placeholder="Seleziona l'estensione">
                    @error('sqm')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per la nazione dell'appartamento --}}
                <div class="mb-3">
                    <label for="region" class="form-label">Stato</label>
                    <input type="text" name="region" class="form-control @error('region') is-invalid @enderror" id="region" value="{{old('region') ?? $apartment->region}}" placeholder="Inserisci lo stato">
                    @error('region')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per l'indirizzo dell'appartamento --}}
                <div class="mb-3">
                    <label for="addressoptions" class="form-label">Indirizzo</label>
                    <input type="search" name="addressoptions" class="form-control @error('addressoptions') is-invalid @enderror" id="addressoptions" value="{{old('addressoptions')}}" placeholder="Inserisci l'indirizzo">
                    <select name="address" id="address">
                        <option>
                            {{old('address') ?? $apartment->address}}
                        </option>
                    </select>
                    @error('address')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                {{-- input per il numero civico dell'appartamento --}}
                <div class="mb-3">
                    <label for="number" class="form-label">Numero civico</label>
                    <input type="number" name="number" class="form-control @error('number') is-invalid @enderror" id="number" value="{{old('number') ?? $apartment->number}}" placeholder="Numero civico">
                    @error('number')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                
                {{-- Old Cover --}}
                @if ($apartment->cover)
                    <h6>Immagine di copertina</h6>
                    <img width="100px" src="{{asset('storage/' . $apartment->cover)}}" alt="{{$apartment->title}}">                                              
                @endif
    
                {{-- input per l'immagine di copertina dell'appartamento --}}
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" id="cover" value="{{old('cover') ?? $apartment->cover}}">
                    @error('cover')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
    
                {{-- input toogle per la visibilità --}}
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="visibility" name="visibility" {{old('visibility')? 'cheched' : ($apartment->visibility?'checked':'')}}/>
                        <label class="form-check-label" for="visibility">Visibility
                            {{-- {{old('visibility')? 'old cheched' : ($apartment->visibility?'db checked':'no')}} --}}
                        </label>
                    </div>
                </div>
                
    
                {{-- input per la descrizione dell'appartamento --}} 
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Inserisci una descrizione. ">{{old('description') ?? $apartment->description}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <p>Servizi</p>
                    @foreach ($services as $service)
                        <div class="custom-control custom-checkbox">
                            @if ($errors->any())
                            <input {{in_array($service['id'], old("services", [])) ? "checked" : null}} name="services[]" value="{{$service['id']}}" type="checkbox" class="custom-control-input" id="service-{{$service['id']}}">
                            @else
                            <input {{$apartment["services"]->contains($service["id"]) ? "checked" : null}} name="services[]" value="{{$service['id']}}" type="checkbox" class="custom-control-input" id="service-{{$service['id']}}">
                            @endif
                            <label class="custom-control-label" for="service-{{$service['id']}}">{{$service['name']}}</label>
                        </div>
                    @endforeach
                </div>
    
                <button type="submit" class="btn btn-dark">Pubblica</button>
            </form>
        </div>
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
    
    <script src="{{asset('js/prova.js')}}"></script>
@endsection

