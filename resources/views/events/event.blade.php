@extends('layouts.app')

@section('content')
    <div>
        {{$event->description}}
    </div>

    <div class="container">
        <form action="/register/event" method="POST">
            @csrf
            <input type="hidden" id="post_id" name="post_id" value="{{$event->id}}">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" id="telephone" name="telephone" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Request</button>
            </div>
        </form>
    </div>

    <div>
        {{$event->eventUser}}
    </div>
@endsection