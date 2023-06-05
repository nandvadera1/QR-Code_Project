@inject('navbarItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\NavbarItemHelper')

@if ($navbarItemHelper->isSubmenu($item))

    {{-- Dropdown submenu --}}
    @include('adminlte::components.partials.navbar.dropdown-item-submenu')

@elseif ($navbarItemHelper->isLink($item))

    {{-- Dropdown link --}}
    @include('adminlte::components.partials.navbar.dropdown-item-link')

@endif
