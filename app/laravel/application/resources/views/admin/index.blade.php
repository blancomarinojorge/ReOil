<x-layout>
    <x-global.top-bar :title="__('Employees')" :breadcrumbs-items="[
        ['label'=>__('Employees'), 'href'=>route('home')],
        ['label'=>'ola']
    ]">
        <div class="flex items-center">
            <x-link-button href="#" icon-name="plus">{{ __('New Employee') }}</x-link-button>
        </div>
    </x-global.top-bar>
    <article>
        <div class="overflow-x-scroll max-w-full">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 mt-10">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-start font-medium text-gray-500 uppercase dark:text-neutral-500">User</th>
                    <th scope="col" class="px-6 py-3 text-start font-medium text-gray-500 uppercase dark:text-neutral-500">Id</th>
                    <th scope="col" class="px-6 py-3 text-start font-medium text-gray-500 uppercase dark:text-neutral-500">Dni</th>
                    <th scope="col" class="px-6 py-3 text-start font-medium text-gray-500 uppercase dark:text-neutral-500">Rol</th>
                    <th scope="col" class="px-6 py-3 text-start font-medium text-gray-500 uppercase dark:text-neutral-500">Fecha creación</th>
                    <th scope="col" class="px-6 py-3 text-end font-medium text-gray-500 uppercase dark:text-neutral-500">Accions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    <tr onclick="window.location.href='{{ "/" }}';" class="hover:bg-secondary-soft/80 hover:cursor-pointer">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 flex gap-3 items-center">
                            <div class="w-8">
                                <img src="{{ Vite::asset('resources/img/user-photos/1.png') }}" title="{{ Auth::user()->name }}" alt="Your photo" class="object-cover h-full w-full">
                            </div>
                            Jorge Blanco Mariño
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 ">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 ">49558392F</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 ">Administrador</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 ">2025-05-27 19:06:21</td>
                        <td class="px-6 py-4 whitespace-nowrap text-end">
                            <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-error/70 hover:text-error hover:cursor-pointer focus:outline-hidden focus:text-error disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </article>
</x-layout>
