<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class="text-2xl text-center text-gray-800 mb-6">Admin Login</h2>

        <form action="/admin-login" method="post" class="space-y-4">
            @csrf

            @error('user')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <div>
                <label for="admin_name" class="tex-gray-600 mb-2">Admin Name</label>
                <input type="text" name="admin_name" id="" placeholder="Enter Your Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
            </div>
            @error('admin_name')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <div>
                <label for="admin_password" class="tex-gray-600 mb-1">Admin Password</label>
                <input type="text" name="admin_password" id="" placeholder="Enter Admin Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-2xl focus:outline-none" />
            </div>
            @error('admin_password')
                <div class="text-red-500">
                    {{ $message }}
                </div>
            @enderror
            <button type="submit" class="w-full bg-blue-500 rounded-2xl px-4 py-2 text-white">Login</button>
        </form>
    </div>
</body>

</html>
