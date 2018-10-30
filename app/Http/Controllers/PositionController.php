<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;
use App\Position;

class PositionController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $namespace = "App\\";
    protected $modelstr = 'position';
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
        $data = $this->model::with(['candidates'])->get();
        if (request()->has('length')) {
            $model = $this->datatablePaginate($this->model, ['candidates']);
            $draw = $model['draw'];
            $data = $model['data'];
        }

        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $draw ?? null,
                'data' => $data,
            ]);
        }
        $route = $this->indexroute;
        return view($this->modelstr . ".index", compact('data', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = new $this->model();
        $route = route($this->plural . ".store");
        return view($this->modelstr . ".partial", compact($this->modelstr, 'route'));
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
            'name' => 'required',
        ]);

        $data = $this->model::create($request->all());
        $route = $this->indexroute;
        session()->flash('status', 'New Position data successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        $position = $this->model::with(['candidates'])->find($position->id);
        return view($this->modelstr . ".show", compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $route = route($this->plural . ".update", compact('position'));
        return view($this->modelstr . ".partial", compact('position', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $position->update($request->all());

        $route = $this->indexroute;
        session()->flash('status', 'Position information successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        session()->flash('status', 'Position information successfully deleted.');
        return redirect()->back();
    }
}
