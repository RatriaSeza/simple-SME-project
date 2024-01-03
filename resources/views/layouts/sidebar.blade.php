<div
    class="sticky top-0 flex h-[100vh] w-full max-w-[17rem] flex-col bg-white bg-clip-border text-gray-700 shadow-xl shadow-blue-gray-900/5">
    <div class="p-4 mb-2 bg-gray-900  shadow-sm">
        <h5 class="py-[2px] block font-poppins text-xl antialiased font-semibold leading-snug text-center tracking-normal text-gray-100">
            SME
        </h5>
    </div>
    <nav class="flex min-w-[240px] flex-col gap-1 p-4 font-poppins text-base font-medium text-blue-gray-700">
        <a href="{{ route('employees.index') }}"
            class="flex items-center w-full px-6 py-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900  {{ request()->is('employees') ? 'bg-gray-900 text-white' : '' }}">
            <div class="grid mr-4 place-items-center">
                <i class="fa-solid fa-users"></i>
            </div>
            Employees
        </a>
        <a href="{{ route('attendances') }}"
            class="flex items-center w-full px-6 py-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900  {{ request()->is('attendances') ? 'bg-gray-900 text-white' : '' }}">
            <div class="grid mr-4 place-items-center">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            Attendances
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-6 py-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                <div class="grid mr-4 place-items-center">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                Log Out
            </button>
        </form>
    </nav>
</div>
