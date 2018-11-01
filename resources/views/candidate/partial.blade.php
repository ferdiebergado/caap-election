@extends('layouts.app')

@section('content')

@php
    $model = 'candidate';
    $plural = str_plural($model);
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-1">                    
            {{ ucfirst(explode('.', Route::currentRouteName())[1]) }} {{ ucfirst($model) }}</div>
        </h5>        
        <div class="container">
            <div class="row">
                
                <div class="card-body">
                    <form method="POST" action="{{ $route }}">
                        @csrf
                        
                        @if (Route::is("$plural.edit"))
                        {{ method_field('PUT') }}                            
                        @endif                                               
                        
                        <div class="form-group row">
                            <label for="voter_id" class="col-md-4 col-form-label text-md-right">Name</label>
                            
                            <div class="col-md-6">
                                @component('select', ['datasource' => $voters, 'value' => old('voter_id', optional($candidate)->voter_id), 'field' => 'fullname'])
                                @slot('name')
                                voter_id
                                @endslot
                                required            
                                @endcomponent                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">Position</label>
                            
                            <div class="col-md-6">
                                @component('select', ['datasource' => $positions, 'value' => old('position_id', optional($candidate)->position_id)])
                                @slot('name')
                                position_id
                                @endslot
                                required            
                                @endcomponent                            
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="fa fa-save"></i> SAVE
                                </button>
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
