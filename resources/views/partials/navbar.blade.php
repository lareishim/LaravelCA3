<nav class="bg-gray-800 p-4 flex justify-between">
    <a href="/" class="text-xl font-bold">NBA Hub</a>

    <div class="flex gap-4">
        <a href="/players">Players</a>
        <a href="/teams">Teams</a>

        @auth
            <a href="/dashboard">Dashboard</a>
            <form action="/logout" method="POST">@csrf <button>Logout</button></form>
        @else
            <a href="/auth/google">Login with Google</a>
        @endauth
    </div>
</nav>
