@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ ucfirst(explode('.', Route::currentRouteName())[1]) }} Election</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ $route }}">
                        @csrf
                        
                        @if (Route::is('elections.edit'))
                        {{ method_field('PUT') }}                            
                        @endif
                        
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                            
                            <div class="col-md-6">
                                <textarea id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Title" rows="2" required autofocus>{{ old('title', optional($election)->title) }}</textarea>
                                
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>
                            
                            <div class="col-md-6">
                                <input type="date" name="date" id="date" class="form-control" placeholder="Date" value="{{ old('ate', optional($election)->date) }}" required autocomplete="off">
                                
                                @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">Active</label>
                            
                            <div class="col-md-6">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="active" name="active" type="checkbox" 
                                    {{ old('active', optional($election)->active) ? 'checked' : '' }}>
                                    <label class="custom-switch-btn" for="active"></label>
                                </div>         

                                @if ($errors->has('active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('active') }}</strong>
                                </span>
                                @endif
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

@push('scripts')
<script type="text/javascript">
    flatpickr('#date', {allowInput: true});
</script>
@endpush
