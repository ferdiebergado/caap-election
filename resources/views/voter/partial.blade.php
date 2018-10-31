@extends('layouts.app')

@section('content')

@php
    $model = 'voter';
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
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Lastname</label>
                            
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" placeholder="Lastname" value="{{ old('lastname', optional($voter)->lastname) }}" required autofocus>
                                
                                @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">Firstname</label>
                            
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" placeholder="Firstname" value="{{ old('firstname', optional($voter)->firstname) }}" required>
                                
                                @if ($errors->has('firstname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">Middle Name</label>
                            
                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" placeholder="Middlename" value="{{ old('middlename', optional($voter)->middlename) }}" required autofocus>
                                
                                @if ($errors->has('middlename'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('middlename') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="office_id" class="col-md-4 col-form-label text-md-right">Office</label>
                            
                            <div class="col-md-6">
                                @component('select', ['datasource' => $offices, 'value' => old('office_id', optional($voter)->office_id)])
                                @slot('name')
                                office_id
                                @endslot
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
