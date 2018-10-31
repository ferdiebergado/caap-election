<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;
use App\Helpers\DataTableHelper;
use App\Vote;
use App\Election;
use App\Voter;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Candidate;
use App\Position;

class VoteController extends Controller
{
    use RequestParser;
    use RequestCriteria;
    use DataTableHelper;

    protected $namespace = "App\\";
    protected $modelstr = 'vote';
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
        $data = $this->model::with(['voter', 'position', 'candidate', 'election'])->get();
        if (request()->has('length')) {
            $model = $this->datatablePaginate($this->model, ['voter', 'position', 'candidate.voter', 'election']);
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
        $positions = Position::with([
            'election' => function ($q) {
                $q->where('active', true);
            },
            'candidates.voter'
        ])->get(['id', 'name']);
        $route = route($this->plural . ".store");
        return view($this->modelstr . ".partial", compact('route', 'positions'));
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
            'voter_id' => 'required|integer',
            'position_id' => 'required|integer',
            'candidate_id' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $election = Election::where('active', true)->first();
            if (isset($election)) {
                $request->merge(['election_id' => $election->id]);
                $data = $this->model::create($request->all());
                Voter::where('id', $request->voter_id)->update(['voted' => true]);
            } else {
                throw new Exception('No active election.  Please set an active election on the Election Menu.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        DB::commit();

        $route = $this->indexroute;
        session()->flash('status', 'New Vote data successfully recorded in the system.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        $vote = $this->model::with(['candidates'])->find($vote->id);
        return view($this->modelstr . ".show", compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        $route = route($this->plural . ".update", compact('vote'));
        return view($this->modelstr . ".partial", compact('vote', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        $this->validate($request, [
            'voter_id' => 'required|integer',
            'position_id' => 'required|integer',
            'candidate_id' => 'required|integer',
            'election_id' => 'required|integer'
        ]);

        $vote->update($request->all());

        $route = $this->indexroute;
        session()->flash('status', 'Vote information successfully updated.');
        return redirect()->route($route)->with(compact('route'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        Voter::where('id', $vote->voter_id)->update(['voted' => false]);
        $vote->delete();
        session()->flash('status', 'Vote information successfully deleted.');
        return redirect()->back();
    }
}
