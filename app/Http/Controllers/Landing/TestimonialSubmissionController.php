<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Public testimonial form. Submissions are NOT published automatically: they are stored as JSON files
 * (no migration needed, production deploys by git pull only) and reviewed by an admin, who copies the
 * suitable ones into the existing Feedback menu.
 */
class TestimonialSubmissionController extends Controller
{
    public const DIRECTORY = 'testimonial-submissions';

    public function create(): View
    {
        return view('UserPage.Pages.testimoni-form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'instance_name' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9 ()-]{8,20}$/'],
            'testimonial' => 'required|string|min:20|max:1000',
            // Honeypot: must stay empty.
            'website' => 'prohibited',
        ], [
            'phone_number.regex' => 'Nomor telepon hanya boleh berisi angka, spasi, tanda + ( ) -, minimal 8 digit.',
            'website.prohibited' => 'Permintaan tidak valid.',
        ]);

        unset($data['website']);
        $data['submitted_at'] = now()->toIso8601String();

        $file = self::DIRECTORY . '/' . now()->format('Ymd-His') . '-' . Str::lower(Str::random(8)) . '.json';
        Storage::disk('local')->put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        return back()->with('status', 'Terima kasih! Testimoni Anda sudah kami terima dan akan kami tinjau sebelum ditampilkan.');
    }

    /** Admin-only list of submissions (newest first). */
    public function index(): View
    {
        $disk = Storage::disk('local');

        $submissions = collect($disk->files(self::DIRECTORY))
            ->filter(fn (string $path) => str_ends_with($path, '.json'))
            ->sortDesc()
            ->map(function (string $path) use ($disk) {
                $data = json_decode((string) $disk->get($path), true) ?: [];
                $data['submitted_at'] = isset($data['submitted_at']) ? Carbon::parse($data['submitted_at']) : null;

                return $data;
            })
            ->values();

        return view('UserPage.Pages.testimoni-submissions', ['submissions' => $submissions]);
    }
}
