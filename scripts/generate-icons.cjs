// Run: npm run icons. Generates resources/views/components/icon.blade.php from the official Font Awesome Free SVG packages.
const path = require('path');
const root = path.resolve(__dirname, '..');
const solid = require(path.join(root, 'node_modules/@fortawesome/free-solid-svg-icons'));
const brands = require(path.join(root, 'node_modules/@fortawesome/free-brands-svg-icons'));
const want = {
  bars: solid.faBars, xmark: solid.faXmark, 'arrow-left': solid.faArrowLeft, 'arrow-right': solid.faArrowRight,
  'chevron-down': solid.faChevronDown, 'circle-check': solid.faCircleCheck, 'location-dot': solid.faLocationDot,
  phone: solid.faPhone, play: solid.faPlay, check: solid.faCheck,
  instagram: brands.faInstagram, 'linkedin-in': brands.faLinkedinIn, youtube: brands.faYoutube, whatsapp: brands.faWhatsapp,
};
const lines = Object.entries(want).map(([name, def]) => {
  const [w, h, , , d] = def.icon;
  return `        '${name}' => [${w}, ${h}, '${d}'],`;
});
const out = `{{--
    Inline SVG icon (no icon font, no JS). Usage: <x-icon name="phone" class="h-4 w-4" />
    Paths generated from @fortawesome/free-solid-svg-icons and free-brands-svg-icons 6.4.2
    (Font Awesome Free, icons licensed CC BY 4.0, https://fontawesome.com/license/free).
    Regenerate when adding icons instead of hand-editing paths.
--}}
@props(['name'])
@php
    $icons = [
${lines.join('\n')}
    ];
    [$width, $height, $path] = $icons[$name] ?? throw new InvalidArgumentException("Unknown icon [{$name}]");
@endphp
<svg {{ $attributes->merge(['class' => 'inline-block h-[1em] w-auto shrink-0 fill-current align-[-0.125em]']) }}
    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {{ $width }} {{ $height }}" aria-hidden="true" focusable="false">
    <path d="{{ $path }}" />
</svg>
`;
require('fs').writeFileSync(path.join(root, 'resources/views/components/icon.blade.php'), out.replace(/\r?\n/g, '\n'));
console.log('icons:', Object.keys(want).length);
