{{--
    On/off switch for admin forms, always with a statement of what it controls.

    <x-admin.switch name="status" label="Tampilkan slider di beranda" :checked="$slider->status"
        on="Tampil di beranda" off="Disembunyikan" help="Penjelasan singkat." />

    Sends 1 when on and 0 when off (a hidden 0 comes first; the checkbox overrides it), so the value
    does not depend on JavaScript. The state text next to the switch follows the checkbox.
--}}
@props([
    'name' => 'status',
    'label',
    'checked' => false,
    'on' => 'Aktif',
    'off' => 'Nonaktif',
    'help' => null,
])
@php
    $switchId = 'switch-' . $name;
    $isOn = filter_var(old($name, $checked), FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="mb-4 admin-switch" data-on="{{ $on }}" data-off="{{ $off }}">
    <label class="form-label d-block" for="{{ $switchId }}">{{ $label }}</label>
    <input type="hidden" name="{{ $name }}" value="0">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="{{ $switchId }}" name="{{ $name }}" value="1"
            @checked($isOn)>
        <label class="custom-control-label font-weight-normal" for="{{ $switchId }}"
            data-switch-text>{{ $isOn ? $on : $off }}</label>
    </div>
    @if ($help)
        <span class="description">{{ $help }}</span>
    @endif
    @error($name)
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

@once
    <script>
        document.addEventListener('change', function(event) {
            var box = event.target.closest && event.target.closest('.admin-switch');
            if (!box || event.target.type !== 'checkbox') { return; }
            box.querySelector('[data-switch-text]').textContent = event.target.checked ? box.dataset.on : box.dataset.off;
        });
    </script>
@endonce
