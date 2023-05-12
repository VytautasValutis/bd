<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\DB;

class MoneyController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request, History $history)
    {
        $hist_id = $history->id;
        $value = $request->value;
        if($value > 0) {
            // $history = History::where('id', $hist_id)->first();
            $have_money = (int) $history->have_money;
            $lack_money = $history->lack_money;
            $need_money = $history->need_money;
            $have_money += $value;
            $diff_money = $need_money - $have_money;
            $lack_money = $diff_money > 0 ? $diff_money : 0;
            $history->update([
                'have_money' => $have_money,
                'lack_money' => $lack_money,
            // ]);
            // DB::table('histories')->where('id', $hist_id)->update([
            //     'have_money' => $have_money,
            //     'lack_money' => $lack_money,
            ]);

            Money::create([
                'user_id' => $request->user_id,
                'history_id' => $hist_id,
                'money' => $value,
            ]);
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Money $money)
    {
        //
    }

    public function edit(Money $money)
    {
        //
    }

    public function update(Request $request, Money $money)
    {
        //
    }

    public function destroy(Money $money)
    {
        //
    }
}
