<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Employees Count -->
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Total Employees</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $employeesCount }}</p>
                </div>

                <!-- Total Tasks -->
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Total Tasks</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $tasksCount }}</p>
                </div>

                <!-- Approved Tasks -->
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Approved Tasks</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $approvedTasksCount }}</p>
                </div>

                <!-- Unapproved Tasks -->
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Unapproved Tasks</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $unapprovedTasksCount }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
