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
                    <p> วันที่จัดกิจกรรม :
                        @if (date('Y-m-d', strtotime($favorite->party->start_date)) == date('Y-m-d', strtotime($favorite->party->end_date)))
                            <!-- กรณีจัดกิจกรรมวันเดียว -->
                            {{ date('d F', strtotime($favorite->party->start_date)) }} {{ date('Y', strtotime($favorite->party->start_date)) + 543 }}
                        @else
                            <!-- กรณีจัดหลายวัน -->
                            {{ date('d F', strtotime($favorite->party->start_date)) }} {{ date('Y', strtotime($favorite->party->start_date)) + 543 }} - 
                            {{ date('d F', strtotime($favorite->party->end_date)) }} {{ date('Y', strtotime($favorite->party->end_date)) + 543 }}
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
                                <button type="submit" class="favorite-button {{ $favorite->isFavorite ? 'active' : '' }}">
                                    <i class="bi {{ $favorite->isFavorite ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                </button>
                            </form>
                        </div>

                        <div class="buttons">
                            @if($daysLeft > 0)
                                @auth
                                    <a href="{{ route('party.details', $favorite->party->id) }}" class="btn btn-warning data-btn me-2">ข้อมูลเพิ่มเติม</a>
                                    <button class="btn btn-success" onclick="join({{ $favorite->party->id }})">เข้าร่วม</button>
                                @else
                                    <a class="expired disabled" style="color: gray; cursor: not-allowed;">หมดเขตรับสมัคร</a>
                                @endauth
                            @else
                                <a class="expired disabled" style="color: gray; cursor: not-allowed;">หมดเขตรับสมัคร</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

</body>
</html>
@endsection