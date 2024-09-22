<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Party</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/join.css">
</head>
<!-- กดดูข้อมูลเพิ่มเติมกิจกรรม -->
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
                        <button type="submit" style="background: none; border: none; padding: 0;">ออกจากระบบ</button>
                    </form>
                </li>
            @else
                <!-- < เมื่อผู้ใช้ยังไม่เข้าสู่ระบบ  -->
                <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">เข้าสู่ระบบ</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ลงชื่อเข้าใช้</a></li>
                @endif
            @endauth
        </ul>
    </div>
</nav>


        <!-- Main Content -->
        <div class="card p-4 shadow">
            <div class="row g-4">
                <!-- Image Section -->
                <div class="col-md-6">
                    <img src="img-join-to-party/t8db9k4_home-decor-650_625x300_10_August_21.jpg" class="img-fluid rounded " alt="Party Image">
                </div>


                <div class="col-md-6">
                    <h2 class="mb-3">{{$party->party_name }}</h2>
                    <p>จำนวนผู้เข้าร่วม: <span class="text-muted">22/40 คน</span></p>
                    @php
                                $daysLeft = floor((strtotime($party->date) - time()) / 86400);
                                @endphp
                                @if($daysLeft > 0)
                                    <p style="color:red;"><b>เหลือเวลาอีก : </b> {{ $daysLeft }} วัน</p>
                                @else
                                    <p style="color:red;"><b>หมดเวลารับสมัคร</b></p>
                                @endif
                    <ul class="list-unstyled">
                        <li><strong>วันที่จัดกิจกรรม:</strong> {{ date('d F Y', strtotime($party->date)) }}</li>
                        <li><strong>เวลา:</strong> ตั้งแต่เวลา{{$party->start_time}} ถึง {{$party->end_time}}</li>
                        <li><strong>สถานที่:</strong> {{$party->location }}</li>
                        <li><strong>รายละเอียดกิจกรรม : </strong>{{$party->detail}}</li>
                    </ul>

                    <div class="d-flex align-items-center mt-4">
                        <button class="btn btn-success me-3">เข้าร่วม</button>
                        <a href="{{ url('/dashboard') }}"class="btn btn-outline-secondary me-4">ย้อนกลับ</a>
                @if($isFavorite)
                <!-- แสดงหัวใจที่ถูกกดไว้ (เต็ม) -->
                <form action="{{ route('remove.favorite', $party->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background: none; border: none;">
                        <i class="bi bi-heart-fill text-danger" style="font-size: 1.5rem;"></i>
                    </button>
                </form>
            @else
                <!-- แสดงหัวใจที่ยังไม่ได้กด (ว่าง) -->
                <form action="{{ route('add.favorite') }}" method="POST">
                    @csrf
                    <!-- <input type="hidden" name="user_id" value="{{ Auth::id() }}"> -->
                    <input type="hidden" name="party_id" value="{{ $party->id }}">
                    <button type="submit" style="background: none; border: none;">
                        <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                    </button>
                </form>
            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous">
    </script>
    <!-- กดหัวใจแล้วเปลี่ยนสีได้ -->
    <script>
        document.getElementById("favorite-icon").addEventListener("click", function() {
            this.classList.toggle("bi-heart");
            this.classList.toggle("bi-heart-fill");
            this.classList.toggle("text-danger");  // เปลี่ยนสีไอคอนด้วย
        });
    </script>


</body>
</html>