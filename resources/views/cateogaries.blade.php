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
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-2xl text-center text-gray-800 mb-6">Add Category</h2>

            <form action="/add-category" method="post" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="category" id="" placeholder="Enter Your category" class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" value="{{ old('category') }}" />
                </div>
                @error('category')
                <div class="text-red-500">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="w-full bg-blue-500 rounded-2xl px-4 py-2 text-white">Add Category</button>
            </form>
        </div>

        <div class="w-200 pt-5">
            <h1 class="text-2xl text-blue-500 text-center py-2">Category List</h1>
            <ul class="border border-gray-200">
                <li class="p-2 font-bold">
                    <ul class="flex justify-between">
                        <li class="w-30">
                            S.no
                        </li>
                        <li class="w-70">
                            Name
                        </li>
                        <li class="w-70">
                            Creator
                        </li>
                        <li class="w-30">
                            Operation
                        </li>
                    </ul>
                </li>
                @if(isset($data) && $data->isNotEmpty()) @foreach($data as $category)
                <li class="even:bg-gray-200 p-2">
                    <ul class="flex justify-between">
                        <li class="w-30">
                            {{$category->id}}
                        </li>
                        <li class="w-70">
                            {{$category->name}}
                        </li>
                        <li class="w-70">
                            {{$category->creator}}
                        </li>
                        <li class="w-30 flex">
                            <a href="category/delete/{{$category->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#992B15">
                                    <path
                                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                </svg>
                            </a>

                            <a
                                href="category/list/{{$category->id}}/{{$category->name}}
                                ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C">
                                    <path
                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </li>
                @endforeach @else
                <li class="p-4 text-center text-gray-500">
                    No Category Found
                </li>
                @endif
            </ul>
        </div>
    </div>
</body>

</html>