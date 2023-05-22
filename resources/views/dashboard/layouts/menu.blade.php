<div class="menu-item">
    <a href="{{ route('dashboard.index') }}" class="menu-link @if (checkActive('dashboard.index')) active @endif">
        <span class="menu-icon">
            <i class="bi bi-list"></i>
        </span>
        <span class="menu-title">@lang('Home Page')</span>
    </a>
</div>

@foreach ($menu as $title => $allMenu)
    @canany(collect($allMenu)->map(function ($value, $key) {
        return Arr::exists($value, 'permissions') ? $value['permissions'] : '';
        })->toArray())
        <div class="menu-item mt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">@lang($title)</span>
            </div>
        </div>
    @endcanany
    @foreach ($allMenu as $currentMenu)
        @if (arrayCheck($currentMenu))
            @canany(collect($currentMenu)->map(function ($value, $key) {
                return Arr::exists($value, 'permissions') ? $value['permissions'] : '';
                })->toArray())
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (checkActiveMulti($currentMenu[0]['active'])) here show @endif">
                    <span class="menu-link">
                        <span class="menu-icon"><i class="{{ $currentMenu[0]['icon'] }}"></i></span>
                        <span class="menu-title">@lang($currentMenu[0]['title'])</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            @foreach ($currentMenu as $currentMenu)
                                @if (!$loop->first)
                                    @can($currentMenu['permissions'])
                                        <div class="menu-item">
                                            <a href="{{ $currentMenu['route'] }}" class="menu-link @if (checkActive($currentMenu['active'])) active @endif">
                                                <span class="menu-icon"><i class="{{ $currentMenu['icon'] }} fs-10"></i></span>
                                                <span class="menu-title">{{ $currentMenu['title'] }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endcanany
        @else
            @can($currentMenu['permissions'])
                <div class="menu-item">
                    <a href="{{ $currentMenu['route'] }}" class="menu-link @if (checkActive($currentMenu['active'])) active @endif">
                        <span class="menu-icon"><i class="{{ $currentMenu['icon'] }}"></i></span>
                        <span class="menu-title">{{ $currentMenu['title'] }}</span>
                    </a>
                </div>
            @endcan
        @endif
    @endforeach
@endforeach
