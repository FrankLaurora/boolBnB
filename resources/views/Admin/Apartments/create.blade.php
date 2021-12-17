@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
        <form action="{{route("admin.apartments.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- input per il titolo dell'appartamento --}}
            <div class="mb-3">
                <label for="title" class="form-label"><h5> Titolo</h5></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{old('title')}}" placeholder="Inserisci il titolo">
                @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per il numero di stanze dell'appartamento --}}
            <div class="mb-3">
                <label for="rooms" class="form-label"><h5> Stanze</h5></label>
                <input type="number" name="rooms" class="form-control @error('rooms') is-invalid @enderror" id="rooms" value="{{old('rooms')}}" placeholder="Seleziona il numero di stanze">
                @error('rooms')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per posti letto dell'appartamento --}}
            <div class="mb-3">
                <label for="guests_number" class="form-label"><h5>Posti letto</h5> </label>
                <input type="number" name="guests_number" class="form-control @error('guests_number') is-invalid @enderror" id="guests_number" value="{{old('guests_number')}}" placeholder="Posti letto">
                @error('guests_number')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per il numero di bagni dell'appartamento --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label"><h5>Bagni</h5></label>
                <input type="number" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" value="{{old('bathrooms')}}" placeholder="Bagni">
                @error('bathrooms')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per l'estensione dell'appartamento --}}
            <div class="mb-3">
                <label for="sqm" class="form-label"><h5> Metri quadrati</h5></label>
                <input type="number" name="sqm" class="form-control @error('sqm') is-invalid @enderror" id="sqm" value="{{old('sqm')}}" placeholder="Seleziona l'estensione">
                @error('sqm')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per l'indirizzo dell'appartamento --}}
            <div class="mb-3">
                <label for="addressoptions" class="form-label"><h5> Indirizzo</h5></label>
                <input type="text" name="addressoptions" class="form-control @error('addressoptions') is-invalid @enderror" id="addressoptions" value="{{old('addressoptions')}}" placeholder="Es: Milano, corso como 10">
                <select name="address" id="address">
                    <option>{{old('address')?old('address'):''}}</option>
                </select>
                @error('address')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            
            {{-- input per l'immagine di copertina dell'appartamento --}}
            <div class="mb-3">
                <label for="cover" class="form-label"><h5> Immagine di copertina</h5></label>
                <input type="file" name="cover" class="form-control ms_pb_4 @error('cover') is-invalid @enderror" id="cover" value="{{old('cover')}}" placeholder="Scegli un'immagine di copertina">
                @error('cover')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- input file da bootstrap --}}
            {{-- <div class="custom-file">
                <label class="custom-file-label" for="cover">Choose file</label>
                <input type="file" name="cover" class="custom-file-input @error('cover') is-invalid @enderror"  id="cover " value="{{old('cover')}}" placeholder="Scegli un'immagine di copertina">
                @error('cover')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> --}}

            {{-- input per la descrizione dell'appartamento --}}
            <div class="mb-3">
                <label for="description" class="form-label"><h5> Descrizione</h5></label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Inserisci una descrizione. "></textarea>
                @error('description')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <p><h5>Servizi</h5> </p>
                    
                @foreach ($services as $service)
                    <div class="custom-control custom-checkbox">
                        <input {{in_array($service['id'], old("services", [])) ? "checked" : null}} name="services[]" value="{{$service['id']}}" type="checkbox" class="custom-control-input" id="service-{{$service['id']}}">
                        <label class="custom-control-label" for="service-{{$service['id']}}">{{$service['name']}}</label>               
                    </div>
                @endforeach
                <div class="pt-4">
                    <button type="submit" class="btn btn-warning mr-2">Crea appartamento</button>
                    <a class="btn btn-primary" href="{{route('admin.apartments.index')}}">Annulla</a>
                </div>
        </form>
    </div>

    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
    <script src="{{asset('js/prova.js')}}"></script>
</div>
@endsection

