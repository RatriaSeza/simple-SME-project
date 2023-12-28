<x-layouts.app>
    <div class="relative flex flex-col h-full mt-3 ml-3 p-4 text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative  overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between gap-8 mb-4">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                        Add Employee
                    </h5>
                </div>
            </div>
            <form action="{{ route('employees.store') }}" method="post" class="flex flex-col gap-3">
                @csrf
                <div class="flex gap-4">
                    <div>
                        <x-forms.input :label="__('First Name*')" name="first_name" value="{{ old('first_name') }}" />
                        @error('first_name')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Last Name*')" name="last_name" value="{{ old('last_name') }}" required />
                        @error('last_name')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                    <div>
                        <x-forms.input :label="__('Nick Name')" name="nick_name" value="{{ old('nick_name') }}" />
                        @error('nick_name')
                            <x-forms.input-error :$message />
                        @enderror
                    </div>
                </div>
                <div>
                    <x-forms.input :label="__('Birth Date')" name="birth_date" type="date" value="{{ old('birth_date') }}"
                        required />
                    @error('birth_date')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <x-forms.input :label="__('Position*')" name="position" value="{{ old('position') }}" required />
                    @error('position')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <div class="relative h-10 w-72 min-w-[200px]">
                        <select name="gender"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Gender*
                        </label>
                    </div>
                    @error('gender')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <x-forms.input :label="__('Education*')" name="education" value="{{ old('education') }}" required />
                    @error('education')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <x-forms.input :label="__('ID Number (NIK)*')" name="id_number" value="{{ old('id_number') }}" required />
                    @error('id_number')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <div class="relative h-10 w-72 min-w-[200px]">
                        <select name="marital_status"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                            <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single
                            </option>
                            <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married
                            </option>
                            <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>
                                Divorced
                            </option>
                        </select>
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Marital Status*
                        </label>
                    </div>
                    @error('marital_status')
                        <x-forms.input-error :$message />
                    @enderror
                </div>
                <div>
                    <x-forms.input :label="__('Join Date')" name="join_date" type="date" value="{{ old('join_date') }}"
                        required />
                    @error('join_date')
                        <x-forms.input-error :$message />
                    @enderror
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
