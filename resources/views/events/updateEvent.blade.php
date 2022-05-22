@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/update/event/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{$event->title}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Starting date</label>
            <input type="date" id="date" value="{{$event->start_date}}" name="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Title</label>
            <img src="{{asset('storage'. $event->image)}}" alt="...">
            <input type="file" id="image" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Atnaujinti</button>
        </div>
    </form>
</div>

@endsection