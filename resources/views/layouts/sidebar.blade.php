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
            Employee
        </a>
        <div role="button"
            class="flex items-center w-full px-6 py-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
            <div class="grid mr-4 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            Log Out
        </div>
    </nav>
</div>
