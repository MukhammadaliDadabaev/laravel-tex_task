<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function create(Application $application)
    {
        return view('answers.create', ['application' => $application]);
    }

    public function store(Application $application, Request $request)
    {
    }
}
