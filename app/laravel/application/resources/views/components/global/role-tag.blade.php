@props(['role'])

@php
    $class = "flex rounded-sm items-center justify-center py-2 px-5 w-fit text-sm ";

    $class.= match ($role){
        \App\Enums\Auth\Role::Admin => "bg-admin/10 border border-admin/80 text-admin/80",
        \App\Enums\Auth\Role::Driver => "bg-driver/10 border border-driver/80 text-driver/80",
        \App\Enums\Auth\Role::OfficeStaff => "bg-office/10 border border-office/80 text-office/80"
    }
@endphp

<span {{ $attributes->twMerge(['class' => $class]) }}>
    {{ $role->label() }}
</span>
