<?php

namespace App\Http\Controllers;

use App\Models\Event as EventModel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Event extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('showEvent', 'showEvents');
    }

    public function addEvent(Request $request)
    {

        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'start_date' => 'date',
        ]);

        if ($request->image) {
            $path = $request->file('image')->store('public/images');
            $fileName = str_replace('public', '', $path);
            $validated = array_merge($validated, ['image' => $fileName]);
        }

        $validated = array_merge($validated, ['user_id' => Auth::id()]);

        EventModel::create($validated);

        return redirect('/');
    }

    public function deleteEvent($id)
    {
        $event = EventModel::find($id);

        if (!Gate::allows('modify', $event)) {
            abort(403);
        }

        File::delete(storage_path('app/public' . $event->image));

        $event->eventUser()->each(function ($user) {
            $user->delete();
        });

        $event->delete();

        return redirect('/');
    }

    public function updateEvent(Request $request, $id)
    {

        $event = EventModel::find($id);

        if (!Gate::allows('modify', $event)) {
            return abort(403);
        }

        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'start_date' => 'date',
        ]);

        if ($request->image) {
            File::delete(storage_path('app/public' . $event->image));

            $path = $request->file('image')->store('public/images');
            $fileName = str_replace('public', '', $path);
            $validated = array_merge($validated, ['image' => $fileName]);
            $event->image = $validated['image'];
        }

        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->start_date = $validated['start_date'];

        $event->save();

        return redirect('/');
    }

    public function showAddEvents()
    {
        return view('events.addEvent');
    }

    public function showUpdateEvent($id)
    {
        $event = EventModel::find($id);

        return view('events.updateEvent', ['event' => $event]);
    }

    public function showEvents()
    {
        $events = EventModel::all();

        return view('events.events', compact('events'));
    }

    public function showEvent($id)
    {
        $event = EventModel::find($id);
        $show = Gate::allows('modify', $event) ? true : false;

        return view('events.event', ['event' => $event, 'show' => $show]);
    }
}
