@vite('resources/css/app.css')  
@extends('layouts.main')

@section('content')


<form class="max-w-md mx-auto mt-16" method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Thumbnail -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="file" name="thumbnail" id="thumbnail" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
        <label for="thumbnail" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Thumbnail</label>
    </div>

    <!-- Title -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Title</label>
    </div>
    <!--Genre -->
    <div class="relative z-0 w-full mb-5 group">
        <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Select Genre</label>
        <div class="grid grid-cols-2 gap-4">
            @foreach($genres as $genre)
                <div class="flex items-center">
                    <input type="checkbox" name="genre[]" id="genre_{{ $genre->id }}" value="{{ $genre->genre }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 ">
                    <label for="genre_{{ $genre->id }}" class="ml-2 text-sm font-medium text-white dark:text-gray-300">{{ $genre->genre }}</label>
                </div>
            @endforeach
        </div>
    </div>
    

    <!-- Director -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="director" id="director" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="director" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Director</label>
    </div>

    <!-- Release Year -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="number" name="release_year" id="release_year" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="release_year" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Release Year</label>
    </div>

    <!-- Link -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="url" name="link" id="link" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="link" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Link</label>
    </div>

    <!-- Synopsis -->
    <div class="relative z-0 w-full mb-5 group">
        <textarea name="synopsis" id="synopsis" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required></textarea>
        <label for="synopsis" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Synopsis</label>
    </div>

    <!-- Duration -->
    <div class="relative z-0 w-full mb-5 group">
        <input type="number" name="duration" id="duration" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="duration" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Duration (minutes)</label>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>


@endsection