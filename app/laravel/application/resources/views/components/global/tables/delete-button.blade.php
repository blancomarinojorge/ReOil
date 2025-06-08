@props(['action', 'value', 'name' => 'id', 'title' => __('Delete')])
<x-forms.form action="{{ $action }}" method="DELETE" class="flex items-center">
    <input type="hidden" value="{{ $value }}" name="{{ $name }}"/>
    <button title="{{ $title }}" aria-label="{{ $title }}" class="p-1 rounded text-error/80 hover:text-error hover:cursor-pointer">
        <x-global.icons.svg-delete class="w-7"/>
    </button>
</x-forms.form>
