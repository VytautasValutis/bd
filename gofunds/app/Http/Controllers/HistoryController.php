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
        $user_status = $request->user();
        $htf = $request->hash_tags ?? 0;
        if($htf > 0) {
            $ht_pivots = Ht_pivot::where('hts__id', $htf)->get();
            $hist_arr = $ht_pivots->pluck('histories__id')->all();
            $histories = History::whereIn('id', $hist_arr);
        } else {
            $histories = History::orderBy('id');
        }
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
            'htf' => $htf,
            'user_status' => $user_status,
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
        $approved = 1;
        $lack_money = $history->need_money;

        $history->update([
            'approved' => $approved,
            'lack_money' => $lack_money,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, History $history)
    {
        //
    }

    public function destroy(History $history)
    {
                
        if ($cat->gallery->count()) {
            foreach ($cat->gallery as $gal) {
                $gal->deletePhoto();
            }
        }
        
        if ($cat->photo) {
            $cat->deletePhoto();
        }
        
        $cat->delete();
        return redirect()->route('cats-index');

    }
}
