<nav class="bg-white shadow-md px-4 py-3">
    <div class="flex justify-between item-center">
        <div class="text-2xl text-green-900 hover:text-blue-500">
            QUIZ SYSTEM
        </div>
        <div class="space-x-4">
            <a href="/cateogaries" class="text-green-900 hover:text-green-800">Cateogaries</a>
            <a href="/" class="text-green-900 hover:text-green-800">Home</a>

            @if(Session('userDetails'))
            <a href="/users-details" class="text-green-900 hover:text-green-800">Welcome:{{Session('userDetails')->name}}</a>

            <a href="/user-logout" class="text-green-900 hover:text-green-800">Logout</a>
            @else
            <a href="/user-login" class="text-green-900 hover:text-green-800">Login</a>
            <a href="/user-signup" class="text-green-900 hover:text-green-800">Sign Up</a>
            @endif
            <a href="" class="text-green-900 hover:text-blue-500">Blog</a>
        </div>
    </div>
</nav>
