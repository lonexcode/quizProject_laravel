<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MCQ Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <x-user-navbar />

    <!-- Main Content -->
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-green-700">{{ $quizName }}</h2>
            <h3 class="text-xl font-semibold text-gray-700">Question No.{{ Session('currentQuiz')['totalMcq'] }}</h3>

            <h3 class="text-xl font-semibold text-gray-700">{{ Session('currentQuiz')['currentMcq'] }} of
                {{ Session('currentQuiz')['totalMcq'] }}</h3>


            <div class="p-4 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="text-xl font-bold text-gray-800">Question: {{ $mcqData->question }}</h4>
            </div>

            <form action="/submit-next/{{ $mcqData->id }}" method="post" class="space-y-4 text-left">
                @csrf
                <label
                    class="flex items-center p-4 bg-white rounded-xl shadow-md cursor-pointer transition hover:bg-blue-50"
                    for="option_1">
                    <input id="option_1" type="radio" name="option" value="A"
                        class="form-radio text-blue-600" />
                    <span class="ml-3 text-gray-900 font-medium">{{ $mcqData->a }}</span>
                </label>

                <label
                    class="flex items-center p-4 bg-white rounded-xl shadow-md cursor-pointer transition hover:bg-blue-50"
                    for="option_2">
                    <input id="option_2" type="radio" name="option" value="B"
                        class="form-radio text-blue-600" />
                    <span class="ml-3 text-gray-900 font-medium">{{ $mcqData->b }}</span>
                </label>

                <label
                    class="flex items-center p-4 bg-white rounded-xl shadow-md cursor-pointer transition hover:bg-blue-50"
                    for="option_3">
                    <input id="option_3" type="radio" name="option" value="C"
                        class="form-radio text-blue-600" />
                    <span class="ml-3 text-gray-900 font-medium">{{ $mcqData->c }}</span>
                </label>

                <label
                    class="flex items-center p-4 bg-white rounded-xl shadow-md cursor-pointer transition hover:bg-blue-50"
                    for="option_4">
                    <input id="option_4" type="radio" name="option" value="D"
                        class="form-radio text-blue-600" />
                    <span class="ml-3 text-gray-900 font-medium">{{ $mcqData->d }}</span>
                </label>

                <div class="pt-4 text-center">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-xl transition">
                        Submit Answer
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
