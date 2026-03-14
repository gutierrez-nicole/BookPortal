<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-800">Reserve {{ $book ? '"'.$book->title.'"' : 'a Book' }}</h2>
            <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50">Back to Reservations</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf

                    @if(! $book)
                        <div>
                            <x-input-label for="book_id" :value="__('Book')" />
                            <select id="book_id" name="book_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select a book</option>
                                @foreach($books as $optionBook)
                                    <option value="{{ $optionBook->id }}" @selected(old('book_id') == $optionBook->id)>{{ $optionBook->title }} — {{ $optionBook->author }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>
                    @else
                        <input type="hidden" name="book_id" value="{{ $book->id }}" />
                    @endif

                    <div>
                        <x-input-label for="reserved_by" :value="__('Reserved For (Name)')" />
                        <x-text-input id="reserved_by" class="block mt-1 w-full" type="text" name="reserved_by" value="{{ old('reserved_by') }}" required autofocus />
                        <x-input-error :messages="$errors->get('reserved_by')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="reserved_at" :value="__('Reserved Date')" />
                        <x-text-input id="reserved_at" class="block mt-1 w-full" type="date" name="reserved_at" value="{{ old('reserved_at', now()->toDateString()) }}" />
                        <x-input-error :messages="$errors->get('reserved_at')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="expires_at" :value="__('Expires At')" />
                        <x-text-input id="expires_at" class="block mt-1 w-full" type="date" name="expires_at" value="{{ old('expires_at') }}" />
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('reservations.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        <x-primary-button>{{ __('Reserve Book') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
