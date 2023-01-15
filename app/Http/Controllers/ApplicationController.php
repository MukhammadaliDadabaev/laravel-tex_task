<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
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
            'file_url' => 'file|mimes:jpg,png,pdf',
        ]);
        // ,webp,gif
        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        return back();
    }
}
