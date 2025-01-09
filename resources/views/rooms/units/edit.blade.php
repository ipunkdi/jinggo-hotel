<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Breadcrumbs --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse px-4 lg:px-12">
            <li class="inline-flex items-center">
                <a href="/room/units" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Units
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit</a>
                </div>
            </li>
        </ol>
    </nav>

    {{-- Title --}}
    <h3 class="text-3xl font-bold dark:text-white px-4 lg:px-12">Units</h3>

    <section class="bg-white dark:bg-gray-900">
        <div class="bg-white border border-gray-200 rounded-lg shadow py-8 px-4 mx-auto max-w-2xl lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit unit details</h2>
            <form action="/room/units/{{ $inventory->unit->id }}" method="post">
                @method('put')
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Room Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type room name" required autofocus value="{{ old('name', $inventory->unit->name) }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here" name="description" required>{{ old('description', $inventory->unit->description) }}</textarea>
                    </div>
                    <div>
                        <label for="unit_group_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Room Type</label>
                        <select id="unit_group_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="unit_group_id">
                            @foreach ($unitGroups as $unitGroup)
                                @if (old('unit_group_id', $inventory->unitGroup->id) == $unitGroup->id)
                                    <option value="{{ $unitGroup->id }}" selected>{{ $unitGroup->type }}</option>
                                @else
                                    <option value="{{ $unitGroup->id }}">{{ $unitGroup->type }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="rate_plan_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rate Plan Price</label>
                        <input type="text" id="rate_plan_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $inventory->rate_plan ? $inventory->rate_plan->price : '' }}" readonly>
                        <input type="hidden" name="rate_plan_id" id="rate_plan_id" value="{{ $inventory->rate_plan_id }}">
                    </div>
                    <div class="w-full">
                        <label for="max_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max. Person</label>
                        <input type="text" name="max_person" id="max_person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type max. person" required value="{{ old('max_person', $inventory->unit->max_person) }}">
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                    Update unit
                </button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#unit_group_id').change(function() {
            var unitGroupId = $(this).val();
            $.ajax({
                url: '/rate-plans/' + unitGroupId,
                method: 'GET',
                success: function(data) {
                    if(data.length > 0) {
                        $('#rate_plan_price').val(data[0].price);
                        $('#rate_plan_id').val(data[0].id);
                    } else {
                        $('#rate_plan_price').val('');
                        $('#rate_plan_id').val('');
                    }
                }
            });
        });

        // Trigger the change event on page load to populate rate plan if a unit group is already selected
        $('#unit_group_id').trigger('change');
    });
    </script>
</x-app-layout>