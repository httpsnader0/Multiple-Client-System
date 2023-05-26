<div class="menu-item px-3">
    <a href="{{ route($route, $id) }}" class="btn btn-icon btn-active-color-danger w-100 menu-link px-5 py-5 d-flex justify-content-start align-items-center fs-7 text-nowrap">
        <span class="svg-icon svg-icon-muted svg-icon-7 me-3">
            {!! $icon !!}
        </span>
        {{ $title }}
    </a>
</div>
