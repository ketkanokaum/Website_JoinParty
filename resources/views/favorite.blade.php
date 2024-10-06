@extends('layouts.myapp')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Party</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/style_myparty.css">
</head>

<body>
    <div class="row">
        @if($favorites->isEmpty())
        <div class="col-12 text-center">
            <p>ยังไม่มีรายการโปรด</p>
        </div>
        @else
        @foreach($favorites as $favorite)
        <div class="col col-lg-4">
            <div class="card">
                <img src="{{ asset('party_images/' . $favorite->party->img) }}" alt="Event Image" class="card-img-top party-img">
            </div>
            <div class="centent">
                <h5>{{ $favorite->party->party_name }}</h5>
                <p>วันที่จัดกิจกรรม :
                    @if (thaidate($favorite->party->start_date) == thaidate($favorite->party->end_date))
                    <!-- กรณีจัดกิจกรรมวันเดียว -->
                    {{ thaidate($favorite->party->start_date) }}
                    @else
                    <!-- กรณีจัดหลายวัน -->
                    {{ thaidate($favorite->party->start_date) }} ถึง {{ thaidate($favorite->party->end_date) }}
                    @endif

                </p>
                @php
                $daysLeft = floor((strtotime($favorite->party->start_date) - time()) / 86400);
                @endphp
                @if($daysLeft > 0)
                <p style="color:red;">เหลือเวลาอีก : {{ $daysLeft }} วัน</p>
                @else
                <p style="color:red;">หมดเวลารับสมัคร</p>
                @endif
                <p>สถานที่: {{ $favorite->party->location }}</p>
                <p>เวลา: ตั้งแต่ {{ date('H:i', strtotime($favorite->party->start_time)) }} ถึง {{ date('H:i', strtotime($favorite->party->end_time)) }} น.</p>

                <div class="d-flex justify-content-between">
                    <div class="favorite-button-{{ $favorite->party->id }}">
                        <form action="{{ route('remove.favorite', $favorite->party->id) }}" method="POST">
                            @csrf
                            <button onClick="alert('ลบออกจากรายการโปรดแล้ว!')" type="submit" class="favorite-button btn">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    </div>

                    <div class="buttons">
                        <a href="{{ route('party.details', $favorite->party->id) }}" class="btn btn-warning data-btn me-2">ข้อมูลเพิ่มเติม</a>
                        @if($daysLeft > 0)
                        @if($favorite->party->attendees->count() == $favorite->party->numpeople)
                        <!-- กรณีผู้เข้าร่วมเต็ม -->
                        <p style="color: red;">เต็มแล้ว</p>
                        @else
                        @if(in_array($favorite->party->id, $joinAttendances))
                        <!-- กรณีผู้ใช้เข้าร่วมแล้ว -->
                        <a class="joined" style="color: green; cursor: default;">เข้าร่วมแล้ว</a>
                        @else
                        @auth
                        <a class="join" onclick="join({{ $favorite->party->id }})">เข้าร่วม</a>

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
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <script>
        function join(id) {
            if (confirm("คุณต้องการเข้าร่วมกิจกรรมนี้ใช่หรือไม่")) {
                window.location.href = "/join/" + id;
            }




        }
    </script>

</body>

</html>
@endsection