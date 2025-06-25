<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Details</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

    <!-- User Navbar -->
    <x-user-navbar />

    <div class="flex flex-col items-center min-h-screen py-10 px-4">

        <h1 class="text-4xl font-extrabold text-green-700 mb-10 tracking-wide">
            User Attempted Quizzes
        </h1>

        <!-- Quiz Record Table -->
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl overflow-hidden p-6">

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-gray-700 border border-gray-200 rounded-md">
                    <thead>
                        <tr class="bg-green-100 text-green-900 uppercase text-sm tracking-wider">
                            <th class="px-6 py-4 text-left border-b">S.No</th>
                            <th class="px-6 py-4 text-left border-b">Name</th>
                            <th class="px-6 py-4 text-left border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($quizRecord) && $quizRecord->isNotEmpty())
                            @foreach ($quizRecord as $key => $item)
                                <tr
                                    class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition duration-150">

                                    <td class="px-6 py-4 border-b">{{ $key + 1 }}</td>

                                    <td class="px-6 py-4 border-b">{{ $item->name }}</td>

                                   <td class="px-6 py-4 border-b capitalize">
    @if($item->status == 1)
        <span class="inline-block px-3 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded-full">
            Pending
        </span>
    @else
        <span class="inline-block px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
            Completed
        </span>
    @endif
</td>


                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-500">
                                    No quizzes attempted yet.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <x-footer-user />

</body>

</html>
