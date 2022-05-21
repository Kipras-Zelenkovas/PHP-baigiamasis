<?php

namespace App\Http\Controllers;

use App\Models\EventUsers as ModelsEventUsers;
use Illuminate\Http\Request;

class EventUsers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('registerEvent');
    }

    public function registerEvent(Request $request)
    {

        $validated = $request->validate([
            'post_id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'string',
        ]);

        $check = ModelsEventUsers::where('post_id', $validated['post_id'])
            ->where('email', $validated['email'])->first();

        if ($check === null) {
            ModelsEventUsers::create($validated);
            return redirect('/');
        }

        return redirect()->back();
    }

    public function accept($id, $condition)
    {
        $user = ModelsEventUsers::find($id);


        if ($condition) {
            #nusiusti laiska jog priimtas
        }

        #nusiusti laiska jog nepriimtas

        $user->delete();

        return $user;
    }
}
