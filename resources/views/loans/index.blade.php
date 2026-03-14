<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-800">Borrow Records</h2>
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50">Back to Books</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="GET" class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                    <div>
                        <x-input-label for="search" :value="__('Search (borrower or book)')" />
                        <x-text-input id="search" name="search" class="mt-1 block w-full" value="{{ request('search') }}" />
                    </div>
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All</option>
                            <option value="active" @selected(request('status') === 'active')>Active</option>
                            <option value="overdue" @selected(request('status') === 'overdue')>Overdue</option>
                            <option value="returned" @selected(request('status') === 'returned')>Returned</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <x-primary-button class="w-full">Filter</x-primary-button>
                        <a href="{{ route('loans.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 w-full">Clear</a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrower</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Returned</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($loans as $loan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->borrower_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('books.show', $loan->book) }}" class="font-medium text-indigo-600 hover:text-indigo-900">{{ $loan->book->title }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->borrowed_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->due_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->returned_at ? $loan->returned_at->format('M d, Y') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($loan->returned_at)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-700">Returned</span>
                                        @elseif($loan->isOverdue())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-700">Overdue</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">Borrowed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('books.show', $loan->book) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        @if(!$loan->returned_at)
                                            <form action="{{ route('books.return', $loan->book) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-800">Mark Returned</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">No borrow records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $loans->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
