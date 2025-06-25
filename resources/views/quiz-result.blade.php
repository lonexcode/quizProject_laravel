<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz Result</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    <!-- Navbar -->
    <x-user-navbar />

    <!-- Main Content -->
    <div class="flex-grow flex flex-col items-center py-10 px-4">
        <h1 class="text-4xl font-bold text-green-800 mb-8">Quiz Result</h1>

        <!-- Score Summary Card -->
        <div class="w-full max-w-3xl bg-white rounded-lg shadow-md p-6 mb-8 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Your Score</h2>
            <p class="text-2xl text-green-700 font-bold">
                {{ $correctAns }} / {{ count($resultData) }}
            </p>

            <!-- Progress Bar -->
            @php
                $percentage = (count($resultData) > 0) ? round(($correctAns / count($resultData)) * 100) : 0;
            @endphp
            <div class="w-full mt-4 bg-gray-200 rounded-full h-4 overflow-hidden">
                <div class="bg-green-500 h-full text-xs text-white text-center" style="width: {{ $percentage }}%">
                    {{ $percentage }}%
                </div>
            </div>
        </div>

        <!-- Results Table -->
        <div class="w-full max-w-5xl bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-semibold text-green-600 text-center mb-4">Question Breakdown</h2>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-green-100 text-green-900 text-left text-sm uppercase tracking-wide">
                            <th class="px-4 py-3">S.No</th>
                            <th class="px-4 py-3">Question</th>
                            <th class="px-4 py-3">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($resultData) && $resultData->isNotEmpty())
                            @foreach ($resultData as $key => $item)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-green-50 transition duration-150">
                                    <td class="px-4 py-3 text-gray-700 font-medium">{{ $key + 1 }}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $item->question }}</td>
                                    <td class="px-4 py-3">
                                        @if ($item->is_correct)
                                            <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                                                Correct
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                                Incorrect
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center py-6 text-gray-500">
                                    No Results Found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
    <x-footer-user class="mt-auto" />

</body>

</html>
