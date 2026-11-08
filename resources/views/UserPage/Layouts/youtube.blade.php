{{--
    YouTube video as a lightweight facade (lite-youtube-embed): only the thumbnail loads up front,
    the real player (~1 MB of YouTube JS) loads when the visitor clicks play.
    @param string|null $video  YouTube video id (a full watch/embed/youtu.be URL is also accepted)
    @param string|null $title  Accessible title for the play button
    @param string      $class  Extra classes for the frame (size, radius, border)
--}}
@php
    $videoId = null;
    if (! empty($video) && preg_match('~(?:v=|youtu\.be/|embed/|shorts/)?([A-Za-z0-9_-]{11})(?:[?&#].*)?$~', trim($video), $m)) {
        $videoId = $m[1];
    }
@endphp
@if ($videoId)
    <lite-youtube videoid="{{ $videoId }}" playlabel="Putar video: {{ $title ?: 'NCI Medismart' }}"
        params="rel=0" class="block aspect-video w-full !max-w-none overflow-hidden {{ $class ?? '' }}"
        style="background-image: url('https://i.ytimg.com/vi/{{ $videoId }}/hqdefault.jpg')"></lite-youtube>
@endif
