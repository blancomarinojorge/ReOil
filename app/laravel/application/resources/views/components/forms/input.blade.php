@props(['label', 'name','required' => false, 'placeholder' => '', 'value' => null])

@php
$default = [
    'type' => 'text',
    'id' => $name,
    'name' => $name,
    'value' => $value ?? old($name),
    'placeholder' => $placeholder,
    'class' => "border-1 py-3 px-5 focus:outline-none border-tertiary/40 focus:border-tertiary/70 disabled:bg-tertiary/15"
];
@endphp

<x-forms.field :$name :$label :$required>
    <input {{ $attributes($default) }}>
</x-forms.field>
