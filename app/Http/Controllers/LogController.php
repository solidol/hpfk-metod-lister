<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        return view('logs.index', [
            'arEvents' => Log::orderByDesc('created_at')->paginate(200),
        ]);
    }

}
