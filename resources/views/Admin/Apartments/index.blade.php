<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Your Apartments</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <h1>Your apartments</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Address</th>
                    <th scope="col">Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{$apartment->id}}</td>
                        <td>{{$apartment->title}}</td>
                        <td>{{$apartment->address}}</td>
                        <td>{{$apartment->number}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </body>
</html>