<?php

namespace App\Http\Controllers\API\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use Carbon\Carbon;
//use DB;

class SalaryController extends Controller
{
    public function PayNow(Request $request,$id)
    {
        $validateData = $request->validate([
            'salary' => 'required',
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();

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

    public function AllSalary()
    {
        $salary = Salary::select('salary_month')
                    ->groupBy('salary_month')
                    ->get();

        return response()->json($salary);
    }

    public function ViewSalary($id)
    {
        $month = $id;

        $view = Salary::join('employees','salaries.employee_id','employees.id')
                    ->select('employees.name','salaries.*')
                    ->where('salaries.salary_month',$month)
                    ->get();

        return response()->json($view);
    }

    public function EditSalary($id)
    {
        $view = Salary::join('employees','salaries.employee_id','employees.id')
                    ->select('employees.name','employees.code','salaries.*')
                    ->where('salaries.id',$id)
                    ->first();

        return response()->json($view);
    }

    public function SalaryUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'salary_month' => 'required',
        ]);

        // Need Checking Already Paid

        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;

        Salary::where('id',$id)->update($data);
    }



}
