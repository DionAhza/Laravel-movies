@extends('layouts.main')

@section('content')

<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex">
        <img src="{{ asset('storage/'.$movie->thumbnail) }}" alt="parasite" class="w-96" style="width:24rem">
        <div class="ml-24">
           <h2 class="text-4xl font-semibold">{{ $movie->title }} ({{ $movie->release_year }})</h2>
           <div class="flex items-center text-gray-400 text-sm m">
            <span class=""><svg class="fill-current text-orange-500" width="15px" height="15px" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z" fill-rule="nonzero"/></svg></span>
            <span class="ml-1">{{ $movie->rating }}</span>
            <span class="mx-2">|</span>
            <span class="">{{ $movie->release_year }}</span>
            <span class="mx-2">|</span>
            <span class="mx-2">  @php
                $genres = json_decode($movie->genre, true); // Dekode JSON ke array
                @endphp

                {{-- Gabungkan array menjadi string --}}
                {{ implode(', ', $genres) }} </span>
                <span class="mx-2">|</span>
                <span class="mx-2">{{ $movie->duration }} Minutes</span>
            </div>
<p class="text-gray-300 mt-8">
           {{ $movie->synopsis }}
        </p>
        <div class="mt-12">
            <h4 class="text-white font-semibold">
                Featured Cast
                <div class="flex mt-4">
                    <div class="">
                       <div class=""> {{ $movie->director }} </div>
                       <div class="text-sm text-grayy-400">Director</div>
                    </div>
                </div>
            </h4>
        </div>
        <div class="mt-12 flex">
            <a href="{{ $movie->link }}">
            <button class="flex items-center bg-orange-400 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-3 17v-10l9 5.146-9 4.854z"/></svg> 
           <div class="ml-2">Play Trailer</div></button></a>   
<button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-orange-600 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-3" type="button">
    Give rate
    </button>
    
    <!-- Rating Modal -->
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Rate this movie</h3>

                <!-- Rating Form -->
                <form id="rating-form" action="{{ route('movies.rate', $movie->id) }}" method="POST">
                    @csrf
                    <!-- Bintang Rating -->
                    <div class="flex justify-center mb-4" id="star-rating">
                        <span class="cursor-pointer text-gray-400 text-2xl" data-rating="1">&#9733;</span>
                        <span class="cursor-pointer text-gray-400 text-2xl" data-rating="2">&#9733;</span>
                        <span class="cursor-pointer text-gray-400 text-2xl" data-rating="3">&#9733;</span>
                        <span class="cursor-pointer text-gray-400 text-2xl" data-rating="4">&#9733;</span>
                        <span class="cursor-pointer text-gray-400 text-2xl" data-rating="5">&#9733;</span>
                    </div>
                    
                    <!-- Input Hidden untuk Rating -->
                    <input type="hidden" name="rating" id="rating" value="0">

                    <button type="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" id="submit-rating">
                        Submit Rating
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Rating -->
<script>
    const stars = document.querySelectorAll('#star-rating span');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-rating');

            // Ubah warna bintang berdasarkan rating yang dipilih
            stars.forEach(s => {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-400');
            });
            for (let i = 0; i < selectedRating; i++) {
                stars[i].classList.add('text-yellow-400'); // Ubah warna bintang yang dipilih
            }

            // Set nilai rating ke input hidden
            document.getElementById('rating').value = selectedRating;
        });
    });
</script>

    
    
    
        </div>
        </div>
    </div>

</div> {{-- end movie info --}}

    

@endsection