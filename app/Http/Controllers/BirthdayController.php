<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index()
    {
        return ContactResource::collection(request()->user()->contacts()->birthdays()->get());
    }
}
