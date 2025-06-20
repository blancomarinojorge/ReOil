@can('viewAny', \App\Models\Route::class)
    <x-global.navbar.nav-item href="{{ route('routes.index') }}" :label="__('Routes')" icon-name="route"/>
@endcan
@can('viewAny', \App\Models\Client::class)
<x-global.navbar.nav-item href="{{ route('clients.index') }}" :label="__('Clients')" icon-name="clients"/>
@endcan
@can('viewAny', \App\Models\Residue::class)
<x-global.navbar.nav-item href="{{ route('residues.index') }}" :label="__('Residues')" icon-name="unit-liters"/>
@endcan
@can('viewAny', \App\Models\User::class)
<x-global.navbar.nav-item href="{{ route('employees.index') }}" :label="__('Employees')" icon-name="employees"/>
@endcan
@can('viewAny', \App\Models\Truck::class)
<x-global.navbar.nav-item href="{{ route('trucks.index') }}" :label="__('Trucks')" icon-name="trucks"/>
@endcan
@can('viewAny', \App\Models\ContainerType::class)
<x-global.navbar.nav-item href="{{ route('container_types.index') }}" :label="__('Container types')" icon-name="company"/>
@endcan
@can('viewAny', \App\Models\Container::class)
<x-global.navbar.nav-item href="{{ route('containers.index') }}" :label="__('Clients containers')" icon-name="unit-piece"/>
@endcan

@if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\Auth\Role::Admin)
    <x-global.navbar.nav-item href="{{ route('company.show') }}" :label="__('My company')" icon-name="company"/>
@endif




