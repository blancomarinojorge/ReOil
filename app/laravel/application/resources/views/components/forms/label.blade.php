@props(['label','name','required' => false])
<label for="{{ $name }}">
    {{ $label }}
    @if($required)
        <span class="text-error/90">*</span>
    @endif
</label>

