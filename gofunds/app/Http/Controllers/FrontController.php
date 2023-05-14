<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use App\Models\Money;
use App\Models\Like;
use App\Models\Ht_pivot;
use App\Models\Ht;
use App\Models\Photo;
use Illuminate\Support\Facades\URL;


class FrontController extends Controller
{
    public function index(Request $request) 
    {
        $sort_like = $request->sort_like ?? 0;
        $user_status = $request->user();
        $htf = $request->hash_tags ?? 0;
        if($htf > 0) {
            $ht_pivots = Ht_pivot::where('hts__id', $htf)->get();
            $hist_arr = $ht_pivots->pluck('histories__id')->all();
            $histories = History::whereIn('id', $hist_arr);
        } else {
            $histories = History::where('id', '>', '0');
        }
        $histories = $histories->where('approved', 1);
        if($sort_like) {
            $histories = $histories->orderBy('like', 'desc');
        } else {
            $histories = $histories->orderBy('lack_money', 'desc');
        }
        $histories = $histories->paginate(3)->withQueryString();
        $users = User::all();
        $moneys = Money::all();
        $likes = Like::all();
        $ht_pivots = Ht_pivot::orderBy('hts__id');
        $ht_pivots = $ht_pivots->get();
        $hts = Ht::orderBy('text');
        $hts = $hts->get();
        $gallery = Photo::all(); 
        if(isset($user_status)) {
        $hist_add = !History::where([
            'user_id' => $user_status->id,
            ])->first();
        $hist_edit_obj = History::where([
            'user_id' => $user_status->id,
            'approved' => '0',
            ])->first();
        $hist_edit = $hist_edit_obj !== null ? true : false;             
        } else {
            $hist_add = false;
            $hist_edit = false;
            $hist_edit_obj = null;
        }    


        return view('front.index', [
            'histories' => $histories,
            'users' => $users,
            'moneys' => $moneys,
            'likes' => $likes,
            'ht_pivots' => $ht_pivots,
            'hts' => $hts,
            'gallery' => $gallery,
            'htf' => $htf,
            'user_status' => $user_status,
            'sort_like' => $sort_like,
            'hist_add' => $hist_add,
            'hist_edit' => $hist_edit,
            'hist_edit_obj' => $hist_edit_obj,
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $gallery = Photo::all(); 
        $hist = History::create([
            'user_id' => $user->id,
            'story' => "Here you can write your story up to 5000 characters or press AI button and AI help to You get hash tags and write history.",
            'need_money' => 1,
            'approved' => 0,
            'photo' => null,
        ]);

        return redirect()->route('front-edit', $hist);
    }

    public function edit(Request $request, History $history)
    {
        $gallery = Photo::where('hist_id', $history->id)->get();
        $ht_pivots = Ht_pivot::where('histories__id', $history->id)->get();
        $hist_arr = $ht_pivots->pluck('hts__id')->all();
        $hts = Ht::whereIn('id', $hist_arr)->get();
        $user = $request->user();
        return view('front.create', [
            'user' => $user,
            'hist' => $history,
            'gallery' => $gallery,
            'tags' => $hts,
        ]);


    }

    public function update(Request $request, History $history)
    {
        // dd(
        //     $history,
        //     $request->delete,  
        //     $request->AI,  
        //     $request->submit,  
        //     $request->photo,  
        //     $request->story,  
        // );        

        if ($request->delete == 1) {
            $history->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;
        if(isset($photo)) {
            $name = $history->savePhoto($photo);
            $history->deletePhoto();
            $history->update([
                'need_money' => $request->need_money,
                'story' => $request->story,
                'photo' => $name
            ]);
        } else {
            $history->update([
                'need_money' => $request->need_money,
                'story' => $request->story,
            ]);
        }

        foreach ($request->galleryH ?? [] as $gallery) {
            Photo::add($gallery, $history->id);
        }

        return redirect()->back();
    }

    public function destroyPhoto(Request $request)
    {
        $photo = Photo::where('id', $request->photo)->first();
        $history = History::where('id', $request->hist)->first();
        // dd($photo, $history);
        $photo->deletePhoto();
        $photo->delete();
        return redirect()->route('front-edit', $history);
    }


}
