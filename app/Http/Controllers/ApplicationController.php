<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        if ($this->checkDate()) {
            return back()->with('error', 'You can create only application 1 a day...😎');
        }

        if ($request->hasFile('avatar')) {
            $name = $request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->storeAs(
                'files',
                $name,
                'public'
            );
        }

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file_url' => 'file|mimes:jpg,png,pdf,webp,gif',
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        dispatch(new SendEmailJob($application));

        return back();
    }

    protected function checkDate()
    {
        if (is_null(auth()->user()->applications()->latest()->first())) {
            return false;
        }

        $last_application = auth()->user()->applications()->latest()->first();
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($last_app_date == $today) {
            return true;
        }
    }
}
