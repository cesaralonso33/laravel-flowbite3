@props(['valor'=>1])


@php
    $classes="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white";
@endphp

@if ($valor===1)
    <x-heroicon-s-building-office {{ $attributes->merge(['class' => $classes]) }} />
@endif

@if ($valor===2)
    <x-heroicon-s-key {{ $attributes->merge(['class' => $classes]) }} />
@endif
@if ($valor===3)
    <x-heroicon-s-academic-cap {{ $attributes->merge(['class' => $classes]) }} />
@endif



@if ($valor===4)
    <x-heroicon-s-credit-card {{ $attributes->merge(['class' => $classes]) }} />
@endif

@if ($valor===5)
    <x-heroicon-s-users {{ $attributes->merge(['class' => $classes]) }} />
@endif

@if ($valor===6)
    <x-heroicon-s-cog-6-tooth {{ $attributes->merge(['class' => $classes]) }} />
@endif

@if ($valor===7)
    <x-heroicon-s-inbox-arrow-down {{ $attributes->merge(['class' => $classes]) }} />
@endif
@if ($valor===8)
    <x-heroicon-s-scale {{ $attributes->merge(['class' => $classes]) }} />
@endif
@if ($valor===9)
    <x-heroicon-s-archive-box {{ $attributes->merge(['class' => $classes]) }} />
@endif


@if ($valor===10)
    <x-heroicon-s-table-cells {{ $attributes->merge(['class' => $classes]) }} />
@endif


