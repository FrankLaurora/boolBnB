@extends('layouts.app')

@section('content')

<div class="container">
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

            {{-- input per la città dell'appartamento --}}
            <div class="mb-3">
                <label for="city" class="form-label">Città</label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" value="{{old('city') ?? $apartment->city}}" placeholder="Inserisci la città">
                @error('city')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per l'indirizzo dell'appartamento --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{old('address') ?? $apartment->address}}" placeholder="Inserisci l'indirizzo">
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

            {{-- input per la descrizione dell'appartamento --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Inserisci una descrizione. ">{{old('description') ?? $apartment->description}}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                    <option value="">--seleziona una categoria--</option>
                    @foreach ($categories as $category)
                       <option {{ old("category_id") == $category['id'] ? 'selected' : null}} value="{{$category['id']}}">{{$category['name']}}</option> 
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div> --}}
            <button type="submit" class="btn btn-dark">Pubblica</button>
        </form>
</div>
@endsection