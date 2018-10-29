<select class="form-control {{ $errors->has('{$name}') ? 'is-invalid' : '' }}" name="{{ $name }}" id="{{ $name }}" style="width: 100%;">
    <option value="">Select</option>
    @foreach ($datasource as $data)
    @php
    $selected = ''
    @endphp
    @if ($value == $data->id)
    @php
    $selected = 'selected'
    @endphp        
    @endif
    <option value="{{ $data->id }}" {{ $selected }}>{{ $data->name }}</option>
    @endforeach
</select> 

@if ($errors->has('{$name}'))
<span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('{$name}') }}</strong>
</span>
@endif
