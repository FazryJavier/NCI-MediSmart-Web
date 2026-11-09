<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Popup extends Model
{
    use HasFactory;

    /** Shown on the website right now. */
    public const STATE_LIVE = 'live';

    /** Switched on, but the start date has not arrived yet. */
    public const STATE_SCHEDULED = 'scheduled';

    /** Switched on, but the end date has passed. */
    public const STATE_EXPIRED = 'expired';

    /** Switched off (or has no image), so it is never shown. */
    public const STATE_HIDDEN = 'hidden';

    protected $table = 'popups';
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Single source of truth for "is this popup visible?", used by the admin list and the public page.
     * A date without a time (the admin form only has dates) covers that whole day, so the end date
     * is the last day the popup is shown, not the day before.
     */
    public static function resolveState(mixed $status, mixed $start, mixed $end, ?string $image, ?Carbon $now = null): string
    {
        $now ??= now();

        if ((int) $status !== 1 || ! $image) {
            return self::STATE_HIDDEN;
        }

        $start = $start ? Carbon::parse($start) : null;
        $end = $end ? Carbon::parse($end) : null;

        if ($end && $end->isStartOfDay()) {
            $end = $end->copy()->endOfDay();
        }

        if ($start && $now->lt($start)) {
            return self::STATE_SCHEDULED;
        }

        if ($end && $now->gt($end)) {
            return self::STATE_EXPIRED;
        }

        return self::STATE_LIVE;
    }

    public function state(?Carbon $now = null): string
    {
        return self::resolveState($this->status, $this->start_date, $this->end_date, $this->image, $now);
    }
}
