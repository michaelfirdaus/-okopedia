<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\DetailHistory;

class HistoryController extends Controller
{
    public function index(Request $request)
    {   
        //Find user's transaction history by comparing the user ID
        $histories = History::where('user_id', $request->user()->id)->get();

        //Redirecting user to history view and pass histories (user's transaction history)
        return view('history', compact('histories'));
    }

    public function detail($id)
    {
        //Find user's transaction history detail by comparing the user ID
        $details = DetailHistory::where('history_id', $id)->get();
        $grandtotals = 0;

        //Counting the grandtotal
        foreach($details as $detail)
        {
            $grandtotals += $detail->total;
        }

        //Redirecting user to historydetail view and passing details (user's transaction history detail) and the grandtotals
        return view('historydetail', compact('details', 'grandtotals'));
    }
}
