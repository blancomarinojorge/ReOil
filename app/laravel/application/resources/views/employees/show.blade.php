<x-layout>
    <x-global.top-bar :title="__('Employee info')" :breadcrumbs-items="[
        ['label'=>__('Employees'), 'href'=>route('employees.index')],
        ['label'=>$user->name]
    ]">
        @can('update', $user)
            <div class="flex items-center">
                <x-link-button href="{{ route('employees.edit', $user->id) }}" icon-name="edit">{{ __('Edit user') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="p-4">
        <div class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <div class="flex gap-6 items-center">
                <div class="w-30 h-30 rounded-full bg-secondary-soft flex items-center justify-center overflow-hidden">
                    @if(true)
                        <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" alt="Your photo" class="object-cover h-full w-full">
                    @else
                        <x-global.icons.svg-camera class="w-6"/>
                    @endif
                </div>
                <h4 class="text-xl">{{ $user->name }}</h4>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Personal data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" disabled value="{{ $user->name }}" />
                    <x-forms.input :label="__('first surname')" name="surname_1" disabled value="{{ $user->surname_1 }}" />
                    <x-forms.input :label="__('second surname')" name="surname_2" value="{{ $user->surname_2 }}" disabled/>
                    <x-forms.input :label="__('phone')" name="phone" value="{{ $user->phone }}" disabled/>
                    <x-forms.input :label="__('dni')" name="dni" value="{{ $user->dni }}" disabled/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Company profile') }}</x-global.top-bar.page-title>
                <x-forms.separator class="mt-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('company phone')" name="company_phone"  disabled value="{{ $user->company_phone }}"/>
                    <x-forms.input :label="__('email')" name="email" disabled value="{{ $user->email }}"/>
                    <x-forms.field :label="__('role')" name="role">
                        @if($user->role)
                            <x-global.role-tag :role="$user->role"/>
                        @endif
                    </x-forms.field>
                </div>
            </div>
        </div>
    </article>
</x-layout>
