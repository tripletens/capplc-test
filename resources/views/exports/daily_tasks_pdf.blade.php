@extends('layouts.exports.pdf')

@section('title', 'Tasks ' . date('d-M-Y'))
@section('content')
    <h1 style="font-size: 16px; font-weight: bold; margin-top: 10px;">Daily Task Report -
        {{ \Carbon\Carbon::now()->format('F d, Y') }}</h1>

    <div style="font-family: Arial, sans-serif; font-size: 12px; margin: 20px;">
        {{--  <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 16px; font-weight: bold; margin-top: 10px;">Daily Task Report - {{ \Carbon\Carbon::now()->format('F d, Y') }}</h1>
        </div>  --}}

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2;">Date</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2;">Employee
                        Name</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Department</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2;">Task
                        Details</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2;">Hours
                        Worked</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; text-align: left;">{{ $task->date }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: left;">{{ $task->employee_name }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: left;">
                            {{ $task->department->name ?? 'N/A' }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: left;">{{ $task->task_details }}</td>
                        <td style="border: 1px solid black; padding: 8px; text-align: left;">{{ $task->hours_worked }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: center; font-style: italic; font-size: 10px;">
            Generated on {{ now()->format('F d, Y H:i A') }} by {{ config('app.name') }}
        </div>
    </div>
@endsection
