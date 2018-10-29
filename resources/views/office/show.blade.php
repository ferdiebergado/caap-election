@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">            
                <div class="col-6">
                    <h5 class="card-title mt-2 mb-1">Office</h5>
                </div>
                <div class="col-6">
                    <span class="float-right"><a name="add" id="add" class="btn btn-primary" href="{{ route('offices.edit', ['office' => $office->id]) }}" role="button"><i class="fa fa-edit"></i> Edit</a></span>
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
                            <label for="staticEmail" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $office->id }}">
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticName" value="{{ $office->name }}">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Employee(s)</label>
                            <div class="col-sm-10">
                                @isset(optional($office)->employees)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Middlename</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($office->employees as $employee)
                                        <tr>
                                            <td scope="row">{{ $office->employee->lastname }}</td>
                                            <td scope="row">{{ $office->employee->firstname }}</td>
                                            <td scope="row">{{ $office->employee->middlename }}</td>
                                        </tr>                                          
                                        @empty
                                        <tr>
                                            <td>No employee(s).</td>
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
