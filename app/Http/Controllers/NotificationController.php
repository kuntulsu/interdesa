<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Gate;

class NotificationController extends Controller
{
    public function settings()
    {
        $team = Jetstream::newTeamModel()->findOrFail(auth()->user()->currentTeam->id);

        if (Gate::denies('view', $team)) {
            abort(403);
        }

        return view("notification.settings");
    }
}
