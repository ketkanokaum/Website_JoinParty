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
<div class="container mt-5">

    <div class="container mt-5">
        <div class="row">
        @foreach($favorites as $favorite)
            <div class="col-md-4">
                <div class="card party-card">
                    <img src="img-join-to-party/t8db9k4_home-decor-650_625x300_10_August_21.jpg" class="card-img-top party-img" alt="Party Image">
                    <div class="card-body">
                        <h5 class="card-title">{{$favorite->party->party_name }}</h5>
                        <p class="card-text">{{$favorite->party->date }}</p>
                        @php
                                $daysLeft = floor((strtotime($favorite->party->date) - time()) / 86400);
                                @endphp
                                @if($daysLeft > 0)
                                    <p style="color:red;"><b>เหลือเวลาอีก : </b> {{ $daysLeft }} วัน</p>
                                @else
                                    <p style="color:red;"><b>หมดเวลารับสมัคร</b></p>
                                @endif
                        <p class="card-text">สถานที่:{{$favorite->party->location }}</p>
                        <p class="card-text">เวลา: ตั้งแต่เวลา{{$favorite->party->start_time}} ถึง {{$favorite->party->end_time}}.</p>
                        <div class="d-flex justify-content-between">
                            <i id="favorite-icon" class="favorite-icon bi bi-heart" style="font-size: 1.5rem; cursor: pointer;"></i>
                            <div class="d-flex">
                                <!-- review-btn ต้องเขียนเพิ่มตามจำนวน card -->
                                <button class="btn btn-secondary review-btn" id="review-btn-1">รีวิว</button>
                                <button class="btn btn-warning data-btn me-2" data-bs-toggle="modal" data-bs-target="#dataModal1">ข้อมูลเพิ่มเติม</button>
                                <button class="btn btn-success">เข้าร่วม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Modal สำหรับการ์ด 1 -->
            <!-- ต้องกำหนด id, aria-labelledby จะได้เปิดหน้าต่างย่อยของแต่ละ card -->
            <div class="modal fade" id="reviewModal1" tabindex="-1" aria-labelledby="reviewModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- ต้องกำหนด id -->
                            <h3 class="modal-title" id="reviewModalLabel1">รีวิวกิจกรรม</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-3">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="img-join-to-party/t8db9k4_home-decor-650_625x300_10_August_21.jpg" class="img-fluid rounded" alt="Party Image">
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="mb-3">มาสิ มาปาร์ตี้</h2>
                                        <p class="text-muted">วันพฤหัสบดี ที่ 5 ธันวาคม 2567</p>
                                        <div class="mb-3">
                                            <!-- ต้องกำหนด rating ของแต่ละ card -->
                                            <label for="rating1" class="form-label">คะแนน</label>
                                            <select id="rating1" class="form-select">
                                                <option value="" disabled selected>เลือกคะแนน</option>
                                                <option value="5">5 - ดีเยี่ยม</option>
                                                <option value="4">4 - ดี</option>
                                                <option value="3">3 - พอใช้</option>
                                                <option value="2">2 - ไม่ดี</option>
                                                <option value="1">1 - แย่</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-text1" class="form-label">ความคิดเห็น</label>
                                            <textarea id="review-text1" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..."></textarea>
                                        </div>
                                        <button type="submit" id="submit-btn1" class="btn btn-primary btn-disabled">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card 1 -->
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card party-card">
                    <img src="img-join-to-party/three-hands-holding-young-plant-planting.jpg" class="card-img-top party-img" alt="Party Image">
                    <div class="card-body">
                        <h5 class="card-title">ปลูกต้นไม้</h5>
                        <p class="card-text">วันพฤหัสบดี ที่ 5 ธันวาคม 2567</p>
                        <p class="countdown text-danger">เวลาคงเหลือ: ... วัน</p>
                        <p class="card-text">สถานที่: ป่าชายเลนบางปู</p>
                        <p class="card-text">เวลา: 8:30 น.</p>
                        <div class="d-flex justify-content-between">
                            <i id="favorite-icon" class="favorite-icon bi bi-heart" style="font-size: 1.5rem; cursor: pointer;"></i>
                            <div class="d-flex">
                                <!-- review-btn ต้องเขียนเพิ่มตามจำนวน card -->
                                <button class="btn btn-secondary review-btn" id="review-btn-2">รีวิว</button>
                                <button class="btn btn-warning me-2">ข้อมูลเพิ่มเติม</button>
                                <button class="btn btn-success">เข้าร่วม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal สำหรับการ์ด 2 -->
            <!-- ต้องกำหนด id, aria-labelledby จะได้เปิดหน้าต่างย่อยของแต่ละ card -->
            <div class="modal fade" id="reviewModal2" tabindex="-1" aria-labelledby="reviewModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- ต้องกำหนด id -->
                            <h3 class="modal-title" id="reviewModalLabel2">รีวิวกิจกรรม</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-3">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="img-join-to-party/three-hands-holding-young-plant-planting.jpg" class="img-fluid rounded" alt="Party Image">
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="mb-3">ปลูกต้นไม้</h2>
                                        <p class="text-muted">วันพฤหัสบดี ที่ 5 ธันวาคม 2567</p>
                                        <div class="mb-3">
                                            <!-- ต้องกำหนด rating ของแต่ละ card -->
                                            <label for="rating2" class="form-label">คะแนน</label>
                                            <select id="rating2" class="form-select">
                                                <option value="" disabled selected>เลือกคะแนน</option>
                                                <option value="5">5 - ดีเยี่ยม</option>
                                                <option value="4">4 - ดี</option>
                                                <option value="3">3 - พอใช้</option>
                                                <option value="2">2 - ไม่ดี</option>
                                                <option value="1">1 - แย่</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-text2" class="form-label">ความคิดเห็น</label>
                                            <textarea id="review-text2" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..."></textarea>
                                        </div>
                                        <button type="submit" id="submit-btn2" class="btn btn-primary btn-disabled">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card 2 -->
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card party-card">
                    <img src="img-join-to-party/iq451e01af0c5fcbf2e4457c9a8166179e.jpg" class="card-img-top party-img" alt="Party Image">
                    <div class="card-body">
                        <h5 class="card-title">จิตอาสาเก็บขยะหาดดงตาล</h5>
                        <p class="card-text">วันพุธ ที่ 31 สิงหาคม 2567</p>
                        <p class="countdown text-danger">เวลาคงเหลือ: ... วัน</p>
                        <p class="card-text">สถานที่: เกาะยอ สัตหีบ</p>
                        <p class="card-text">เวลา: 9:00 น.</p>
                        <div class="d-flex justify-content-between">
                            <i id="favorite-icon" class="favorite-icon bi bi-heart" style="font-size: 1.5rem; cursor: pointer;"></i>
                            <div class="d-flex">
                                <!-- review-btn ต้องเขียนเพิ่มตามจำนวน card -->
                                <button class="btn btn-secondary review-btn" id="review-btn-3">รีวิว</button>
                                <button class="btn btn-warning me-2">ข้อมูลเพิ่มเติม</button>
                                <button class="btn btn-success">เข้าร่วม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal สำหรับการ์ด 3 -->
            <!-- ต้องกำหนด id, aria-labelledby จะได้เปิดหน้าต่างย่อยของแต่ละ card -->
            <div class="modal fade" id="reviewModal3" tabindex="-1" aria-labelledby="reviewModalLabel3" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- ต้องกำหนด id -->
                            <h3 class="modal-title" id="reviewModalLabel3">รีวิวกิจกรรม</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-3">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="img-join-to-party/iq451e01af0c5fcbf2e4457c9a8166179e.jpg" class="img-fluid rounded" alt="Party Image">
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="mb-3">จิตอาสาเก็บขยะหาดดงตาล</h2>
                                        <p class="text-muted">วันพุธ ที่ 31 สิงหาคม 2567</p>
                                        <div class="mb-3">
                                            <!-- ต้องกำหนด rating ของแต่ละ card -->
                                            <label for="rating3" class="form-label">คะแนน</label>
                                            <select id="rating3" class="form-select">
                                                <option value="" disabled selected>เลือกคะแนน</option>
                                                <option value="5">5 - ดีเยี่ยม</option>
                                                <option value="4">4 - ดี</option>
                                                <option value="3">3 - พอใช้</option>
                                                <option value="2">2 - ไม่ดี</option>
                                                <option value="1">1 - แย่</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-text3" class="form-label">ความคิดเห็น</label>
                                            <textarea id="review-text3" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..."></textarea>
                                        </div>
                                        <button type="submit" id="submit-btn3" class="btn btn-primary btn-disabled">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card 3 -->
            
            <!-- Card 4 -->
            <div class="col-md-4">
                <div class="card party-card">
                    <img src="img-join-to-party/gettyimages-1183414292-1-_slide-30784f99ac10f059c242d37e91d05ead475854f4.jpg" class="card-img-top party-img" alt="Party Image">
                    <div class="card-body">
                        <h5 class="card-title">test</h5>
                        <p class="card-text">วันพุธ ที่ 31 ธันวาคม 2566</p>
                        <p class="countdown text-danger">เวลาคงเหลือ: ... วัน</p>
                        <p class="card-text">สถานที่: มหาวิทยาลัยขอนแก่น</p>
                        <p class="card-text">เวลา: 8:00 น.</p>
                        <div class="d-flex justify-content-between">
                            <i id="favorite-icon" class="favorite-icon bi bi-heart" style="font-size: 1.5rem; cursor: pointer;"></i>
                            <div class="d-flex">
                                <!-- review-btn ต้องเขียนเพิ่มตามจำนวน card -->
                                <button class="btn btn-secondary review-btn" id="review-btn-4">รีวิว</button>
                                <button class="btn btn-warning me-2">ข้อมูลเพิ่มเติม</button>
                                <button class="btn btn-success">เข้าร่วม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal สำหรับการ์ด 4 -->
            <!-- ต้องกำหนด id, aria-labelledby จะได้เปิดหน้าต่างย่อยของแต่ละ card -->
            <div class="modal fade" id="reviewModal4" tabindex="-1" aria-labelledby="reviewModalLabel4" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- ต้องกำหนด id -->
                            <h3 class="modal-title" id="reviewModalLabel4">รีวิวกิจกรรม</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-3">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="img-join-to-party/gettyimages-1183414292-1-_slide-30784f99ac10f059c242d37e91d05ead475854f4.jpg" class="img-fluid rounded" alt="Party Image">
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="mb-3">test</h2>
                                        <p class="text-muted">วันพุธ ที่ 31 ธันวาคม 2566</p>
                                        <div class="mb-3">
                                            <!-- ต้องกำหนด rating ของแต่ละ card -->
                                            <label for="rating4" class="form-label">คะแนน</label>
                                            <select id="rating4" class="form-select">
                                                <option value="" disabled selected>เลือกคะแนน</option>
                                                <option value="5">5 - ดีเยี่ยม</option>
                                                <option value="4">4 - ดี</option>
                                                <option value="3">3 - พอใช้</option>
                                                <option value="2">2 - ไม่ดี</option>
                                                <option value="1">1 - แย่</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-text3" class="form-label">ความคิดเห็น</label>
                                            <textarea id="review-text3" class="form-control" rows="4" placeholder="เขียนความคิดเห็นของคุณที่นี่..."></textarea>
                                        </div>
                                        <button type="submit" id="submit-btn3" class="btn btn-primary btn-disabled">ส่งรีวิว</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card 4 -->
            
        </div>
    </div>
</div>
    
    
</body>
</html>
@endsection