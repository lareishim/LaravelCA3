@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10 text-white">
        <h1 class="text-2xl font-bold mb-6">Activity Logs</h1>

        {{-- Flash Success Message --}}
        @if(session('success'))
            <div class="mb-4 text-green-400 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Clear Logs Button --}}
        <form id="clearLogsForm" method="POST" action="{{ route('admin.logs.clear') }}" class="mb-6">
            @csrf
            @method('DELETE')
            <button type="button" id="clearLogsBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Clear All Logs
            </button>
        </form>

        @if($logs->isEmpty())
            <p class="text-gray-400">No activity logs found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse text-sm">
                    <thead>
                    <tr class="bg-gray-700 text-left">
                        <th class="p-3 border border-gray-600">Action</th>
                        <th class="p-3 border border-gray-600">Description</th>
                        <th class="p-3 border border-gray-600">User</th>
                        <th class="p-3 border border-gray-600">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($logs as $log)
                        <tr class="border border-gray-700 hover:bg-gray-700">
                            <td class="p-3">{{ $log->action }}</td>
                            <td class="p-3">{{ $log->description ?? '-' }}</td>
                            <td class="p-3">{{ $log->user?->name ?? 'System' }}</td>
                            <td class="p-3">{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('clearLogsBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Delete All Logs?',
                text: "This will permanently delete all activity logs.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete all!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('clearLogsForm').submit();
                }
            });
        });
    </script>
@endpush
