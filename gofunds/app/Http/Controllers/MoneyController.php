<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;
use App\Models\History;

class MoneyController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        Money::create([
            'user_id' => $request->user_id,
            'history_id' => $request->hist_id,
            'money' => $request->value,
        ]);

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
