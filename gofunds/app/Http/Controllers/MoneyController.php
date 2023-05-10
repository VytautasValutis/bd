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

    public function create(Request $request, History $history)
    {
        dd($request->value, $request->user_id, $history->id);
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
