<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\DetailHistory;

class HistoryController extends Controller
{
    public function index(Request $request)
    {   
        $histories = History::where('user_id', $request->user()->id)->get();

        return view('history', compact('histories'));
    }

    public function detail($id)
    {
        $details = DetailHistory::where('history_id', $id)->get();
        $grandtotals = 0;

        foreach($details as $detail)
        {
            $grandtotals += $detail->total;
        }


        return view('historydetail', compact('details', 'grandtotals'));
    }
}
