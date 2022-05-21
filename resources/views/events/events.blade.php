@extends('layouts.app')

@section('content')
    <div>
        @foreach ($events as $item)
            <div>{{$item}}</div>
        @endforeach
    </div>
@endsection