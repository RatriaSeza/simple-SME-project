<x-layouts.app>
    <div class="relative flex flex-col h-full mt-3 ml-3 text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between gap-8 mb-4">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Attendances
                    </h5>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <form action="{{ route('export') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employees" value="{{ $employees }}">
                        <input type="hidden" name="export_month" value="{{ request()->input('month', $currentMonth) }}">
                        <input type="hidden" name="export_year" value="{{ request()->input('year', $currentYear) }}">
                        <button type="submit"
                            class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <i class="fa-solid fa-file-excel"></i>
                            Generate Excel
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <form action="{{ route('attendances') }}" method="get">
                    <div class="flex items-center gap-4 md:flex-row">
                        <div class="relative h-10 w-72 min-w-[200px]">
                            <select name="month"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                <option value="01" {{ request()->input('month', $currentMonth) == '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ request()->input('month', $currentMonth) == '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ request()->input('month', $currentMonth) == '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ request()->input('month', $currentMonth) == '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ request()->input('month', $currentMonth) == '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ request()->input('month', $currentMonth) == '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ request()->input('month', $currentMonth) == '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ request()->input('month', $currentMonth) == '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ request()->input('month', $currentMonth) == '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request()->input('month', $currentMonth) == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ request()->input('month', $currentMonth) == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request()->input('month', $currentMonth) == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Select Month
                            </label>
                        </div>
                        <div class="relative h-10 w-72 min-w-[200px]">
                            <x-forms.input :label="__('Year')" name="year" value="{{ request()->input('year', $currentYear) }}" />
                        </div>
                        <button
                            class="select-none rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-semibold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="submit">
                            Filter
                        </button>
                    </div>
                </form>
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
                                class="block font-sans text-sm antialiased font-normal text-center leading-none text-blue-gray-900 opacity-70">
                                Total Working Days
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal text-center leading-none text-blue-gray-900 opacity-70">
                                Total Working Hours
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p
                                class="block font-sans text-sm antialiased font-normal text-center leading-none text-blue-gray-900 opacity-70">
                                Actions
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr class="@if ($loop->even) bg-blue-gray-50/50 @endif">
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-500">
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
                                    class="block font-sans text-sm antialiased font-normal text-center leading-normal text-blue-gray-900">
                                    {{ $employee->total_working_days }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal text-center leading-normal text-blue-gray-900">
                                    {{ $employee->attendances_sum_working_hours }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <a href="{{ route('attendances.detail', [$employee->employee_id, 'month' => request()->input('month', $currentMonth), 'year' => request()->input('year', $currentYear)]) }}"
                                    class="select-none rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-semibold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Detail
                                </a>
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
