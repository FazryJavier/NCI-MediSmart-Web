<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * SEO-friendly public URLs without a slug column: "{id}-{slug-of-title}", e.g. "/produk/1-simrs-nci-medismart".
 *
 * The id keeps lookups exact and stable even when the title changes; controllers 301-redirect any
 * other slug to the canonical one. No migration needed (production deploys by git pull only).
 */
trait HasPublicUrl
{
    /** Route name of the public page, e.g. "produk.show". */
    abstract protected function publicRouteName(): string;

    public function publicSlug(): string
    {
        $slug = Str::slug((string) $this->title);

        return $slug === '' ? (string) $this->getKey() : $this->getKey() . '-' . Str::limit($slug, 80, '');
    }

    public function publicUrl(): string
    {
        return route($this->publicRouteName(), ['slug' => $this->publicSlug()]);
    }

    /** Extract the numeric id from a "{id}-{slug}" route segment. */
    public static function idFromSlug(string $slug): int
    {
        return (int) strtok($slug, '-');
    }
}
