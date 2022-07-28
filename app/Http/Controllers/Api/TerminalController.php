<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Terminal;
use Illuminate\Support\Facades\DB;

class TerminalController extends Controller
{
    //

    public function getAllTerminal()
    {
        $terminals = Terminal::select('id', 'company_name')->orderBy('created_at','desc')->paginate(10);
        return response([
            'status' => 200,
            'data' => $terminals,
            'message' => "success",
            'error' => false,
        ]);
    }
}