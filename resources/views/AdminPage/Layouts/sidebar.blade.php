@php
    /*
     * Sidebar definition. Each section has a header and a list of entries:
     *  - a link:  ['label' => ..., 'icon' => ..., 'path' => '/Path']
     *  - a group: ['label' => ..., 'icon' => ..., 'children' => [links...]]
     * Icons are Font Awesome 5 Free classes (the version bundled in /adminlte), one per purpose.
     * A link is active for its path and everything below it (e.g. /Product, /Product/create, /Product/3/update).
     */
    $sections = [
        'KONTEN WEBSITE' => [
            [
                'label' => 'Beranda',
                'icon' => 'fas fa-home',
                'children' => [
                    ['label' => 'Slider', 'icon' => 'fas fa-images', 'path' => '/LandingSlider'],
                    ['label' => 'Client', 'icon' => 'fas fa-handshake', 'path' => '/LandingClient'],
                    ['label' => 'Experience', 'icon' => 'fas fa-award', 'path' => '/Experience'],
                    ['label' => 'Experience List', 'icon' => 'fas fa-tasks', 'path' => '/ExperienceList'],
                    ['label' => 'Map', 'icon' => 'fas fa-map-marked-alt', 'path' => '/LandingMap'],
                    ['label' => 'Video', 'icon' => 'fas fa-play-circle', 'path' => '/LandingVideo'],
                    ['label' => 'CTA', 'icon' => 'fas fa-bullhorn', 'path' => '/CTA'],
                ],
            ],
            [
                'label' => 'Produk',
                'icon' => 'fas fa-box-open',
                'children' => [
                    ['label' => 'Product', 'icon' => 'fas fa-cube', 'path' => '/Product'],
                    ['label' => 'Detail Product', 'icon' => 'fas fa-info-circle', 'path' => '/DetailProduct'],
                    ['label' => 'Client Product', 'icon' => 'fas fa-building', 'path' => '/ClientProduct'],
                    ['label' => 'Advantage Product', 'icon' => 'fas fa-star', 'path' => '/AdvantageProduct'],
                    ['label' => 'Advantage List', 'icon' => 'fas fa-list-ul', 'path' => '/AdvantageListProduct'],
                    ['label' => 'Sparasi Product', 'icon' => 'fas fa-layer-group', 'path' => '/Sparasi'],
                ],
            ],
            [
                'label' => 'Modul',
                'icon' => 'fas fa-puzzle-piece',
                'children' => [
                    ['label' => 'Modul Product', 'icon' => 'fas fa-cubes', 'path' => '/ModulProduct'],
                    ['label' => 'Advantage Modul', 'icon' => 'fas fa-thumbs-up', 'path' => '/AdvantageModulProduct'],
                    ['label' => 'Fasilities Modul', 'icon' => 'fas fa-tools', 'path' => '/FasilitiesModulProduct'],
                    ['label' => 'Image Modul', 'icon' => 'fas fa-image', 'path' => '/ImageModulProduct'],
                ],
            ],
            ['label' => 'Tentang Kami', 'icon' => 'fas fa-id-card', 'path' => '/AboutUs'],
            ['label' => 'Blog / Article', 'icon' => 'fas fa-newspaper', 'path' => '/Article'],
        ],
        'INTERAKSI' => [
            [
                'label' => 'Testimoni',
                'icon' => 'fas fa-comments',
                'children' => [
                    ['label' => 'Feedback', 'icon' => 'fas fa-comment-dots', 'path' => '/Feedback'],
                    ['label' => 'Map Feedback', 'icon' => 'fas fa-map-pin', 'path' => '/MapFeedback'],
                    ['label' => 'Testimoni Masuk', 'icon' => 'fas fa-inbox', 'path' => '/TestimoniMasuk'],
                ],
            ],
            ['label' => 'Permintaan Demo', 'icon' => 'fas fa-calendar-check', 'path' => '/DemoList'],
        ],
        'PENGATURAN' => [
            ['label' => 'Navbar', 'icon' => 'fas fa-bars', 'path' => '/Navbar'],
            ['label' => 'Footer', 'icon' => 'fas fa-grip-lines', 'path' => '/Footer'],
            ['label' => 'Pop Up', 'icon' => 'fas fa-window-restore', 'path' => '/Popup'],
            ['label' => 'WhatsApp', 'icon' => 'fab fa-whatsapp', 'path' => '/Whatsapp'],
        ],
    ];

    if (Auth::user()->level === 'Admin') {
        $sections['AKUN'] = [
            ['label' => 'Pengguna', 'icon' => 'fas fa-users-cog', 'path' => '/Users'],
        ];
    }

    $isActive = fn (string $path): bool => request()->is(ltrim($path, '/'), ltrim($path, '/') . '/*');
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand -->
    <a href="/LandingSlider" class="brand-link">
        <img src="{{ asset('assets/img/logo NCI-01.png') }}" alt="NCI Medismart"
            class="brand-image img-circle elevation-3 bg-white" style="opacity: .95">
        <span class="brand-text font-weight-light">NCI Medismart</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2" aria-label="Menu admin">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview"
                role="menu" data-accordion="true">
                @foreach ($sections as $header => $entries)
                    <li class="nav-header">{{ $header }}</li>

                    @foreach ($entries as $entry)
                        @if (isset($entry['children']))
                            @php($open = collect($entry['children'])->contains(fn ($child) => $isActive($child['path'])))
                            <li class="nav-item {{ $open ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ $open ? 'active' : '' }}">
                                    <i class="nav-icon {{ $entry['icon'] }}"></i>
                                    <p>
                                        {{ $entry['label'] }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($entry['children'] as $child)
                                        <li class="nav-item">
                                            <a href="{{ $child['path'] }}"
                                                class="nav-link {{ $isActive($child['path']) ? 'active' : '' }}">
                                                <i class="nav-icon {{ $child['icon'] }}"></i>
                                                <p>{{ $child['label'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ $entry['path'] }}"
                                    class="nav-link {{ $isActive($entry['path']) ? 'active' : '' }}">
                                    <i class="nav-icon {{ $entry['icon'] }}"></i>
                                    <p>{{ $entry['label'] }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
