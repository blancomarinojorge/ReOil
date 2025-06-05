<nav id="nav-bar" class="top-[var(--header-height)] flex flex-col  h-[calc(100vh-var(--header-height))] w-70 py-6 px-4 sticky bg-tertiary/5">
    <div class="border-b border-b-muted py-2 px-3 text-muted">
        {{ __(Auth::user()->role->label()) }}
    </div>
    <div class="px-3 pt-4 grow">
        <x-global.navbar.admin-nav-items/>
    </div>
    <div class="text-center">
        <h4 class="text-xl text-tertiary/80">Ingaroil SL</h4>
    </div>
</nav>
