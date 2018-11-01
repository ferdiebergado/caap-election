@extends('layouts.app')

@section('content')

@php
$model = 'vote';
$plural = str_plural($model);
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-1">                    
            <i class="s7 s7-pen"></i> {{ ucfirst($model) }}</div>
        </h5>        
        <div class="container">
            <div class="row">
                <div class="col-12">                    
                    <div class="card-body">
                        <form id="vote-form" method="POST" action="{{ $route }}">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="voter_id" class="col-md-4 col-form-label text-md-right">Voter</label>
                                
                                <div class="col-md-6">
                                    @component('select', ['datasource' => $voters, 'value' => old('voter_id'), 'field' => 'fullname'])
                                    @slot('name')
                                    voter_id
                                    @endslot
                                    required autofocus
                                    @endcomponent                                                          
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Candidate(s)</label>       
                            </div>
                            
                            @forelse ($positions as $position)
                            
                            <div class="form-group row">
                                <label for="candidate_id[{{ $position->id }}]" class="col-md-4 col-form-label text-md-right">{{ $position->name }}</label>
                                
                                @php
                                $voters = $position->candidates->map(function ($item, $key) {
                                    return $item->voter;
                                });
                                @endphp
                                
                                <div class="col-md-6">
                                    @component('select', ['datasource' => $voters, 'value' => old("candidate_id[" . $position->id . "]"), 'field' => 'fullname'])
                                    @slot('name')
                                    candidate_id[{{ $position->id }}]
                                    @endslot
                                    required
                                    @endcomponent                            
                                </div>
                            </div>
                            
                            @empty
                            
                            <p>No candidate(s) for this election.</p>
                            
                            @endforelse                            
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-primary float-right" href="#" onclick="if (confirm('Are the information correct?')) { document.querySelector('#vote-form').submit(); }">
                                        <i class="fa fa-save"></i> SAVE
                                    </a>
                                    <a class="btn float-right" href="javascript:void();" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</a>                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    