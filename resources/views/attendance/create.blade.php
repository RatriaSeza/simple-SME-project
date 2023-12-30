<x-layouts.app>
    <div class="relative flex flex-col h-full mt-3 ml-3 p-4 text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative  overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between gap-8 mb-4">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Add {{ $employee->first_name . ' ' . $employee->last_name }} #{{ $employee->employee_id }}
                        attendance
                    </h5>
                </div>
            </div>
            <form action="{{ route('attendances.detail.store', $employee->employee_id) }}" method="post" class="flex flex-col gap-3">
                @csrf
                <div>
                    <x-forms.input :label="__('Attendance Date')" name="attendance_date" type="date"
                        value="{{ old('attendance_date') }}" required />
                    @error('attendance_date')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('Time In')" name="time_in" type="time"
                            value="{{ old('time_in') }}" />
                        @error('time_in')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Time Out')" name="time_out" type="time"
                            value="{{ old('time_out') }}" />
                        @error('time_out')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('Break Time Start')" name="break_time_start" type="time"
                            value="{{ old('break_time_start') }}" />
                        @error('break_time_start')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Break Time End')" name="break_time_end" type="time"
                            value="{{ old('break_time_end') }}" />
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
</x-layouts.app>
