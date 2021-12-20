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
            <label for="url" class="form-label">Inserisci un'immagine nella Galleria Immagini</label>
            <input type="file" name="url" class="form-control ms_pb_4 @error('url') is-invalid @enderror" id="url" value="{{old('url')}}">
            @error('url')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            
        </div>
            
       

        <button type="submit" class="btn btn-dark">Aggiungi altre foto</button>
        
        <a href="{{route('admin.apartments.edit', $apartment->id)}}">
            <button type="button" class="btn btn-info">
                Torna indietro
            </button>
        </a>
    </form>

    <p class="my-2">Galleria Immagini</p>
    <div class="container-gallery">
            
          
        @if ($apartment->images != [])
            @foreach ($apartment->images as $image)
                
                    <div class="image-of-gallery">
                        <img width="100px" src="{{asset('./storage/' . $image->url)}}" alt="{{$apartment->title}}" class="mb-2 mt-2">
                        <form action="{{route('admin.images.destroy', $image->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancella</button>
                        </form>  
                    </div>                 
                          
            @endforeach
        @endif
    </div>

</div>

{{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
    Elimina annuncio
</button>

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
</div> --}}
@endsection