<?php

namespace App\Http\Controllers;

use App\Models\Ht;
use Illuminate\Http\Request;

class HtController extends Controller
{
    public function index()
    {
        return view('back.tags.index');
    }

    public function list()
    {
        // sleep(3);
        $tags = HT::all();
        $html = view('back.tags.list')->with(['tags' => $tags])->render();
        return response()->json([
            'html' => $html,
            'status' => 'ok',
        ]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'status' => 'ok',
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->title ?? '';
        $tag = Ht::where('text', $title)->first();

        if (!$tag && $title) {
            $tag = Ht::create([
                'text' => $title
            ]);
            return response()->json([
                'status' => 'ok',
                'message' => 'New tag #'.$title.' was created'
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Tag already exists or empty.'
        ]);
    }


    public function showModal(Tag $tag)
    {
        $html = view('back.tags.modal')->with(['tag' => $tag])->render();
        return response()->json([
            'html' => $html,
            'status' => 'ok',
        ]);
    }


    public function update(Request $request, Tag $tag)
    {
        $title = $request->title ?? '';
        $OldTag = Ht::where('text', $title)->first();

        if ($OldTag && $OldTag->id == $tag->id) {
            return response()->json([
                'status' => 'info',
                'message' => 'Tag was not updated'
            ]);
        }

        if (!$OldTag && $title) {
            $tag->update([
                'text' => $title
            ]);
            return response()->json([
                'status' => 'ok',
                'message' => 'Now tag is #'.$title
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Tag already exists or empty.'
        ]);
    }

}