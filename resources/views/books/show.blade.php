<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-800">Book Details</h2>
            <div class="space-x-2">
                <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700">Edit</a>
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-200">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="w-full h-auto rounded-md border" />
                        @else
                            <div class="w-full h-64 flex items-center justify-center rounded-md border border-dashed border-gray-300 text-gray-400">
                                No cover image
                            </div>
                        @endif
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-2xl font-semibold">{{ $book->title }}</h3>
                        <p class="text-gray-600 mt-1">by {{ $book->author }}</p>
                        <p class="text-sm text-gray-500 mt-2">Genre: {{ $book->genre }}</p>
                        <p class="text-sm text-gray-500">ISBN: {{ $book->isbn }}</p>

                        <div class="mt-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $book->available ? 'bg-emerald-100 text-emerald-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $book->available ? 'Available' : 'Borrowed' }}
                            </span>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 mb-2">Book QR Code</h4>
                                <div class="w-44 h-44 bg-white border rounded-md flex items-center justify-center">
                                    <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ urlencode(route('books.show', $book)) }}&choe=UTF-8" alt="QR code" class="h-full w-full" />
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Scan to open this book in the BookPortal system.</p>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 mb-2">Reserve this book</h4>
                                <a href="{{ route('reservations.create', ['book' => $book->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700">Reserve</a>
                                <p class="text-xs text-gray-500 mt-2">Create a reservation for a borrower so the book can be claimed later.</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            @if($book->available)
                                <form method="POST" action="{{ route('books.borrow', $book) }}" class="space-y-4">
                                    @csrf

                                    <div>
                                        <x-input-label for="borrower_name" :value="__('Borrower Name')" />
                                        <x-text-input id="borrower_name" name="borrower_name" class="mt-1 block w-full" value="{{ old('borrower_name') }}" required />
                                        <x-input-error :messages="$errors->get('borrower_name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="due_date" :value="__('Due Date')" />
                                        <x-text-input id="due_date" name="due_date" class="mt-1 block w-full" type="date" value="{{ old('due_date') }}" required />
                                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <x-primary-button>{{ __('Borrow Book') }}</x-primary-button>
                                    </div>
                                </form>
                            @else
                                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                                    <p class="font-semibold">This book is currently borrowed.</p>
                                    @if($book->currentLoan())
                                        <p class="mt-2">Borrower: <strong>{{ $book->currentLoan()->borrower_name }}</strong></p>
                                        <p>Due: <strong>{{ $book->currentLoan()->due_date->format('M d, Y') }}</strong></p>
                                    @endif

                                    <form method="POST" action="{{ route('books.return', $book) }}" class="mt-4">
                                        @csrf
                                        @method('PATCH')
                                        <x-primary-button>{{ __('Mark as Returned') }}</x-primary-button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
