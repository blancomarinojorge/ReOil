<x-layout>
    <x-global.top-bar :title="__('New Employee')" :breadcrumbs-items="[
        ['label'=>__('Employees'), 'href'=>route('employees.index')],
        ['label'=>__('New Employee')]
    ]">
    </x-global.top-bar>
    <article class="p-4">
        <x-forms.form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="flex flex-col max-w-300 gap-8 lg:mx-auto my-15 mx-5">
            <label for="dropdown-file" class="relative w-30 h-30 opacity-85 rounded-full bg-secondary-soft flex items-center justify-center hover:cursor-pointer hover:opacity-70 overflow-hidden" title="{{ __("Add profile photo") }}">
                <img id="profile-photo-preview" src="" alt="" class="object-cover h-full w-full absolute z-[-1] hidden">
                <x-global.icons.svg-camera class="w-6"/>
                <input type="file" id="dropdown-file" name="photo" class="hidden">
            </label>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Personal data') }}</x-global.top-bar.page-title>
                <x-forms.separator class="my-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('name')" name="name" :required="true"/>
                    <x-forms.input :label="__('first surname')" name="surname_1" :required="true"/>
                    <x-forms.input :label="__('second surname')" name="surname_2"/>
                    <x-forms.input :label="__('phone')" name="phone" placeholder="6843829..."/>
                    <x-forms.input :label="__('dni')" name="dni"/>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-global.top-bar.page-title class="text-xl">{{ __('Company profile') }}</x-global.top-bar.page-title>
                <x-forms.separator class="mt-2"/>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                    <x-forms.input :label="__('company phone')" name="company_phone" placeholder="6843829..."/>
                    <x-forms.input :label="__('email')" name="email" required="true" placeholder="juan.company@gmail.com"/>
                    <x-forms.field :label="__('role')" name="role" :required="true">
                        <select class="py-3 pl-5 border-1 border-tertiary/40 focus:border-tertiary/70" name="role" id="role">
                            <option value="">{{ __('Select a role...') }}</option>
                            @foreach(\App\Enums\Auth\Role::cases() as $roleOption)
                                <option value="{{ $roleOption->value }}" @if(old('role') == $roleOption->value) selected @endif>{{ __($roleOption->label()) }}</option>
                            @endforeach
                        </select>
                    </x-forms.field>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <x-link-button href="{{ route('employees.index') }}" type="secondary">{{ __('Cancel') }}</x-link-button>
                <x-forms.button class="px-10">{{ __('Save') }}</x-forms.button>
            </div>
        </x-forms.form>
    </article>
    <script>
        document.getElementById('dropdown-file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('profile-photo-preview');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        });
    </script>
</x-layout>
