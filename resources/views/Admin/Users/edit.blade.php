<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>New Apartment</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <form action="{{route("admin.users.update", $user->id)}}" method="POST">
            @method('PUT')
            @csrf
            {{-- input per modificare il nome --}}
            <div class="mb-3">
                <label for="first_name" class="form-label">Nome</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{old('first_name') ?? $user->first_name}}" placeholder="Inserisci il tuo nome">
                @error('first_name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- input per modificare il cognome --}}
            <div class="mb-3">
                <label for="last_name" class="form-label">Cognome</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{old('last_name') ?? $user->last_name}}" placeholder="Inserisci il tuo cognome">
                @error('last_name')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- input per modificare il email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email') ?? $user->email}}" disabled>
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Data di nascita</label>
                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" value="{{old('date_of_birth') ?? $user->date_of_birth}}" disabled>
                @error('date_of_birth')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

           
            <button type="submit" class="btn btn-dark">Pubblica</button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                Elimina profilo
            </button>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal">
            <form action="{{route('admin.users.destroy', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Conferma Cancellazione Utente</h5>
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
    </body>
</html>
