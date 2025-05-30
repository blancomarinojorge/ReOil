@props(['label', 'name','required'])

@php
$default = [
    'type' => 'text',
    'id' => $name,
    'name' => $name,
    'value' => old($name),
    'class' => "border-1 py-3 px-5 focus:outline-none border-tertiary/40 focus:border-tertiary/70"
];
@endphp

<x-forms.field :$name :$label :$required>
    <input {{ $attributes($default) }}>
</x-forms.field>
