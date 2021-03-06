<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use App\Helpers\DataTableHelper;
use App\Helpers\RequestCriteria;
use App\Helpers\RequestParser;

class OfficeController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $namespace = "App\\";
    protected $modelstr = 'office';
    protected $plural;
    protected $indexroute;
    protected $model;

    public function __construct()
    {
        $this->pluralizeModel();
        $this->setIndexRoute();
        $this->setModel();
    }

    private function setModel()
    {
        $this->model = $this->namespace . ucfirst($this->modelstr);
    }

    private function pluralizeModel()
    {
        $this->plural = str_plural($this->modelstr);
    }

    private function setIndexRoute()
    {
        $this->indexroute = $this->plural . ".index";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Office::orderBy('name')->get(['id', 'name']);
        if (request()->has('length')) {
            $offices = $this->datatablePaginate('App\Office', ['voters']);
            $draw = $offices['draw'];
            $data = $offices['data'];
        }

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $draw ?? null,
                'data' => $data,
            ]);
        }
        $route = $this->indexroute;
        return view('office.index', compact('data', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $office = new Office();
        $route = route('offices.store');
        return view('office.partial', compact('office', 'route'));
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
            'name' => 'required'
        ]);

        $office = Office::create($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'New Office successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        $office = $this->model::with([
            'voters' => function ($q) {
                $q
                    ->orderBy('lastname')
                    ->orderBy('firstname')
                    ->orderBy('middlename');
            }
        ])->find($office->id);

        return view('office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        $route = route('offices.update', ['office' => $office]);
        return view('office.partial', compact('office', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $office->update($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'Office data successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        session()->flash('status', 'Office data successfully deleted.');
        return redirect()->back();
    }
}
