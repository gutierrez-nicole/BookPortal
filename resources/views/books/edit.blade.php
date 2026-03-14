<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800">Edit Book</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $book->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" class="block mt-1 w-full" type="text" name="author" :value="old('author', $book->author)" required />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="genre" :value="__('Genre')" />
                        <x-text-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre', $book->genre)" required />
                        <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="isbn" :value="__('ISBN')" />
                        <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn', $book->isbn)" required />
                        <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="cover_image" :value="__('Cover Image (optional)')" />
                        @if($book->cover_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="h-32 object-contain border" />
                            </div>
                        @endif
                        <x-text-input id="cover_image" class="block mt-1 w-full" type="file" name="cover_image" accept="image/*" />
                        <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                        <x-primary-button>{{ __('Update Book') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
