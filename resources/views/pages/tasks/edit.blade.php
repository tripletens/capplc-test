<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task Here') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-primary-button class="float-right mb-4" onclick="window.history.back()">
                        <img src="{{ asset('icons/arrow_back.svg') }}" class="bg-color-white" />
                        Go Back
                    </x-primary-button>


                    <form method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Hidden Task ID -->
                        <input type="hidden" name="id" value="{{ $task->id }}">

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="$task->date" required autofocus autocomplete="date" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Department -->
                        <div class="mt-4">
                            <x-input-label for="department_id" :value="__('Department')" />
                            <x-select-input name="department_id" :options="$options" :value="$task->department_id" required autofocus
                                autocomplete="department_id" placeholder="Select a department" />
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>

                        <!-- Task Details -->
                        <div class="mt-4">
                            <x-input-label for="task_details" :value="__('Task Details')" />
                            <x-text-area name="task_details" required autofocus :value="$task->task_details" />
                            <x-input-error :messages="$errors->get('task_details')" class="mt-2" />
                        </div>

                        <!-- Hours Worked -->
                        <div class="mt-4">
                            <x-input-label for="hours_worked" :value="__('Hours Worked')" />
                            <x-text-input id="hours_worked" class="block mt-1 w-full" type="number" name="hours_worked"
                                :value="$task->hours_worked" required autocomplete="hours_worked" />
                            <x-input-error :messages="$errors->get('hours_worked')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
