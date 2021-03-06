<?php

namespace App\Http\Controllers\API\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::all();

        return response()->json($expense);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
        ]);

        $expense = new Expense;
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->expense_date = Carbon::now()->toDateTimeString();
        $expense->save(['timestamps' => false]);

        return response()->json($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::where('id',$id)->first();

        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
        ]);

        $data = array();
        $data['details'] =  $request->details;
        $data['amount'] =  $request->amount;
        Expense::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::where('id',$id)->delete();
    }
}
