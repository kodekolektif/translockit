@php
    // Standalone on purpose: no shared layout, and nothing here may throw, so the page
    // still renders when the error comes from the database, settings or layout.
    $errLocale = in_array(request()->segment(1), ['en', 'es'], true) ? request()->segment(1) : 'en';
    app()->setLocale($errLocale);

    // The logo lives in the settings table; fall back to a text wordmark if that is what failed.
    $errLogo = null;
    try {
        $errLogoPath = (new \App\Settings\AppSettings())->logo_dark;
        $errLogo = $errLogoPath ? \Illuminate\Support\Facades\Storage::url($errLogoPath) : null;
    } catch (\Throwable $e) {
        $errLogo = null;
    }
@endphp
<!doctype html>
<html lang="{{ $errLocale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>{{ __('errors.500.title') }} | Translock IT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&family=Teko:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #60B5FF; --ink: #222429; --muted: #6c7178; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; flex-direction: column; font-family: "Rubik", system-ui, sans-serif; color: var(--ink); background: #f4f7fb; }
        header { padding: 24px 16px; text-align: center; background: var(--ink); }
        header img { height: 44px; width: auto; }
        .brand { font-family: "Teko", sans-serif; font-weight: 600; font-size: 32px; letter-spacing: 1px; color: #fff; text-decoration: none; text-transform: uppercase; }
        main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 48px 16px; }
        .box { max-width: 640px; text-align: center; }
        .code { font-family: "Teko", sans-serif; font-weight: 600; font-size: clamp(96px, 22vw, 180px); line-height: .85; color: var(--primary); margin: 0 0 12px; }
        h1 { font-family: "Teko", sans-serif; font-weight: 500; font-size: clamp(32px, 6vw, 48px); line-height: 1.05; text-transform: uppercase; margin: 0 0 16px; }
        p { font-size: 18px; line-height: 1.6; color: var(--muted); margin: 0 0 32px; }
        .actions { display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; }
        .btn { display: inline-block; padding: 0 40px; height: 56px; line-height: 60px; border-radius: 8px; font-family: "Teko", sans-serif; font-size: 18px; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; }
        .btn-primary { background: var(--primary); color: var(--ink); }
        .btn-dark { background: var(--ink); color: #fff; }
        .help { margin-top: 32px; font-size: 15px; color: var(--muted); }
        .help a { color: var(--ink); }
    </style>
</head>
<body>
    <header>
        <a href="/{{ $errLocale }}" class="brand">
            @if ($errLogo)
                <img src="{{ $errLogo }}" alt="Translock IT">
            @else
                Translock IT
            @endif
        </a>
    </header>
    <main>
        <div class="box">
            <p class="code">500</p>
            <h1>{{ __('errors.500.heading') }}</h1>
            <p>{{ __('errors.500.text') }}</p>
            <div class="actions">
                <a class="btn btn-primary" href="javascript:location.reload()">{{ __('errors.retry') }}</a>
                <a class="btn btn-dark" href="/{{ $errLocale }}">{{ __('errors.home') }}</a>
            </div>
            <p class="help">{{ __('errors.help') }} <a href="mailto:info@translockit.com">info@translockit.com</a></p>
        </div>
    </main>
</body>
</html>
