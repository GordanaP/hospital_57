@if ($errors->has($field))
    <span class="invalid-feedback {{ $field }}" role="alert">
        <strong>{{ $errors->first($field) }}</strong>
    </span>
@endif