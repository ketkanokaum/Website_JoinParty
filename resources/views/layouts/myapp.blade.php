<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoinParty</title>
    <link rel="stylesheet" href="/style_nav.css">


</style>
</head>
<body>

<nav>
    <div class="container-nav">
        <ul>
            <li><a href="{{ url('/dashboard') }}"><img src="/images/logo.png" alt=""></a></li>

            @auth
                <!-- เมื่อผู้ใช้เข้าสู่ระบบ -->
                <li><a href="{{ url('/dashboard') }}" style="margin-left: 100px;">หน้าแรก</a></li>
                <li><a href="#">กิจกรรมของของฉัน</a></li>
                <li><a href="{{ url('/favorites') }}">รายการโปรด</a></li>
                <li><a href="{{ url('/user/profile') }}">โปรไฟล์ของฉัน</a></li>
                <li class="unuser">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="out">ออกจากระบบ</button>
                    </form>
                </li>
            @else
                <!-- เมื่อผู้ใช้ยังไม่เข้าสู่ระบบ -->
                <li style="transform: translateX(790%);"><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">เข้าสู่ระบบ</a></li>
                @if (Route::has('register'))
                    <li style="transform: translateX(700%);"><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ลงชื่อเข้าใช้</a></li>
                @endif
            @endauth
        </ul>
    </div>
</nav>
<main>
    @yield('content')
</main>
</body>
</html>
