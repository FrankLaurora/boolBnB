@extends('layouts.app')

@section('content')
    
    <script>
        window.Laravel = {!!json_encode([
            'id' => $id
        ])!!}
    </script>
    
    <div id="chart">

    </div>
    <script src="{{asset('js/statistics.js')}}"></script>
@endsection