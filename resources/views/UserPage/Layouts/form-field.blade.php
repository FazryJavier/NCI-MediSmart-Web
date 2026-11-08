{{--
    One labelled form field in the form design ("* Label" above a full-width input).
    @param string $name
    @param string $label
    @param string $type          text | email | tel | textarea
    @param string|null $autocomplete
    @param bool $required        default true
    @param string|null $hint     helper text under the field
--}}
@php
    $required = $required ?? true;
    $type = $type ?? 'text';
    $inputClass = 'block w-full rounded-lg border border-black/15 px-4 py-3 text-base text-ink outline-none transition placeholder:text-gray-400 focus:border-brand focus:ring-2 focus:ring-brand/30';
    $describedBy = trim(($errors->has($name) ? "{$name}-error " : '') . (! empty($hint) ? "{$name}-hint" : ''));
@endphp
<div>
    <label for="{{ $name }}" class="mb-2 block text-lg text-ink">
        @if ($required)<span class="mr-1 text-red-600" aria-hidden="true">*</span>@endif{{ $label }}
        @unless ($required)<span class="text-sm text-muted"> (opsional)</span>@endunless
    </label>
    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="5" @if ($required) required @endif
            @if (! empty($autocomplete)) autocomplete="{{ $autocomplete }}" @endif class="{{ $inputClass }}"
            @error($name) aria-invalid="true" @enderror @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif>{{ old($name) }}</textarea>
    @else
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" @if ($required) required @endif
            @if (! empty($autocomplete)) autocomplete="{{ $autocomplete }}" @endif class="{{ $inputClass }} h-14"
            @error($name) aria-invalid="true" @enderror @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif>
    @endif
    @if (! empty($hint))
        <p id="{{ $name }}-hint" class="mt-1 text-sm text-muted">{{ $hint }}</p>
    @endif
    @error($name)
        <p id="{{ $name }}-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
