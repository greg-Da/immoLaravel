@php
    $multiple ??= false;
    $class ??= null;
    $name ??= null;
    $options ??= [];
    $optionValue ??= null;
    $optionDisplay ??= null;
    $defaultValue = old($name) ?? ($defaultValue ?? null);
    $placeholder ??= 'select';
    $label ??= ucfirst($name);
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror"
        aria-label="placeholder">
        <option style="display: none" value="{{ null }}" {{ is_null($defaultValue) ? 'selected' : '' }}>
            {{ $placeholder }}</option>

        @foreach ($options as $option)
            <option {{ $defaultValue == $option->$optionValue ? 'selected' : '' }} value="{{ $option->$optionValue }}">
                {{ $option->$optionDisplay }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
</div>
