<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $request->validate(['content' => 'required']);

    auth()->user()->comments()->create(['content' => $request->content]);

    return back();
  }
}
