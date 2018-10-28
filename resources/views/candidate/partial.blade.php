@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ucfirst(explode('.', Route::currentRouteName())[1]) }} Candidate</div>

                <div class="card-body">
                    <form method="{{ $method }}" action="{{ $route }}">
                        @csrf

                        <div class="form-group row">
                            <label for="election" class="col-md-4 col-form-label text-md-right">Election</label>

                            <div class="col-md-6">
                                <select id="election" class="form-control{{ $errors->has('election') ? ' is-invalid' : '' }}" name="election" required autofocus></select>

                                @if ($errors->has('election'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('election') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">
                                    SAVE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
