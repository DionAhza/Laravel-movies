@extends('layouts.main')

@section('content')
@if($movies->isNotEmpty())
    <h1  class="text-center text-gray-300 text-3xl my-8">Search Result <Strong>"{{ $query }}"</Strong></h1 >
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8 px-4"> <!-- Menggunakan grid untuk layout responsif -->
        @foreach($movies as $movie) <!-- Hanya menggunakan satu loop -->
            <div class="relative group rounded-lg overflow-hidden shadow-lg transition-transform transform hover:scale-105"> <!-- Penataan dan efek hover -->
                <a href="{{ route('movies.show', $movie->id) }}">
                    <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="{{ $movie->title }}" class="w-full  object-cover transition-opacity duration-150 hover:opacity-75">
                </a>
                
                @if (Auth::check() && Auth::user()->role == 'admin') <!-- Memastikan kondisi untuk admin -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-50">
                        <button data-modal-target="popup-modal-{{ $movie->id }}" data-modal-toggle="popup-modal-{{ $movie->id }}" class="bg-red-600 text-white font-semibold py-1 px-3 rounded mr-2 hover:bg-red-700">
                            Delete
                        </button>
                        <a href="{{ route('movies.edit', $movie->id) }}" class="bg-blue-600 text-white font-semibold py-1 px-3 rounded hover:   bg-blue-700">Edit</a>
                    </div>
                @endif

                {{-- Modal Delete --}}
                <div id="popup-modal-{{ $movie->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-900" data-modal-hide="popup-modal-{{ $movie->id }}">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this movie?</h3>
                                
                                <!-- Delete Form -->
                                <form action="{{ route('movies.delete', $movie->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                </form>

                                <button data-modal-hide="popup-modal-{{ $movie->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2 ">
                <a href="{{ route('movies.show', $movie->id) }}" class="text-lg font-semibold mt-2 hover:text-gray-300">{{ $movie->title }}</a>
                <div class="flex  text-gray-400 text-sm mt-1">
                    <span class="flex items-center">
                        <svg class="fill-current text-orange-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"/>
                        </svg>
                    </span>
                    <span class="ml-1">85%</span>
                    <span class="mx-2">|</span>
                    <span class="">{{ $movie->release_year }}</span>
                </div>
                <div class="text-gray-400 text-sm">
                    @php
                        $genres = json_decode($movie->genre, true); // Dekode JSON ke array
                    @endphp
                    {{-- Gabungkan array menjadi string --}}
                    {{ implode(', ', $genres) }} 
                </div>
                <span class="text-gray-400 text-sm">{{ $movie->synopsis }} </span>
            </div>
        @endforeach
    </div>

    <!-- Menampilkan link pagination -->
    <div class="mt-4">
        {{ $movies->links() }}
    </div>
@else
    <p class="text-center mt-8">No movies found for "{{ $query }}".</p>
@endif
@endsection
