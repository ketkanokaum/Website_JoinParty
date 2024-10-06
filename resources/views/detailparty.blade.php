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
    <link rel="stylesheet" href="/detail.css">
</head>
<!-- กดดูข้อมูลเพิ่มเติมกิจกรรม -->

<body>

    <div class="container md-5">
        <div class="card p-4 shadow">
            <div class="row g-4">
                <div class="col-md-6">
                    <img src="{{ asset('party_images/' . $party->img) }}" alt="Event Image" width="100%" height="auto" class="img-fluid">
                </div>


                <div class="col-md-6">
                    <h2 class="mb-6">{{$party->party_name }}</h2>
                    <p>จำนวนผู้เข้าร่วมกิจกรรม : <span class="text-muted">{{ $party->attendees->count() }} / {{$party->numpeople}} คน</span></p>
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
                            @if (thaidate($party->start_date) == thaidate($party->end_date))
                            <!-- กรณีจัดกิจกรรมวันเดียว -->
                            {{ thaidate($party->start_date) }}
                            @else
                            <!-- กรณีจัดหลายวัน -->
                            {{ thaidate($party->start_date) }} ถึง {{ thaidate($party->end_date) }}
                            @endif


                        </p>
                        <li>ตั้งแต่เวลา : {{ date('H:i', strtotime($party->start_time)) }} ถึง {{ date('H:i', strtotime($party->end_time)) }} น.</li>
                        <li> สถานที่ : {{$party->location }}</li>
                        <p>จังหวัด : {{ $party->province }}</p>
                        <li>รายละเอียดกิจกรรม : {{$party->detail}}</li>
                    </ul>

                    <!--ลองทำ-->
                    <div class="button-container">
                        <div class="join mt-4">
                            @if($daysLeft > 0)
                            @if($party->attendees->count() == $party->numpeople)
                            <!-- กรณีผู้เข้าร่วมเต็ม -->
                            <p style="color: red;">เต็มแล้ว</p>
                            @else
                            @if(in_array($party->id, $joinAttendances))
                            <!-- กรณีผู้ใช้เข้าร่วมแล้ว -->
                            <a class="joined" style="color: green; cursor: default;">เข้าร่วมแล้ว</a>
                            @else
                            @auth
                            <a class="join" onclick="join({{ $party->id }})">เข้าร่วม</a>

                            @endauth
                            @guest
                            <!-- ยังไม่เข้าสู่ระบบ -->
                            @endguest
                            @endif
                            @endif
                            @else
                            <!-- หมดเขตรับสมัครแล้ว -->

                            @endif
                        </div>

                        <a href="{{ url('/') }}" class="btn-back">ย้อนกลับ</a>

                        <!-- ปุ่มหัวใจ (รายการโปรด) -->
                        @auth
                        <div id="favorite-button">
                            @if($isFavorite)
                            <form action="{{ route('remove.favorite', ['id' => $party->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button onClick="alert('ลบออกจากรายการโปรดแล้ว!')" type="submit" style="background: none; border: none;">
                                    <i id="favorite-icon" class="bi bi-heart-fill text-danger"></i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('add.favorite') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="party_id" value="{{ $party->id }}">
                                <button onClick="alert('เพิ่มลงในรายการโปรดแล้ว!')" type="submit" style="background: none; border: none;">
                                    <i id="favorite-icon" class="bi bi-heart"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                        @endauth
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

        function join(id) {
            if (confirm("คุณต้องการเข้าร่วมกิจกรรมนี้ใช่หรือไม่")) {
                window.location.href = "/join/" + id;
            }

        }
    </script>


</body>

</html>
@endsection