@props(['class' => 'h-9 w-9'])

<svg
    viewBox="0 0 32 32"
    fill="none"
    role="img"
    aria-label="{{ config('app.name', 'Nirbhay Dhaked') }}"
    {{ $attributes->merge(['class' => $class . ' shrink-0']) }}
>
    <defs>
        <linearGradient id="logo-mark-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#1e293b;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#0f172a;stop-opacity:1" />
        </linearGradient>
    </defs>
    <rect width="32" height="32" rx="6" fill="url(#logo-mark-gradient)" />
    <text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-weight="bold" font-size="14">ND</text>
    <rect x="0.5" y="0.5" width="31" height="31" rx="5.5" stroke="rgba(255,255,255,0.1)" />
</svg>
