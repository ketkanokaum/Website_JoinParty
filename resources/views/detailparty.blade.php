@extends('layouts.myapp')
@section('content')

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

    <div class="container md-5">
        <!-- Main Content -->
        <div class="card p-4 shadow">
            <div class="row g-4">
                <!-- Image Section -->
                <div class="col-md-6">
                    <img src="{{ asset('party_images/' . $party->img) }}" alt="Even Image" width="600px" height="500px">
                </div>


                <div class="col-md-6">
                    <h2 class="mb-3">{{$party->party_name }}</h2>
                    <p>จำนวนผู้เข้าร่วม: <span class="text-muted">22/40 คน</span></p>
                    @php
                    $daysLeft = floor((strtotime($party->start_date) - time()) / 86400);
                    @endphp
                    @if($daysLeft > 0)
                    <p style="color:red;"><b>เหลือเวลารับสมัครอีก : </b> {{ $daysLeft }} วัน</p>
                    @else
                    <p style="color:red;"><b>หมดเวลารับสมัคร</b></p>
                    @endif
                    <ul class="list-unstyled">
                        <p>วันที่จัดกิจกรรม :
                                @if (date('Y-m-d', strtotime($party->start_date)) == date('Y-m-d', strtotime($party->end_date)))
                                    <!-- กรณีจัดกิจกรรมวันเดียว -->
                                    {{ date('d F', strtotime($party->start_date)) }} {{ date('Y', strtotime($party->start_date)) + 543 }}
                                @else
                                    <!-- กรณีจัดหลายวัน -->
                                    {{ date('d F', strtotime($party->start_date)) }} {{ date('Y', strtotime($party->start_date)) + 543 }} - 
                                    {{ date('d F', strtotime($party->end_date)) }} {{ date('Y', strtotime($party->end_date)) + 543 }}
                                @endif

                        </p>
                        <li>ตั้งแต่เวลา : {{ date('H:i', strtotime($party->start_time)) }} ถึง {{ date('H:i', strtotime($party->end_time)) }} น.</li>
                        <li> สถานที่ : {{$party->location }}</li>
                        <p>จังหวัด :  {{ $party->province }}</p>
                        <li>รายละเอียดกิจกรรม : {{$party->detail}}</li>
                    </ul>

                    <div class="d-flex align-items-center mt-4">
                    @if($daysLeft > 0)
                    @if(in_array($party->id, $joinAttendances))
                                <!-- กรณีที่ผู้ใช้เข้าร่วมแล้ว -->
                                <a class="btn me-2 join2 joined" style="color: green; cursor: default;">เข้าร่วมแล้ว</a>
                            @else
                                @auth
                                    <!-- กรณีผู้ใช้ล็อกอินและยังไม่ได้เข้าร่วม -->
                                    <a class="join" onclick="join({{ $party->id }})" style="color: blue; cursor: pointer;">เข้าร่วม</a>
                                @else
                                    <!-- กรณีผู้ใช้ไม่ได้ล็อกอิน -->
                                    <a class="expired disabled" style="color: gray; cursor: not-allowed;">หมดเขตรับสมัคร</a>
                                @endauth
                            @endif
                    @else
                            <!-- กรณีหมดเขตรับสมัครแล้ว -->
                            <a class="expired disabled" style="color: gray; cursor: not-allowed;">หมดเขตรับสมัคร</a>
                    @endif
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary me-4">ย้อนกลับ</a>
                            
        
                        <div id="favorite-button-{{ $party->id }}">
                        @if($isFavorite)
                            <!-- ฟอร์มลบรายการโปรด (หัวใจเต็ม) -->
                            <form action="{{ route('remove.favorite', ['id' => $party->id]) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: none; border: none;">
                                    <i class="bi bi-heart-fill text-danger" style="font-size: 1.5rem;"></i>
                                </button>
                            </form>
                        @else
                            <!-- ฟอร์มเพิ่มรายการโปรด (หัวใจว่าง) -->
                            <form action="{{ route('add.favorite') }}" method="POST">
                                @csrf
                                <input type="hidden" name="party_id" value="{{ $party->id }}">
                                <button type="submit" style="background: none; border: none;">
                                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                                </button>
                            </form>
                        @endif
                    </div>

                    </div>
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
            this.classList.toggle("text-danger"); // เปลี่ยนสีไอคอนด้วย
        });

          function join(id){
            if(confirm("คุณต้องการเข้าร่วมกิจกรรมนี้ใช่หรือไม่")){
                window.location.href="/join/" +id;
            }

        }
    </script>


</body>

</html>
@endsection