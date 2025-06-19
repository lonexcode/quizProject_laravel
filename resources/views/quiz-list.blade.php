<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Navbar -->
    <x-navbar :name="$name" />

    <!-- Flash Messages -->
    @if (session('category-success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-md text-center my-1">
            {{ session('category-success') }}
        </div>
    @endif

    @if (session('category-error'))
        <div class="bg-red-100 text-red-700 p-4 rounded-md text-center my-1">
            {{ session('category-error') }}
        </div>
    @endif

    <!-- Main Content -->
    <div class="bg-gray-100 flex flex-col items-center pt-5 min-h-screen">
        <div class="flex justify-between items-center w-full max-w-3xl mx-auto mb-6">
            <h2 class="text-2xl text-gray-800">Category Name: {{ $category }}</h2>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg shadow hover:bg-red-600 transition">
                Back
            </a>
        </div>

        <div class="w-full max-w-3xl">
            <ul class="border border-gray-200 rounded-md">
                <!-- Header Row -->
                <li class="p-3 font-bold bg-gray-300 rounded-t-md">
                    <ul class="flex justify-between">
                        <li class="w-1/4">Quiz ID</li>
                        <li class="w-1/2">Name</li>
                        <li class="w-1/4 text-center">Action</li>
                    </ul>
                </li>

                <!-- Quiz List -->
                @forelse($quizdata as $item)
                    <li class="even:bg-gray-200 p-3">
                        <ul class="flex justify-between items-center">
                            <li class="w-1/4">{{ $item->id }}</li>
                            <li class="w-1/2">{{ $item->name }}</li>
                            <li class="w-1/4 text-center">
                                <a href="{{ url('show-quiz/' . $item->id . '/' . $item->name) }}" class="inline-block">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#75FB4C">
                                        <path
                                            d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-500">
                        No Quiz Found
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</body>

</html>
