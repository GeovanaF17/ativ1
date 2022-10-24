<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function dasboard(){
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact($notes));
    }
}
