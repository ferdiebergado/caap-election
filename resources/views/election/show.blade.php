@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1">Election Information</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-primary" href="{{ route('elections.edit', ['election' => $election->id]) }}" role="button"><i class="fa fa-edit"></i> Edit</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="form-group row">
                            <label for="staticId" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticId" value="{{ $election->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticTitle" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticTitle" value="{{ $election->title }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="staticDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticDate" value="{{ $election->date }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Candidate(s)</label>
                            <div class="col-sm-10">
                                @isset(optional($election)->candidates)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Middlename</th>
                                            <th>Office</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($election->candidates as $candidate)
                                        <tr>
                                            <td>{{ $candidate->position }}</td>
                                            <td scope="row">{{ $candidate->lastname }}</td>
                                            <td scope="row">{{ $candidate->firstname }}</td>
                                            <td>{{ $candidate->middlename }}</td>
                                        </tr>                                          
                                        @empty
                                        <tr>
                                            <td>No candidate(s) yet.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>                                
                                @endisset                                
                            </div>
                        </div>                                                  
                        <div class="form-group row mb-0">
                            <div class="col-12">
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
