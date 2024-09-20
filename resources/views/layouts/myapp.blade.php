<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoinParty</title>
    <link rel="stylesheet" href="/style_home.css">
</head>
<body>
<nav>
        <div class="container-nav">
                <ul>
                    <li><a href="{{url('/dashboard')}}"><img src="/images/logo.png" alt=""></a></li>
                    <li><a href="{{url('/dashboard')}}" style="margin-left: 100px;">หน้าแรก</a></li>
                    <li><a href="#">กิจกรรมของของฉัน</a></li>
                    <li><a href="#">รายการโปรด</a></li>
                    <li><a href="{{url('/user/profile')}}">โปรไฟล์ของฉัน</a></li> 
                    <li class="unuser">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <img src="" alt="">ออกจากระบบ
                        </button>
                    </form>
</li>
                </ul>
        </div>
    </nav>
            <main>
            @yield('content')
            </main>
</body>
</html>