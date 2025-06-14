<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Check Your Skills</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

    <x-user-navbar />

    <div class="flex flex-col items-center min-h-screen p-6">
        <h1 class="text-4xl font-bold text-green-800 mb-6">Check Your Skills</h1>

        <!-- Search Bar -->
        <div class="w-full max-w-xl mb-8">
            <div class="relative">
                <input type="text" placeholder="Search quiz..." class="w-full px-5 py-3 pr-12 border border-gray-300 rounded-full shadow focus:outline-none focus:ring-2 focus:ring-green-400" />
                <button class="absolute top-1/2 right-4 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#4CAF50">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Category List -->
        <div class="w-full max-w-4xl bg-white shadow rounded-xl p-6">
            <h2 class="text-2xl font-semibold text-green-600 text-center mb-4">Category List</h2>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-green-100 text-green-900 text-left">
                            <th class="px-4 py-2">S.No</th>
                            <th class="px-4 py-2">Quiz Count</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($data) && $data->isNotEmpty())
                        @foreach($data as $key => $category)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>
                            <td class="px-4 py-2">{{ $category->quizzes_count }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ url('user-quiz-list/' . $category->id . '/' . $category->name) }}" class="text-green-600 hover:text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No Category Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-footer-user />
</body>

</html>