@php
    // TODO multilevel!
    $navItems = Modules\CMS\App\Models\Navigator::find(1)->items;
@endphp
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-globe-europe"></i> W-App111</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($navItems as $navItem)
                    @if ($navItem->children->isEmpty() && $navItem->parent_id === 0)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $navItem->url }}"
                                target="{{ $navItem->target }}">{{ $navItem->name }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            @if ($navItem->parent_id == 0)
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $navItem->name }}
                                </a>
                            @endif
                            <ul class="dropdown-menu">
                                @foreach ($navItem->children as $childItem)
                                    <li><a class="dropdown-item" href="{{ $childItem->url }}"
                                            target="{{ $childItem->target }}">{{ $childItem->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</nav>
