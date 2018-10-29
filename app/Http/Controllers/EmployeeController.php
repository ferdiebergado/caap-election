<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;

class EmployeeController extends Controller
{
    use RequestParser;
    use RequestCriteria;

    protected $indexroute = 'employees.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = app()->make('request');
        $this->validate($request, [
            'length' => [
                'integer',
                \Illuminate\Validation\Rule::in(config('app.perPageRange'))
            ],
            'sortBy' => 'string|nullable',
            'orderByMulti' => 'string|nullable'
        ]);
        $perPage = $this->getRequestLength($request);
        $employees = $this->apply(app()->make('App\Employee'), $request);
        $employees = $employees->with('office')->paginate($perPage);
        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $request->draw,
                'data' => $employees,
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

        $employee = Employee::update($request->all());
        return view('employee.index');
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
        return redirect()->back();
    }
}
