@aware(['component'])
@props(['column' => null, 'customAttributes' => []])

@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <td {{ $attributes->merge($customAttributes)->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $customAttributes['default'] ?? true])->class(['hidden sm:table-cell' => $column && $column->shouldCollapseOnMobile()])->class(['hidden md:table-cell' => $column && $column->shouldCollapseOnTablet()])->except('default') }}>{{ $slot }}</td>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <td {{ $attributes->merge($customAttributes)->class(['align-middle text-center text-nowrap border border-right-0 border-left-0 bg-light' => $customAttributes['default'] ?? true])->class(['d-none d-sm-table-cell' => $column && $column->shouldCollapseOnMobile()])->class(['d-none d-md-table-cell' => $column && $column->shouldCollapseOnTablet()])->except('default') }}>{{ $slot }}</td>
@endif
