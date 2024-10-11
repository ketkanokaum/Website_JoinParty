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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/style_myparty.css">
</head>

<body>
    <div class="button-head">
        <button type="button" class="btn btn-secondary mb-2 but" onclick="showUpcoming()">กิจกรรมตอนนี้</button>
        <button type="button" class="btn btn-secondary mb-2 but" onclick="showHistory()">ประวัติการเข้าร่วมกิจกรรม</button>
    </div>
    <!-- Upcoming Section -->
    <div class="row" id="upcomingSection">
        @if($upcomingParties->isEmpty())
        <div class="col-12 text-center">
            <p id="not-1">ไม่มีรายการกิจกรรมตอนนี้</p>
        </div>
        @else
        @foreach($upcomingParties as $attendance)
        <div class="col col-lg-4">
            <div class="card">
                <img src="{{ asset('party_images/' . $attendance->party->img) }}" alt="Event Image" class="card-img-top" style="width: 100%; object-fit: cover;">
            </div>

            <div class="content">
                <h5 class="card-title" style="font-weight: bold; color: #333;">{{ $attendance->party->party_name }}</h5>
                <ul class="list-unstyled">
                    @php
                    $currentDate = date('Y-m-d');
                    $startDate = $attendance->party->start_date;

                    $daysLeft = (strtotime($startDate) - strtotime($currentDate)) / 86400;
                    @endphp

                    @if($daysLeft > 0)
                    <li style="color: #ff4b4b;">
                        <small> กิจกรรมจะเริ่มอีก: {{ $daysLeft }} วัน</small>
                    </li>
                    @else
                    <li style="color: #888;">
                        <small>กิจกรรมสิ้นสุดแล้ว</small>
                    </li>
                    @endif
                    <li> วันที่จัดกิจกรรม :
                        @if (thaidate($attendance->party->start_date) == thaidate($attendance->party->end_date))
                        <!-- กรณีจัดกิจกรรมวันเดียว -->
                        {{ thaidate($attendance->party->start_date) }}
                        @else
                        <!-- กรณีจัดหลายวัน -->
                        {{ thaidate($attendance->party->start_date) }} ถึง {{ thaidate($attendance->party->end_date) }}
                        @endif

                    </li>
                </ul>
                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#contactModal{{ $attendance->party->id }}" style="width: 140px;">ข้อมูลการติดต่อ</button>
                @if($daysLeft > 1)
                <button type="button" class="btn btn-delete mb-2" onclick="confirmDelete({{ $attendance->id }})">ยกเลิกการเข้าร่วม</button>
                @endif
            </div>

            <!-- ข้อมูลการติดต่อ -->
            <div class="modal fade" id="contactModal{{ $attendance->party->id }}" tabindex="-1" aria-labelledby="contactModal{{ $attendance->party->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contactModal{{ $attendance->party->id }}">ข้อมูลการติดต่อ</h5>
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
        </div>
        @endforeach
        @endif
    </div>

    <!-- History Section -->
    <div class="row" id="historySection" style="display:none;">
        @if($pastParties->isEmpty())
        <div class="col-12 text-center">
            <p id="not-1">ไม่มีรายการประวัติการเข้าร่วมกิจกรรม</p>
        </div>
        @else
        @foreach($pastParties as $pastparty)
        <div class="col col-lg-4">
            <div class="card">
                <img src="{{ asset('party_images/'. $pastparty->party->img) }}" alt="Event Image" class="card-img-top">
            </div>
            <div class="content">
                <h5 class="card-title">{{ $pastparty->party->party_name }}</h5>
                <ul class="list-unstyled">
                    <li>กิจกรรมสิ้นสุดแล้ว</li>
                    <li>วันที่จัดกิจกรรม: {{ thaidate($pastparty->party->start_date) }} ถึง {{ thaidate($pastparty->party->end_date)}}</li>
                    <li>สถานที่: {{ $pastparty->party->location }}</li>
                    @if(isset($userReviews[$pastparty->party->id]))
                    <!-- แสดงปุ่มดูรีวิว ถ้าผู้ใช้มีรีวิวแล้ว -->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewReviewModal{{ $pastparty->party->id }}">
                        รีวิวของฉัน
                    </button>
                    @else
                    <!-- แสดงปุ่มรีวิว ถ้าผู้ใช้ยังไม่มีรีวิว -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $pastparty->party->id }}">
                        รีวิว
                    </button>
                    @endif






                    <!-- Modal แสดงรีวิวของผู้ใช้ -->
                    <div class="modal fade" id="viewReviewModal{{ $pastparty->party->id }}" tabindex="-1" aria-labelledby="viewReviewLabel{{ $pastparty->party->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewReviewLabel{{ $pastparty->party->id }}">รีวิวของคุณ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                    $review = isset($userReviews[$pastparty->party->id]) ? $userReviews[$pastparty->party->id] : null;
                                    @endphp

                                    @if($review)
                                    <div class="mb-3">
                                        <label class="form-label">คะแนน</label>
                                        <select name="rating" id="rating{{ $pastparty->party->id }}" class="form-select" disabled>
                                            <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - ดีเยี่ยม</option>
                                            <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - ดี</option>
                                            <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - พอใช้</option>
                                            <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - ไม่ดี</option>
                                            <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - แย่</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ความคิดเห็น</label>
                                        <textarea name="review" id="review-text{{ $pastparty->party->id }}" class="form-control" rows="4" disabled>{{ $review->review }}</textarea>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$reviews->isEmpty())
                    <button type="button" class="btn allreview" data-bs-toggle="modal" data-bs-target="#AllreviewModal{{ $pastparty->party->id }}">
                        รีวิวทั้งหมด
                    </button>

                    <!-- Modal แสดงรีวิวทั้งหมด -->
                    <div class="modal fade" id="AllreviewModal{{ $pastparty->party->id }}" tabindex="-1" aria-labelledby="AllreviewModal{{ $pastparty->party->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllreviewModal{{ $pastparty->party->id }}">{{ $pastparty->party->party_name }}</h5><br>
                                    <h6> ค่าเฉลี่ยคะแนน:
                                        @if(isset($avg_ratings[$pastparty->party->id]))
                                        {{ number_format($avg_ratings[$pastparty->party->id]->average_rating, 2) }}/5.00
                                        @else
                                        
                                        @endif
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @foreach($reviews->where('party_id', $pastparty->party->id) as $review)
                                    <div class="card mb-3" style="border: 2px solid #ddd; padding: 20px; width: 100%; border-radius: 8px;">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $review->attendance->user->username }}</h6>
                                            <p class="card-subtitle text-muted">{{ $review->attendance->user->email }}</p>
                                            <p><strong>วันที่รีวิว :</strong> {{ thaidate($review->attendance->created_at) }}</p>
                                            <p class="card-text"><strong>รีวิว :</strong> {{ $review->review }}</p>
                                            <p class="card-text"><strong>คะแนน :</strong> {{ number_format($review->rating, 2) }}/5.00</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <button type="button" class="btn allreview" data-bs-toggle="modal" data-bs-target="#AllreviewModal{{ $pastparty->party->id }}">
                        รีวิวทั้งหมด
                    </button>
                    <div class="modal fade" id="AllreviewModal{{ $pastparty->party->id }}" tabindex="-1" aria-labelledby="AllreviewModal{{ $pastparty->party->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllreviewModal{{ $pastparty->party->id }}">{{ $pastparty->party->party_name }}</h5><br>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="center"> ยังไม่มีข้อมูลการรีวิว</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

            </div>
        </div>

        <!-- Modal รีวิว -->
        <div class="modal fade" id="reviewModal{{ $pastparty->party->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $pastparty->party->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel{{ $pastparty->party->id }}">รีวิวกิจกรรม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="mb-3">{{ $pastparty->party->party_name }}</h2>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="party_id" value="{{ $pastparty->party->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <label class="form-label">คะแนน</label>
                                <select name="rating" id="rating{{ $pastparty->party->id }}" class="form-select" required>
                                    <option value="" disabled selected>เลือกคะแนน</option>
                                    <option value="5">5 - ดีเยี่ยม</option>
                                    <option value="4">4 - ดี</option>
                                    <option value="3">3 - พอใช้</option>
                                    <option value="2">2 - ไม่ดี</option>
                                    <option value="1">1 - แย่</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ความคิดเห็น</label>
                                <textarea name="review" id="review-text{{ $pastparty->party->id }}" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..." required></textarea>
                            </div>
                            <button onClick="alert('รีวิวเรียบร้อยแล้ว!')" type="submit" class="btn btn-primary">ส่งรีวิว</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>


    <script>
        function showUpcoming() {
            document.getElementById('upcomingSection').style.display = 'flex';
            document.getElementById('historySection').style.display = 'none';
        }

        function showHistory() {
            document.getElementById('upcomingSection').style.display = 'none';
            document.getElementById('historySection').style.display = 'flex';
        }

        function confirmDelete(id) {
            if (confirm("คุณต้องการยกเลิกการกิจกรรมนี้ใช่หรือไม่ ?")) {
                window.location.href = "/myparty/delete/" + id;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>
@endsection