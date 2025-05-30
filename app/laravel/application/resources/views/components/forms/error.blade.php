@props(['name'])

@error($name)
    <span {{ $attributes(["class" => "text-xs text-error/90"]) }}>
        {{ $message }}
    </span>
@enderror
