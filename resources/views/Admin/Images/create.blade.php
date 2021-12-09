@extends('layouts.app')

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
    @endif
    <form action="{{route("admin.images.store", $apartment->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="url" class="form-label">Immagini appartamento</label>
            <input type="file" name="url" class="form-control @error('url') is-invalid @enderror" id="url" value="{{old('url')}}">
            @error('url')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Aggiorna</button>
        
        <a class="btn btn-info" href="{{route('admin.apartments.index')}}">
            Torna a tutti gli appartamenti
        </a>
    </form>
</div>
@endsection