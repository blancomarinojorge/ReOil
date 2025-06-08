@props(['method'=>'GET'])
<form @if($method != 'GET') method="POST" @endif {{ $attributes }}>
    @if($method !== 'GET')
        @csrf
        @method($method)
    @endif
    {{ $slot }}
</form>
