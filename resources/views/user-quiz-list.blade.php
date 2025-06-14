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
        <x-user-navbar />

        <!-- Main Content -->
        <div class="bg-gray-100 flex flex-col items-center pt-5 min-h-screen">
            <div class="flex justify-between items-center w-full max-w-3xl mx-auto mb-6">
                <h2 class="text-2xl text-gray-800">Category Name: {{ $category }}</h2>
            </div>

            <div class="w-full max-w-3xl">
                <ul class="border border-gray-200 rounded-md">
                    <!-- Header Row -->
                    <li class="p-3 font-bold bg-gray-300 rounded-t-md">
                        <ul class="flex justify-between">
                            <li class="w-1/4">Quiz ID</li>
                            <li class="w-1/2">Name</li>
                            <li class="w-1/2">Mcq Count</li>
                            <li class="w-1/4 text-center">Action</li>
                        </ul>
                    </li>

                    <!-- Quiz List -->
                    @forelse($quizdata as $item)
                    <li class="even:bg-gray-200 p-3">
                        <ul class="flex justify-between items-center">
                            <li class="w-1/4">{{ $item->id }}</li>
                            <li class="w-1/2">{{ $item->name }}</li>
                            <li class="w-1/2">{{ $item->mcq_count }}</li>
                            <li class="w-1/4 text-center">
                                <a href="{{ url('start-quiz/' . $item->id . '/' .$item->name) }}" class="text-green-500 font-bold">
                                    Attempt Quiz
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
