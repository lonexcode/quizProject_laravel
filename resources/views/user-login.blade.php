<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-2xl text-center text-gray-800 mb-6">User Login</h2>

        {{-- Flash or Session Error --}}
        @if(Session('email'))
        <div class="bg-yellow-100 text-yellow-800 text-sm px-4 py-2 rounded mb-4">
            {{ Session('email') }}
        </div>
        @endif

        @if(Session('password'))
        <div class="bg-yellow-100 text-yellow-800 text-sm px-4 py-2 rounded mb-4">
            {{ Session('password') }}
        </div>
        @endif



        <form action="/user-login" method="post" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="text-gray-600 mb-1 block">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('email')
                <div class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <label for="password" class="text-gray-800 mb-1 block">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('password')
                <div class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 transition duration-200 rounded-2xl px-4 py-2 text-white font-semibold">
                Login
            </button>
        </form>
    </div>
</body>

</html>