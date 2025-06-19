<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <x-user-navbar />

    <!-- Main Content -->
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white shadow-lg rounded-2xl p-10 w-full max-w-xl text-center space-y-6">
            <h1 class="text-3xl font-bold text-green-700">{{ $quizname }}</h1>

            <p class="text-gray-700 text-lg">
                This quiz contains <span class="font-semibold text-green-700">{{ $count }}</span>
                question{{ $count > 1 ? 's' : '' }}.<br />
                There is <span class="font-semibold text-green-700">no time limit</span> to attempt it.
            </p>

            <h3 class="text-xl font-medium text-gray-800">Good Luck! 🍀</h3>
            @if (Session('userDetails'))
                <a href="/mcq/{{ session('firstmcq')->id }}/{{ $quizname }}"
                    class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-2xl transition duration-200">
                    Start Quiz
                </a>
            @else
                <a href="/user-signup-start-page"
                    class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-2xl transition duration-200">
                    Signup to Start Quiz
                </a>
                <a href="/user-login-start-page"
                    class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-2xl transition duration-200">
                    Login to Start Quiz
                </a>
            @endif
        </div>
    </div>
</body>

</html>
