<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;

class EmployeeController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $indexroute = 'employees.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::orderBy('lastname')->orderBy('firstname')->get();
        if (request()->has('length')) {
            $employees = $this->datatablePaginate('App\Employee', ['office']);
            $draw = $employees['draw'];
            $data = $employees['data'];
        }

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $draw ?? null,
                'data' => $data,
            ]);
        }
        $route = $this->indexroute;
        return view('employee.index', compact('employees', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new Employee();
        $route = route('employees.store');
        return view('employee.partial', compact('employee', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required'
        ]);

        $employee = Employee::create($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'New voter information was successfully recorded in the system.');
        return view('employee.index', compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $route = route('employees.update', ['employee' => $employee]);
        return view('employee.partial', compact('employee', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required'
        ]);

        $employee->update($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'Voter information was successfully updated.');
        return view('employee.index', compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        session()->flash('status', 'Voter information was successfully deleted.');
        return redirect()->back();
    }
}
