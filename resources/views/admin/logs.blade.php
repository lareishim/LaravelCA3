@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Activity Logs</h1>

        @if($logs->isEmpty())
            <p class="text-gray-400">No activity logs found.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead>
                <tr class="bg-gray-700 text-left">
                    <th class="p-3 border border-gray-600">Description</th>
                    <th class="p-3 border border-gray-600">Causer</th>
                    <th class="p-3 border border-gray-600">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $log)
                    <tr class="border border-gray-700 hover:bg-gray-700">
                        <td class="p-3">{{ $log->description }}</td>
                        <td class="p-3">{{ $log->causer?->name ?? 'System' }}</td>
                        <td class="p-3">{{ $log->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
@endsection
