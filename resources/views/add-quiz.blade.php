<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        @vite('resources/css/app.css')
    </head>

    <body>
        <x-navbar name="{{$name}}"></x-navbar>
        <div class="bg-gray-100 flex flex-col items-center pt-5 min-h-screen">
            <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
                @if(!Session('quizDetails'))

                <h2 class="text-2xl text-center text-gray-800 mb-6">Add Quiz</h2>

                <form action="/add-quiz" method="get" class="space-y-4">
                    <div>
                        <input type="text" name="quiz" id="" placeholder="Enter Quiz name" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" value="{{ old('quiz') }}" />
                    </div>

                    <div>
                        <select name="cat_id" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none">
                            @if(isset($category) && $category->isNotEmpty()) @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach @else
                            <option disabled selected>No category found</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 rounded-2xl px-4 py-2 text-white">Add Category</button>
                </form>

                @else
                <span class="text-green-500 font-bold text-center block">
                    Quiz: {{ session('quizDetails')->name }}
                </span>
                <p class="text-green-500 font-bold">
                    Total MCQs:{{$total}} @if(isset($total)&& $total>0)

                    <a href="/show-quiz/{{ session('quizDetails')->id }}" class="text-yellow-500 text-sm">Show MCQs</a>
                    @endif
                </p>

                <h2 class="text-2xl text-center text-gray-800 mb-6 px-2 py-1">Add MCQ</h2>

                <form action="/add-mcq" method="post">
                    @csrf()
                    <div class="px-4 py-2">
                        <textarea name="question" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" placeholder="Enter Your Question"></textarea>
                    </div>
                    @error('question')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="px-4 py-2">
                        <input type="text" name="a" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" placeholder="Enter first option" />
                    </div>
                    @error('a')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="px-4 py-2">
                        <input type="text" name="b" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" placeholder="Enter second option" />
                    </div>
                    @error('b')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="px-4 py-2">
                        <input type="text" name="c" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" placeholder="Enter third option" />
                    </div>
                    @error('c')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="px-4 py-2">
                        <input type="text" name="d" id="" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" placeholder="Enter fourth option" />
                    </div>
                    @error('d')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="px-4 py-2">
                        <select name="correct_ans" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                            <option value="">Select Right Answer</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>
                    @error('correct_ans')

                    <div class="text-red-500 px-1 py-1 w-md">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="px-4 py-2">
                        <button type="submit" name="submit" class="w-full bg-blue-500 rounded-2xl px-4 py-2 text-white" value="add-more">Add More</button>
                    </div>
                    <div class="px-4 py-2">
                        <button type="submit" name="submit" class="w-full bg-green-500 rounded-2xl px-4 py-2 text-white" value="done">Add and Submit</button>
                    </div>

                    <div class="px-4 py-2">
                        <a href="/end-quiz" class="w-full bg-red-500 rounded-2xl px-4 py-2 text-white block text-center">End Quiz</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </body>
</html>
