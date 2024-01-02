<x-layouts.app>
    <div class="relative flex flex-col h-full mt-3 ml-3 p-4 text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative  overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between gap-8 mb-4">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Add {{ $attendance->employee->first_name . ' ' . $attendance->employee->last_name }} #{{ $attendance->employee->employee_id }}
                        attendance
                    </h5>
                </div>
            </div>
            <form action="{{ route('attendances.detail.update', ['employee' => $attendance->employee->employee_id, 'attendance' => $attendance]) }}" method="post"
                class="flex flex-col gap-3">
                @csrf
                @method('put')
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('Attendance Date')" name="attendance_date" type="date"
                            value="{{ $attendance->attendance_date }}" required />
                        @error('attendance_date')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center p-3 rounded-full cursor-pointer" htmlFor="check">
                            <input type="checkbox" name="leave"
                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                id="leave" onclick="isLeave()" />
                            <span
                                class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor" stroke="currentColor" stroke-width="1">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </label>
                        <label class="mt-px font-semibold text-red-500 cursor-pointer select-none" htmlFor="check">
                            Leave
                        </label>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('Time In')" name="time_in" type="time" value="{{ $attendance->time_in }}" id="time_in" />
                        @error('time_in')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Time Out')" name="time_out" type="time" value="{{ $attendance->time_out }}" id="time_out"/>
                        @error('time_out')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('Break Time Start')" name="break_time_start" type="time"
                            value="{{ $attendance->break_time_start }}" id="break_time_start"/>
                        @error('break_time_start')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Break Time End')" name="break_time_end" type="time"
                            value="{{ $attendance->break_time_end }}" id="break_time_end" />
                        @error('break_time_end')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-full"
                    type="button">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <x-slot:js>
        <script type="text/javascript">
        function isLeave() {
            let leave = document.getElementById("leave");

            if (leave.checked){
                document.getElementById('time_in').setAttribute('disabled' ,'true');
                document.getElementById('time_out').setAttribute('disabled' ,'true');
                document.getElementById('break_time_start').setAttribute('disabled' ,'true');
                document.getElementById('break_time_end').setAttribute('disabled' ,'true');
            } else {
                document.getElementById('time_in').removeAttribute('disabled');
                document.getElementById('time_out').removeAttribute('disabled');
                document.getElementById('break_time_start').removeAttribute('disabled');
                document.getElementById('break_time_end').removeAttribute('disabled');
            }
        }
        </script>
    </x-slot:js>
</x-layouts.app>
