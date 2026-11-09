{{--
    Flash messages and validation summary for every admin page.
    - success / error / warning / info session messages are shown as toasts (public/assets/admin/admin.js).
    - validation failures get one toast plus a short summary here; each field also shows its own message.
--}}
@php
    $flash = [];
    foreach (['success', 'error', 'warning', 'info'] as $type) {
        $text = session($type);
        if (is_string($text) && $text !== '') {
            $flash[] = ['type' => $type, 'message' => $text];
        }
    }
    if ($errors->any()) {
        $flash[] = ['type' => 'error', 'message' => 'Data belum tersimpan. Periksa isian yang ditandai merah.'];
    }
@endphp

@if ($flash)
    <div id="admin-flash" hidden data-flash="{{ json_encode($flash, JSON_UNESCAPED_UNICODE) }}"></div>
    {{-- Without JavaScript the messages are shown as plain alerts instead. --}}
    <noscript>
        @foreach ($flash as $item)
            <div class="alert alert-{{ $item['type'] === 'error' ? 'danger' : $item['type'] }}" role="alert">{{ $item['message'] }}</div>
        @endforeach
    </noscript>
@endif

@if ($errors->any())
    <div class="form-error-summary" role="alert">
        <div class="form-error-summary__title">
            <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
            Periksa kembali isian Anda ({{ $errors->count() }} kesalahan)
        </div>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
