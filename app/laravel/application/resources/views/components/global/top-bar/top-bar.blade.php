@props(['breadcrumbs-items', 'title'])
<section class="flex justify-between border-b border-b-muted px-5 pt-3 pb-5">
    <x-global.top-bar.title-breadcrumbs-container>
        <x-global.top-bar.breadcrumbs :items="$breadcrumbsItems"/>
        <x-global.top-bar.page-title>{{ $title }}</x-global.top-bar.page-title>
    </x-global.top-bar.title-breadcrumbs-container>
    {{ $slot }} <!-- right side content -->
</section>
