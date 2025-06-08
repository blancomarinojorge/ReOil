<x-layout>
    <x-global.top-bar :title="__('Employees')" :breadcrumbs-items="[
        ['label'=>__('Employees'), 'href'=>route('home')],
    ]">
        @can('create', \App\Models\User::class)
            <div class="flex items-center">
                <x-link-button href="{{ route('employees.create') }}" icon-name="add-user">{{ __('New Employee') }}</x-link-button>
            </div>
        @endcan
    </x-global.top-bar>
    <article class="mb-4">
        <div class="overflow-x-scroll max-w-full mb-3">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <x-global.tables.table-head>User</x-global.tables.table-head>
                    <x-global.tables.table-head>Email</x-global.tables.table-head>
                    <x-global.tables.table-head>Dni</x-global.tables.table-head>
                    <x-global.tables.table-head>Rol</x-global.tables.table-head>
                    <x-global.tables.table-head>Fecha creación</x-global.tables.table-head>
                    <x-global.tables.table-head class="text-end">{{ __('Actions') }}</x-global.tables.table-head>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach($users as $user)
                        <x-global.tables.table-data-row>
                            <x-global.tables.table-data>
                                <div class="flex gap-3 items-center">
                                    <div class="w-8">
                                        <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ Auth::user()->name }}" alt="Your photo" class="object-cover h-full w-full">
                                    </div>
                                    {{ $user->name }} {{ $user->surname_1 }} {{ $user->surname_2 }}
                                </div>
                            </x-global.tables.table-data>
                            <x-global.tables.table-data>{{ $user->email }}</x-global.tables.table-data>
                            <x-global.tables.table-data class="{{ $user->dni ? '' : 'text-muted' }}">{{ $user->dni ?? 'vacío' }}</x-global.tables.table-data>
                            <x-global.tables.table-data>
                                <x-global.role-tag :role="$user->role"/>
                            </x-global.tables.table-data>
                            <x-global.tables.table-data>{{ $user->created_at }}</x-global.tables.table-data>
                            <x-global.tables.table-data>
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('employees.show', $user->id) }}" class="text-tertiary/70 hover:text-tertiary">
                                        <x-global.icons.svg-user-data class="w-7"/>
                                    </a>
                                    @can('delete', $user)
                                        <x-global.tables.delete-button action="{{ route('employees.destroy', $user->id) }}" :value="$user->id"/>
                                    @endcan
                                </div>
                            </x-global.tables.table-data>
                        </x-global.tables.table-data-row>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5">
            {{ $users->links() }}
        </div>
    </article>
</x-layout>
