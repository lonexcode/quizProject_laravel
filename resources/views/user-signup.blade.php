<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Signup</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-navbar />

    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h2 class="text-2xl text-center text-gray-800 mb-6">User Sign Up</h2>

            <form action="/user-signup" method="POST" class="space-y-4">
                @csrf

                {{-- General error for 'user' --}}
                @error('user')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                {{-- Name Field --}}
                <div>
                    <label for="name" class="text-gray-600 mb-2 block">User Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="text-gray-600 mb-1 block">User Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="text-gray-600 mb-1 block">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password Field --}}
                <div>
                    <label for="password_confirmation" class="text-gray-600 mb-1 block">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirm_password" placeholder="Confirm Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
                    @error('password_confirmation')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 rounded-2xl px-4 py-2 text-white font-semibold">
                    Sign Up
                </button>
            </form>
        </div>
    </div>
</body>

</html>
