<?php

namespace App\Http\Controllers\API\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function PayNow(Request $request,$id){

        $validateData = $request->validate([
            'salary' => 'required',
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();

//        dd($check);

        if ($check) {
            return response()->json('Salary Already Paid!');
        }else{

            $salary = new Salary([
                'employee_id' => $id,
                'amount' => $request->get('salary'),
                'salary_date' => Carbon::now()->toDateTimeString(),
                'salary_month' => $month,
                'salary_year' => date('Y')
            ]);
            $salary->save(['timestamps' => false]);

            return response()->json($salary);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
