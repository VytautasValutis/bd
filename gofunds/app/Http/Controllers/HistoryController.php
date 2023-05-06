<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use App\Models\Money;
use App\Models\Like;
use App\Models\Ht_pivot;
use App\Models\Ht;
use App\Models\Photo;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $htf = $request->hash_tags ?? 0;
        if($htf > 0) {
            $ht_pivots = Ht_pivot::where('hts__id', $htf)->get();
            $hist_arr = array_map(fn($h) => $h, $ht_pivots->histories__id);
            dd($hist_arr, $htf);
            $histories = History::where('id', $htf);
        }
        $histories = History::orderBy('id');
        // $histories = $histories->orderBy('id');
        $histories = $histories->paginate(3)->withQueryString();
        $users = User::all();
        $moneys = Money::all();
        $likes = Like::all();
        $ht_pivots = Ht_pivot::orderBy('hts__id');
        $ht_pivots = $ht_pivots->get();
        $hts = Ht::orderBy('text');
        $hts = $hts->get();
        $gallery = Photo::all(); 

        return view('back.history.index', [
            'histories' => $histories,
            'users' => $users,
            'moneys' => $moneys,
            'likes' => $likes,
            'ht_pivots' => $ht_pivots,
            'hts' => $hts,
            'gallery' => $gallery,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(History $history)
    {
        //
    }

    public function edit(History $history)
    {
        //
    }

    public function update(Request $request, History $history)
    {
        //
    }

    public function destroy(History $history)
    {
        //
    }
}
