<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;
use App\Candidate;
use App\Voter;

class CandidateController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $namespace = "App\\";
    protected $modelstr = 'candidate';
    protected $plural;
    protected $indexroute;

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
        $data = $this->model::with(['voter' => function ($q) {
            $q->orderBy('lastname');
        }, 'election', 'position'])->get();
        if (request()->has('length')) {
            $model = $this->datatablePaginate($this->model, ['voter', 'election', 'position']);
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
        $candidate = new $this->model();
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
            'election_id' => 'required|integer',
            'voter_id' => 'required|integer',
            'position_id' => 'required|integer'
        ]);

        $data = $this->model::create($request->all());
        Voter::find($request->position_id)->update(['candidate' => true]);

        $route = $this->indexroute;
        session()->flash('status', 'New Candidate successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $candidate = $this->model::with(['voter', 'election', 'position'])->find($candidate->id);
        return view($this->modelstr . ".show", compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        $route = route($this->plural . ".update", compact('candidate'));
        return view($this->modelstr . ".partial", compact('candidate', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        $this->validate($request, [
            'election_id' => 'required|integer',
            'voter_id' => 'required|integer',
            'position_id' => 'required|integer'
        ]);

        $candidate->update($request->all());

        $route = $this->indexroute;
        session()->flash('status', 'Candidate information successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        session()->flash('status', 'Candidate information successfully deleted.');
        return redirect()->back();
    }
}
