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
    }

    public function destroyHt(Request $request, Ht $ht)
    {
        $text = $ht->text;
        $ht->delete();
        return redirect()
        ->route('tags-index')
        ->with('ok', 'Hash-tag ' . $text . ' was deleted');

    }

    public function create(Request $request)
    {
        $title = $request->title ?? '';
        $ht = Ht::where('text', $title)->first();

        if (!$ht && $title) {
            $ht = Ht::create([
                'text' => $title
            ]);
            return redirect()
            ->route('tags-index')
            ->with('ok', 'Hash-tag ' . $title . ' was created');
    
        }
        return redirect()
        ->route('tags-index')
        ->withErrors('Hash-tag empty or exists');

    }


    public function update(Request $request, Ht $ht)
    {
        $title = $request->title ?? '';
        if($title == '') {
            return redirect()->back();
        }
        $ht->update([
            'text' => $title,
        ]);
        return redirect()
        ->route('tags-index')
        ->with('ok', 'Hash-tag ' . $title . ' was updated');

    }


    public function showModal(Request $request, Tag $tag)
    {
    }

}