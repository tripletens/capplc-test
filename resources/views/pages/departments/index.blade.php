<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @can('create', App\Models\Department::class)
                        <a href="{{ route('department.create') }}"<x-primary-button class="float-right mb-4"><img src="{{ asset('icons/add_white.svg') }}" class="bg-color-white" />
                            Create</x-primary-button>
                        </a>
                    @endcan
                    
                    <table id="departmentTable" class="display mt-4" style="width:100%; margin-top:50px;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>@if($department->status == 1)
                                        <span class="bg-green-500 text-white border-green-800 p-2 text-sm rounded-md">Active</span>
                                    @else
                                        <span class=" bg-red-500 text-white border-red-800 p-2 text-sm rounded-md">Inactive</span>
                                    @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize DataTable with sorting on the fourth column (index 3) in descending order
            $('#departmentTable').DataTable({
                {{--  order: [[3, 'desc']]  --}}
            });
        });
    </script>
</x-app-layout>
