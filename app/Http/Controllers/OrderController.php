<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function increment($id)
{
    $record = Project::findOrFail($id);
    $record->increment('order');

    return back();
}

public function decrement($id)
{
    $record = Project::findOrFail($id);
    $record->decrement('order');

    return back();
}

}
