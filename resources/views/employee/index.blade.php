<x-layouts.app>
    @if (session('status'))
    <div role="alert" class="relative mt-3 ml-3 flex max-w-full px-4 py-4 text-base text-white bg-gray-900 rounded-lg font-regular"
        data-dismissible="alert">
        <div class="mr-12 "><i class="fa-solid fa-circle-check mr-2"></i> {{ session('status') }}</div>
        <button data-dismissible-target="alert"
            class="!absolute  top-3 right-3 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-white transition-all hover:bg-white/10 active:bg-white/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
    </div>
    @endif
    <div class="relative flex flex-col h-full mt-3 ml-3 text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between gap-8 mb-4">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Employees List
                    </h5>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <a href="{{ route('employees.create') }}"
                        class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        <i class="fa-solid fa-user-plus"></i>
                        Add employee
                    </a>
                </div>
            </div>
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <div class="w-full md:w-72">
                    <div class="relative h-10 w-full min-w-[200px]">
                        <div
                            class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Search
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-2 px-0 overflow-x-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Member
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Position
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Join date
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Actions
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $employee->first_name . ' ' . $employee->last_name }}
                                            {{ $employee->nick_name ? '(' . $employee->nick_name . ')' : '' }}
                                            {!! $employee->gender == 'Male'
                                                ? '<i class="text-blue-500 fa-solid fa-mars"></i>'
                                                : '<i class="text-pink-500 fa-solid fa-venus"></i>' !!}
                                        </p>
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                            #{{ $employee->employee_id }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $employee->position }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $employee->join_date }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50 flex">
                                <a href="{{ route('employees.edit', $employee->employee_id) }}"
                                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 hover:text-blue-500 active:bg-gray-900/20"
                                    type="button">
                                    <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <i class="fa-solid fa-pen"></i>
                                    </span>
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 hover:text-red-500 active:bg-gray-900/20"
                                        type="submit">
                                        <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                            <i class="fa-solid fa-eraser"></i>
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                Total Employees : {{ $employees->count() }}
            </p>
        </div>
    </div>
</x-layouts.app>
