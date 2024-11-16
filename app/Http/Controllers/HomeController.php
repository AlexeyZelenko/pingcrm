<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of songs.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Home/Index');
    }
}
