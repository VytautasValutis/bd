<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ht;
use App\Models\History;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // return view('history-index');
        $hts = Ht::orderBy('text');
        $hts = $hts->get();
        $history = History::all();
        if ($request->user() && $request->user()->role < 5) {
            return redirect()->route('history-index');
        }
        return redirect()->route('front-index', [
            'hts' => $hts,
            'history' => $history,
            'test' => 666,
        ]);
    }
}
