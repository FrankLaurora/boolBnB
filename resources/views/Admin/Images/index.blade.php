@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route("admin.images.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="url" class="form-label">Immagini appartamento</label>
            <input type="file" name="url" class="form-control @error('url') is-invalid @enderror" id="url" value="{{old('url')}}">
            @error('url')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark">Aggiorna</button>
    </form>
</div>
@endsection