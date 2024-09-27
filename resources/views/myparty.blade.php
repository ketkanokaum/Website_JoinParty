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

        @if(isset($myparty) && $myparty->count() > 0)
        @php
        $sortParties = $myparty->sortBy(function($attendance) {
        return strtotime($attendance->party->start_date);
        });
        @endphp

        @foreach($sortParties as $attendance)
        <div class="col col-lg-4">
            <div class="card">
                <img src="{{ asset('party_images/' . $attendance->party->img) }}" alt="Event Image" class="card-img-top" style="width: 100%; object-fit: cover;">
            </div>
            <div class="centent">
                <h5 class="card-title" style="font-weight: bold; color: #333;">{{ $attendance->party->party_name }}</h5>
                <ul class="list-unstyled">
                    <li>วันที่จัดกิจกรรม : <br>
                        @if (date('Y-m-d', strtotime($attendance->party->start_date)) == date('Y-m-d', strtotime($attendance->party->end_date)))
                        {{ date('d F', strtotime($attendance->party->start_date)) }} {{ date('Y', strtotime($attendance->party->start_date)) + 543 }}
                        @else
                        {{ date('d F', strtotime($attendance->party->start_date)) }} {{ date('Y', strtotime($attendance->party->start_date)) + 543 }} -
                        {{ date('d F', strtotime($attendance->party->end_date)) }} {{ date('Y', strtotime($attendance->party->end_date)) + 543 }}
                        @endif
                    </li>
                    @php
                    $daysLeft = floor((strtotime($attendance->party->start_date) - time()) / 86400);
                    @endphp
                    @if($daysLeft > 0)
                    <li style="color: #ff4b4b;">กิจกรรมจะเริ่มอีก: {{ $daysLeft }} วัน</li>
                    @else
                    <li style="color: #888;">กิจกรรมสิ้นสุดแล้ว</li>
                    @endif
                </ul>

                <!-- ปุ่มแสดงป๊อปอัพข้อมูลการติดต่อ -->
                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#contactModal{{ $attendance->party->id }}">
                    ข้อมูลการติดต่อ
                </button>

                <!-- Modal ข้อมูลการติดต่อ -->
                <div class="modal fade" id="contactModal{{ $attendance->party->id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $attendance->party->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="contactModalLabel{{ $attendance->party->id }}">ข้อมูลการติดต่อ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $attendance->party->contact }}</p>
                                <p>แอดเข้ากลุ่มไลน์:</p>
                                <img src="{{ asset('contact_images/' . $attendance->party->img_contact) }}" alt="Contact Image" class="img-fluid" style="border-radius: 8px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ปุ่มแสดงป๊อปอัพรีวิว -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $attendance->party->id }}">
                    รีวิว
                </button>

                <!-- Modal รีวิว -->
                <div class="modal fade" id="reviewModal{{ $attendance->party->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $attendance->party->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel{{ $attendance->party->id }}">รีวิวกิจกรรม</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h2 class="mb-3">{{ $attendance->party->party_name }}</h2>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="party_id" value="{{ $attendance->party->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div class="mb-3">
                                        <label  class="form-label">คะแนน</label>
                                        <!-- เพิ่ม name ให้กับ select -->
                                        <select name="rating" id="rating{{ $attendance->party->id }}" class="form-select" required>
                                            <option value="" disabled selected>เลือกคะแนน</option>
                                            <option value="5">5 - ดีเยี่ยม</option>
                                            <option value="4">4 - ดี</option>
                                            <option value="3">3 - พอใช้</option>
                                            <option value="2">2 - ไม่ดี</option>
                                            <option value="1">1 - แย่</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">ความคิดเห็น</label>
                                        <textarea name="review" id="review-text{{ $attendance->party->id }}" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">ส่งรีวิว</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <p>ไม่มีกิจกรรม</p>
        </div>
        @endif
    </div>

</body>

</html>
@endsection