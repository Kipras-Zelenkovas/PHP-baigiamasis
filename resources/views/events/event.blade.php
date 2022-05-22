@extends('layouts.app')

@section('content')
    <div>
        <div class="d-flex flex-warp card m-3 mx-auto text-center" style="width: fit-min; height: max-content;">
            <img src="{{ asset('storage'. $event->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$event->title}}</h5>
                <p class="card-text">Pradžia: {{$event->start_date}}</p>
                <p class="card-text">{{$event->description}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="/register/event" method="POST">
            @csrf
            <input type="hidden" id="event_id" name="event_id" value="{{$event->id}}">
            <div class="form-group">
                <label for="name">Vardas</label>
                <input name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">El.paštas</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="telephone">Telefonas</label>
                <input type="text" id="telephone" name="telephone" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Request</button>
            </div>
        </form>
    </div>

    @if ($show)
        <div>
            <div class="d-flex">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vardas</th>
                            <th scope="col">El.paštas</th>
                            <th scope="col">Telefonas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->eventUser as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->telephone}}</td>
                                <td><a href="/accept/event/{{$user->id}}/Priimtas" class="btn btn-primary">Patvirtinti</a></td>
                                <td><a href="/accept/event/{{$user->id}}/Nepriimtas" class="btn btn-danger">Atmesti</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-100 flex">
            <a href="/update/event/{{$event->id}}" class="btn btn-primary">Atnaujinti</a>
            <form action="/delete/event/{{$event->id}}" class="float-right" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger float-right">Ištrinti</button>
            </form>
        </div>
    @endif


    
@endsection