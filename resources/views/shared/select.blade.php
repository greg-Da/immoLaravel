@php
    $multiple ??= false;
    $class ??= null;
    $name ??= null;
    $options ??= [];
    $defaultValue = old($name) ?? ($defaultValue ?? null);
    $placeholder ??= 'select';
    $label ??= ucfirst($name);

    // dd($defaultValue)
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>

    @if ($multiple)
        <select name="{{ $name }}[]" id="{{ $name }}"
            class="form-select @error($name) is-invalid @enderror" aria-label="placeholder" multiple>
        @else
            <select name="{{ $name }}" id="{{ $name }}"
                class="form-select @error($name) is-invalid @enderror" aria-label="placeholder">
                <option style="display: none" value="{{ null }}" {{ is_null($defaultValue) ? 'selected' : '' }}>
                    {{ $placeholder }}</option>
    @endif

    @foreach ($options as $key => $value)
        <option
            {{ $multiple ? (in_array($key,  $defaultValue->toArray()) ? 'selected' : '') : ($defaultValue == $key ? 'selected' : '') }}
            value="{{ $key }}">
            {{ $value }}</option>
    @endforeach

    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
