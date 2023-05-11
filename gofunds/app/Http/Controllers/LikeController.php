<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\History;

class LikeController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $hist = History::where('id', $request->hist_id)->first();
        $like_count = (int) $hist->like;
        $like_count++;

        // $hist->like = $like_count;
        // $hist->save();
        $hist->update([
            'like' => $like_count,
        ]);

        Like::create([
            'user_id' => $request->user_id,
            'history_id' => $request->hist_id,
        ]);

        return redirect()->back();

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Like $like)
    {
        //
    }

    public function edit(Like $like)
    {
        //
    }

    public function update(Request $request, Like $like)
    {
        //
    }

    public function destroy(Like $like)
    {
        //
    }
}
