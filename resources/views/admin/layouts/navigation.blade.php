@isset($menus)
<ul class="menu pt-2 w-80 bg-base-100 text-base-content min-h-full">
    <label for="drawer" class="btn btn-ghost bg-base-300 btn-circle z-50 top-0 right-0 mt-2 mr-2 absolute lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 inline-block w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
    </label>
    <li class="mb-2 font-semibold text-xl">
        <a href="{{ route('admin.dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current" />Admin Panel
        </a>
    </li>

    <!-- Static menu data -->
   
    <li>
        <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
            <span class="inline-flex justify-center items-center">
                <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                    <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z"></path>
                </svg>
            </span>
            Dashboard
        </a>
        <ul class="bg-base-100 p-2"></ul>
    </li>

    <li>
        <a href="/admin/user" class="{{ request()->is('admin/user') ? 'active' : '' }}">
            <span class="inline-flex justify-center items-center">
                <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                    <path fill="currentColor" d="M16 17V19H2V17S2 13 9 13 16 17 16 17M12.5 7.5A3.5 3.5 0 1 0 9 11A3.5 3.5 0 0 0 12.5 7.5M15.94 13A5.32 5.32 0 0 1 18 17V19H22V17S22 13.37 15.94 13M15 4A3.39 3.39 0 0 0 13.07 4.59A5 5 0 0 1 13.07 10.41A3.39 3.39 0 0 0 15 11A3.5 3.5 0 0 0 15 4Z"></path>
                </svg>
            </span>
            Users
        </a>
        <ul class="bg-base-100 p-2"></ul>
    </li>

    <li>
        <a href="/admin/payment" class="{{ request()->is('admin/payment') ? 'active' : '' }}">
            <span class="inline-flex justify-center items-center">
                <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                    <path fill="currentColor" d="M21 7H3V5H21V7M21 17H3V9H21V17M19 14A1 1 0 1 0 17 14A1 1 0 0 0 19 14Z"></path>
                </svg>
            </span>
            Payment
        </a>
        <ul class="bg-base-100 p-2"></ul>
    </li>
</ul>
@endisset
