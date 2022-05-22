@extends('layouts.app')

@section('content')

<div class="container">
    <form action="/add/event" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Pavadinimas</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Aprašymas</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Renginio pradžia</label>
            <input type="date" id="date" name="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Nuotrauka</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success mt-2" type="submit">Pridėti</button>
        </div>
    </form>
</div>

@endsection