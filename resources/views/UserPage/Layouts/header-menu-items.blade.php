{{--
    Items of a header dropdown, shared by the desktop and mobile menus.
    @param string $menu 'produk' | 'tentang'
    @param string $iconSize Tailwind size classes for the item icon
    Uses $products, $about and $dropLink from the including header.
--}}
@if ($menu === 'produk')
    @foreach ($products as $navbarItem)
        <li>
            <a href="{{ $navbarItem->products->publicUrl() }}" class="{{ $dropLink }}">
                <img src="{{ asset('storage/' . $navbarItem->icon) }}" alt="" class="{{ $iconSize }} shrink-0 object-contain"
                    loading="lazy" decoding="async">
                <span>
                    <span class="block font-bold">{{ $navbarItem->products->title }}</span>
                    <span class="block text-xs text-muted">{{ $navbarItem->products->subTitle }}</span>
                </span>
            </a>
        </li>
    @endforeach
@else
    @foreach ($about as $item)
        <li>
            <a href="{{ $item['href'] }}" class="{{ $dropLink }}"
                @if ($item['external']) target="_blank" rel="noopener noreferrer" @endif>
                <img src="{{ $item['icon'] }}" alt="" class="{{ $iconSize }} shrink-0 object-contain" loading="lazy"
                    decoding="async">
                <span class="font-bold">{{ $item['title'] }}</span>
            </a>
        </li>
    @endforeach
@endif
