<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Dating;
use Illuminate\Http\Request;

class DatingController extends Controller
{
    public function index()
    {
        $datings = Dating::paginate(10);
        return view('assistant.dating.index', compact('datings'));
    }
}
