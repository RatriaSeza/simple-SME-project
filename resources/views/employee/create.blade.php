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
                <div class="flex gap-6">
                    <x-forms.input :label="__('First Name')" required />
                    <x-forms.input :label="__('Last Name')" required />
                    <x-forms.input :label="__('Nick Name')" required />
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
