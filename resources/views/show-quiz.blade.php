<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Cateogaries</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name="{{$name}}"></x-navbar>

    @if(session('category-success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-md text-center my-1">
        {{ session('category-success') }}
    </div>
    @endif @if(session('category-error'))
    <div class="bg-red-100 text-red-700 p-4 rounded-md text-center my-1">
        {{ session('category-error') }}
    </div>
    @endif

    <div class="bg-gray-100 flex flex-col items-center pt-5 min-h-screen">

        <div class="flex justify-between items-center w-full max-w-3xl mx-auto mb-6">
            <h2 class="text-2xl text-gray-800">Quiz Name:{{$quizname}}</h2>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg shadow hover:bg-red-600 transition">
                Back
            </a>
        </div>


        <div class="w-200 pt-5">
            <ul class="border border-gray-200">
                <li class="p-2 font-bold">
                    <ul class="flex justify-between">
                        <li class="w-30">
                            MCQ Id
                        </li>
                        <li class="w-170">
                            Question
                        </li>
                    </ul>
                </li>
                @if(isset($data) && $data->isNotEmpty())
                @foreach($data as $category)
                <li class="even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-30">
                            {{$category->id}}
                        </li>
                        <li class="w-170">
                            {{$category->question}}
                        </li>


                    </ul>
                </li>
                @endforeach
                @else
                <li class="p-4 text-center text-gray-500">
                    No Category Found
                </li>
                @endif
            </ul>
        </div>
    </div>
</body>

</html>