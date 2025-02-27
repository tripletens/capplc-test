<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @can('create', App\Models\Task::class)
                        <a href="{{ route('task.create') }}">
                            <x-primary-button class="float-right mb-4">
                                <img src="{{ asset('icons/add_white.svg') }}" class="bg-color-white" />
                                Create
                            </x-primary-button>
                        </a>
                    @endcan

                    @can('exportDailyTasks', App\Models\Task::class)
                        <a href="{{ route('task.export.excel') }}">
                            <x-primary-button class="text-xs px-3 py-2 bg-green-600 hover:bg-green-700 text-white">
                                <img src="{{ asset('icons/export_notes.svg') }}" class="h-4 w-4 inline-block mr-1" />
                                Export to Excel
                            </x-primary-button>
                        </a>
                    @endcan

                    @can('exportDailyTasks', App\Models\Task::class)
                        <a href="{{ route('task.export.pdf') }}">
                            <x-info-button class="text-xs px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white">
                                <img src="{{ asset('icons/export_notes.svg') }}" class="h-4 w-4 inline-block mr-1" />
                                Export to PDF
                            </x-info-button>
                        </a>
                    @endcan

                    {{--  task.export.excel  --}}

                    <form method="POST" action="{{ route('task.search') }}">
                        @csrf
                        <!-- Department -->
                        <div class="mt-4">
                            <x-input-label for="department_id" :value="__('Department')" />
                            <x-select-input name="department_id" :options="$options" :value="old('department_id')" required autofocus
                                autocomplete="department_id" placeholder="Select a department" />
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>

                        <!-- Employee Name -->
                        <div class="mt-4">
                            <x-input-label for="employee_name" :value="__('Employee Name')" />
                            <x-text-input id="employee_name" class="block mt-1 w-full" type="text"
                                name="employee_name" :value="old('employee_name')" required autocomplete="employee_name" />
                            <x-input-error :messages="$errors->get('employee_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                :value="old('start_date')" required autofocus autocomplete="start_date" />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                :value="old('end_date')" required autofocus autocomplete="end_date" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <x-primary-button class="m-4 float-right">
                            <img src="{{ asset('icons/search.svg') }}" class="bg-color-white" /> {{ __('Filter') }}
                        </x-primary-button>
                        <a href="{{ route('task.index') }}">
                            <x-secondary-button class="m-4 float-end">
                                <img src="{{ asset('icons/restart_alt_black.svg') }}" class="bg-color-white" />
                                {{ __('Reset') }}
                            </x-secondary-button>
                        </a>
                    </form>

                    <table id="taskTable" class="display mt-4 border-b-2" style="width:100%; margin-top:50px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Task Details</th>
                                <th>Hours Worked</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tasks as $key => $task)
                                @php
                                    $isEditable = now()->diffInHours($task->created_at) <= 24;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $task->date }}</td>
                                    <td>{{ $task->employee_name }}</td>
                                    <td>{{ optional($task->department)->name ?? 'No Department' }} </td>
                                    <td>{{ $task->task_details }}</td>
                                    <td>{{ $task->hours_worked }}</td>
                                    <td>
                                        @can('delete', $task)
                                            <a href="{{ route('task.delete', $task->id) }}">
                                                <x-danger-button class="float-right text-xs m-1">
                                                    <img src="{{ asset('icons/delete.svg') }}"
                                                        class="bg-color-white h-4 w-4" />
                                                </x-danger-button>
                                            </a>
                                        @endcan

                                        @can('update', $task)
                                            <a href="{{ $isEditable ? route('task.edit', $task->id) : '#' }}"
                                                class="text-blue-500 {{ !$isEditable ? 'pointer-events-none opacity-50' : '' }}">
                                                <x-info-button class="float-right text-xs m-1 bg-blue-400">
                                                    <img src="{{ asset('icons/edit.svg') }}"
                                                        class="bg-color-white h-4 w-4" />
                                                </x-info-button>
                                            </a>
                                        @endcan

                                        @can('approveTask', $task)
                                            @if (!$task->is_approved)
                                                <form action="{{ route('task.approve', $task->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="float-right text-xs m-1 bg-blue-400 text-white p-2 rounded">
                                                        <img src="{{ asset('icons/check_circle.svg') }}"
                                                            class="bg-color-white h-4 w-4 inline" />
                                                        Approve
                                                    </button>
                                                </form>
                                            @else
                                                <button
                                                    class="float-right text-xs m-1 bg-gray-400 text-white p-2 rounded cursor-not-allowed"
                                                    disabled>
                                                    <img src="{{ asset('icons/check_circle.svg') }}"
                                                        class="bg-color-white h-4 w-4 inline" />
                                                    Approved
                                                </button>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable with sorting on the Date column (index 1) in descending order
            $('#taskTable').DataTable({
                order: [
                    [1, 'desc']
                ]
            });
        });
    </script>
</x-app-layout>
