{{-- Shared fields of the popup form. $popup is null when creating. --}}
@php
    $startValue = old('start_date', $popup?->start_date?->format('Y-m-d'));
    $endValue = old('end_date', $popup?->end_date?->format('Y-m-d'));
@endphp

<div class="mb-4">
    <label for="image" class="form-label">Gambar Popup</label>
    <span class="description">Ukuran maksimal 5MB (jpeg, png, jpg, gif, webp).{{ $popup ? ' Kosongkan jika tidak ingin mengganti gambar.' : '' }}</span>
    @if ($popup?->image)
        <img src="{{ asset('storage/' . $popup->image) }}" alt="Gambar popup saat ini"
            class="img-preview img-fluid mb-3 d-block" style="max-width: 320px;">
    @else
        <img class="img-preview img-fluid mb-3 mt-2" alt="" style="max-width: 320px; display: none;">
    @endif
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image"
            accept="image/jpeg,image/png,image/gif,image/webp" @required(! $popup)>
        <label class="custom-file-label" for="image">Pilih gambar</label>
    </div>
    @error('image')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<x-admin.switch name="status" label="Tampilkan popup di website" :checked="$popup?->status ?? true"
    on="Aktif: tampil di website" off="Nonaktif: tidak tampil"
    help="Matikan untuk menyembunyikan popup tanpa menghapusnya." />

<div class="mb-4" id="schedule">
    <label class="form-label d-block">Jadwal tayang <span class="text-muted font-weight-normal">(opsional)</span></label>
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <label for="start_date" class="small text-muted mb-1">Mulai tayang</label>
            <input type="date" name="start_date" id="start_date" value="{{ $startValue }}"
                class="form-control @error('start_date') is-invalid @enderror">
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-2">
            <label for="end_date" class="small text-muted mb-1">Berakhir (hari terakhir tayang)</label>
            <input type="date" name="end_date" id="end_date" value="{{ $endValue }}"
                class="form-control @error('end_date') is-invalid @enderror">
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <span class="description">Kosongkan kedua tanggal agar popup tayang terus selama aktif. Tanggal berakhir ikut tayang sampai pukul 23.59.</span>
</div>

<div id="popup-summary" class="alert alert-info" role="status" aria-live="polite"></div>

<div class="mb-4">
    <label for="link" class="form-label">Link Tombol</label>
    <input type="text" name="link" id="link" value="{{ old('link', $popup?->link) }}"
        class="form-control @error('link') is-invalid @enderror" placeholder="/blog atau https://contoh.com/promo"
        autocomplete="off" required>
    @error('link')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <span class="description">
        Alamat halaman di website ini, contoh <code>/produk/1</code>, <code>/modul/2</code>, <code>/blog</code>,
        <code>/testimoni</code>, atau alamat lengkap yang diawali <code>https://</code>.
    </span>
</div>

<div class="alert alert-light border small mb-4">
    <i class="fas fa-info-circle mr-1"></i>
    Website hanya menampilkan <strong>satu popup, yaitu yang terbaru</strong>. Popup lama tidak perlu dihapus,
    cukup buat yang baru.
</div>

<script>
    (function() {
        var toggle = document.getElementById('switch-status');
        var start = document.getElementById('start_date');
        var end = document.getElementById('end_date');
        var schedule = document.getElementById('schedule');
        var summary = document.getElementById('popup-summary');
        var image = document.getElementById('image');
        var preview = document.querySelector('.img-preview');
        var fmt = new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

        function format(value) {
            return fmt.format(new Date(value + 'T00:00:00'));
        }

        function refresh() {
            var on = toggle.checked;
            schedule.style.opacity = on ? '1' : '.5';
            end.min = start.value || '';

            var cls = 'alert-info';
            var text;
            if (!on) {
                cls = 'alert-secondary';
                text = 'Popup dinonaktifkan: pengunjung tidak akan melihatnya, berapa pun jadwalnya.';
            } else if (start.value && end.value && end.value < start.value) {
                cls = 'alert-danger';
                text = 'Tanggal berakhir tidak boleh sebelum tanggal mulai.';
            } else if (start.value && end.value) {
                text = 'Popup tayang dari ' + format(start.value) + ' sampai ' + format(end.value) + ' (hari terakhir ikut tayang).';
            } else if (start.value) {
                text = 'Popup tayang mulai ' + format(start.value) + ' tanpa batas akhir.';
            } else if (end.value) {
                text = 'Popup tayang sekarang sampai ' + format(end.value) + ' (hari terakhir ikut tayang).';
            } else {
                text = 'Popup tayang terus sampai Anda menonaktifkannya.';
            }

            summary.className = 'alert ' + cls;
            summary.textContent = text;
        }

        [toggle, start, end].forEach(function(el) { el.addEventListener('input', refresh); el.addEventListener('change', refresh); });

        image.addEventListener('change', function() {
            var file = image.files[0];
            var name = image.nextElementSibling;
            if (name) { name.textContent = file ? file.name : 'Pilih gambar'; }
            if (!file || !preview) { return; }
            var reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(file);
        });

        refresh();
    })();
</script>
