@props(['label', 'name','required' => false, 'placeholder' => '', 'value' => null])

@php
$default = [
    'type' => 'text',
    'id' => $name,
    'name' => $name,
    'value' => old($name, $value),
    'placeholder' => $placeholder,
    'class' => "border-1 py-3 px-5 focus:outline-none border-tertiary/40 focus:border-tertiary/70 disabled:bg-tertiary/15"
];
@endphp

<x-forms.field :$name :$label :$required {{ $attributes->twMerge(['class' => '']) }}>
    <input {{ $attributes($default) }}>
</x-forms.field>
