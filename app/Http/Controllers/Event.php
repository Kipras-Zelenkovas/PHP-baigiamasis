<?php

namespace App\Http\Controllers;

use App\Models\Event as EventModel;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('showEvent', 'showEvents');
    }

    public function addEvent(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'start_date' => 'required|date',
        ]);

        $path = $request->file('image')->store('public/images');
        $fileName = str_replace('public', '', $path);
        $validated = array_merge($validated, ['image' => $fileName, 'user_id' => Auth::id()]);

        EventModel::create($validated);

        return redirect('/');
    }

    public function deleteEvent($id, EventModel $event)
    {
        if (!Gate::allows('modify-event', $event)) {
            return abort(403);
        }

        $event = EventModel::find($id);

        $event->delete();

        return redirect()->back();
    }

    public function updateEvent(Request $request, $id, EventModel $event)
    {
        if (!Gate::allows('modify-event', $event)) {
            return abort(403);
        }

        $event = EventModel::find($id);

        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'start_date' => 'required|date',
        ]);

        if ($request->image) {
            $path = $request->file('image')->store('public/images');
            $fileName = str_replace('public', '', $path);
            $validated = array_merge($validated, ['image' => $fileName]);

            Storage::delete($event->image);
        }

        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->start_date = $validated['start_date'];
        $event->image = $validated['image'];

        $event->save();

        return redirect()->back();
    }

    public function showAddEvents()
    {
        return view('events.addEvent');
    }

    public function showEvents()
    {
        $events = EventModel::all();

        return view('events.events', compact('events'));
    }

    public function showEvent(Request $request, $id)
    {
        $event = EventModel::find($id);

        return view('events.event', ['event' => $event]);
    }
}
