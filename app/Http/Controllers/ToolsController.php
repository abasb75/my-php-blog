<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolsController extends Controller
{

    public function index() {
        $tools = Tool::all();
        return view('tools',compact('tools'));
    }
}
