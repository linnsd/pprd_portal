<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Terminal;

class TerminalController extends Controller
{
    //

    public function getAllTerminal()
    {
        $terminals = Terminal::orderBy('created_at', 'desc')->paginate(10);
        return response([
            'status' => 200,
            'data' => $terminals,
            'message' => "success",
            'error' => false,
        ]);
    }
}