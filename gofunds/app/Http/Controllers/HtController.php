<?php

namespace App\Http\Controllers;

use App\Models\Ht;
use Illuminate\Http\Request;


class HtController extends Controller
{
    public function index()
    {   
        $tags = Ht::where('id', '>', '0')->orderBy('text')->get();
        return view('back.tags.index', [
            'tags' => $tags,
        ]);
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

    public function destroyHt(Request $request, Ht $ht)
    {
        
        $ht->delete();
        return redirect()->route('tags-index');
    }

    public function create(Request $request)
    {
        $title = $request->title ?? '';
        $ht = Ht::where('text', $title)->first();

        if (!$ht && $title) {
            $ht = Ht::create([
                'text' => $title
            ]);
            return redirect()->route('tags-index');
        }
        return redirect()->route('tags-index');
        // return response()->json([
        //     'status' => 'error',
        //     'message' => 'Tag already exists or empty.'
        // ]);
    }


    public function showModal(Ht $ht)
    {
        return view('back.tags.modal', [
            'ht' => $ht
            ]);

    }


    public function update(Request $request, Tag $tag)
    {
    }

}