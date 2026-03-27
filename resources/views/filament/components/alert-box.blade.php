@php
    $colors = [
        'success' => [
            'bg'     => 'bg-green-50 dark:bg-green-950',
            'border' => 'border-green-400 dark:border-green-600',
            'icon'   => 'text-green-500 dark:text-green-400',
            'title'  => 'text-green-800 dark:text-green-200',
            'text'   => 'text-green-700 dark:text-green-300',
            'icon_name' => 'check-circle',
        ],
        'danger' => [
            'bg'     => 'bg-red-50 dark:bg-red-950',
            'border' => 'border-red-400 dark:border-red-600',
            'icon'   => 'text-red-500 dark:text-red-400',
            'title'  => 'text-red-800 dark:text-red-200',
            'text'   => 'text-red-700 dark:text-red-300',
            'icon_name' => 'x-circle',
        ],
        'warning' => [
            'bg'     => 'bg-amber-50 dark:bg-amber-950',
            'border' => 'border-amber-400 dark:border-amber-600',
            'icon'   => 'text-amber-500 dark:text-amber-400',
            'title'  => 'text-amber-800 dark:text-amber-200',
            'text'   => 'text-amber-700 dark:text-amber-300',
            'icon_name' => 'exclamation-triangle',
        ],
        'info' => [
            'bg'     => 'bg-blue-50 dark:bg-blue-950',
            'border' => 'border-blue-400 dark:border-blue-600',
            'icon'   => 'text-blue-500 dark:text-blue-400',
            'title'  => 'text-blue-800 dark:text-blue-200',
            'text'   => 'text-blue-700 dark:text-blue-300',
            'icon_name' => 'information-circle',
        ],
    ];

    $c     = $colors[$type ?? 'info'];
    $style = $style ?? 'modern'; // banner | bordered | modern | minimal
@endphp

@if ($style === 'banner')
    {{-- Style 1: Simple Banner --}}
    <div class="mx-4 mb-3 flex items-center gap-3 rounded-lg border-l-4 px-4 py-3 {{ $c['bg'] }} {{ $c['border'] }}"
         x-data="{ show: true }" x-show="show" x-transition>
        <x-heroicon-o-{{ $c['icon_name'] }} class="h-5 w-5 shrink-0 {{ $c['icon'] }}" />
        <div class="flex-1">
            @if (!empty($title))
                <p class="text-sm font-semibold {{ $c['title'] }}">{{ $title }}</p>
            @endif
            @if (!empty($message))
                <p class="text-sm {{ $c['text'] }}">{{ $message }}</p>
            @endif
        </div>
        @if ($closeable ?? true)
            <button @click="show = false" class="{{ $c['icon'] }} hover:opacity-70">
                <x-heroicon-o-x-mark class="h-4 w-4" />
            </button>
        @endif
    </div>

@elseif ($style === 'bordered')
    {{-- Style 2: Card with Border --}}
    <div class="mx-4 mb-3 rounded-xl border-2 px-5 py-4 shadow-sm {{ $c['bg'] }} {{ $c['border'] }}"
         x-data="{ show: true }" x-show="show" x-transition>
        <div class="flex items-start gap-3">
            <x-heroicon-o-{{ $c['icon_name'] }} class="h-6 w-6 shrink-0 {{ $c['icon'] }}" />
            <div class="flex-1">
                @if (!empty($title))
                    <p class="font-semibold {{ $c['title'] }}">{{ $title }}</p>
                @endif
                @if (!empty($message))
                    <p class="mt-1 text-sm {{ $c['text'] }}">{{ $message }}</p>
                @endif
            </div>
            @if ($closeable ?? true)
                <button @click="show = false" class="{{ $c['icon'] }} hover:opacity-70">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            @endif
        </div>
    </div>

@elseif ($style === 'modern')
    {{-- Style 3: Modern Card --}}
    <div class="mx-4 mb-3 overflow-hidden rounded-2xl shadow-md {{ $c['bg'] }}"
         x-data="{ show: true }" x-show="show" x-transition>
        <div class="h-1 w-full {{ $c['border'] }} bg-current opacity-60"></div>
        <div class="flex items-start gap-4 px-5 py-4">
            <div class="rounded-full p-2 {{ $c['border'] }} border {{ $c['bg'] }}">
                <x-heroicon-o-{{ $c['icon_name'] }} class="h-6 w-6 {{ $c['icon'] }}" />
            </div>
            <div class="flex-1">
                @if (!empty($title))
                    <p class="font-bold {{ $c['title'] }}">{{ $title }}</p>
                @endif
                @if (!empty($message))
                    <p class="mt-0.5 text-sm {{ $c['text'] }}">{{ $message }}</p>
                @endif
            </div>
            @if ($closeable ?? true)
                <button @click="show = false" class="{{ $c['icon'] }} hover:opacity-70 mt-0.5">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            @endif
        </div>
    </div>

@else
    {{-- Style 4: Minimalist --}}
    <div class="mx-4 mb-2 flex items-center gap-2 rounded-lg px-3 py-2 text-sm {{ $c['bg'] }}"
         x-data="{ show: true }" x-show="show" x-transition>
        <x-heroicon-o-{{ $c['icon_name'] }} class="h-4 w-4 shrink-0 {{ $c['icon'] }}" />
        <span class="{{ $c['text'] }}">
            @if (!empty($title))<strong>{{ $title }}</strong>@endif
            @if (!empty($message)) {{ $message }}@endif
        </span>
        @if ($closeable ?? true)
            <button @click="show = false" class="{{ $c['icon'] }} ml-auto hover:opacity-70">
                <x-heroicon-o-x-mark class="h-3.5 w-3.5" />
            </button>
        @endif
    </div>
@endif
