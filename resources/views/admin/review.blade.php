@extends('layouts.myadmin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review</title>
  <link rel="stylesheet" href="/style_review.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</head>
<body>
  <div class="wrapper">


    <!-- หน้าปาร์ตี้ขึึ้น
    <div class="card" style="width: 18rem; margin-right: 10px;">
    <div class="card-body">
    @if($reviews->isNotEmpty() && $reviews->first()->party)
            ดึงข้อมูลปาร์ตี้จากรีวิวแรกหากมี -->
            <!-- <h5 class="card-title">{{ $reviews->first()->party->party_name }}</h5>
        @else
            <h5 class="card-title">ยังไม่มีปาร์ตี้</h5>
        @endif
        <div>
    <a href="#" class="btn" id="reviewButton" style="width: 250px; background-color: #999;">Review All</a>
</div> --> 

<h1>Reviews</h1>
@if($reviews->isEmpty())
        <p>ยังไม่มีข้อมูลรีวิว</p>
@else
@foreach($reviews as $review)
    {{ $review->party->party_name }}
    {{ $review->user->username }}
    <h5>วันที่รีวิว: {{ date('d F', strtotime($review->created_at)) }} {{ date('Y', strtotime($review->created_at)) + 543 }}</h5>
    <p>{{ $review->review }}</p>
    <p>คะแนนรีวิว: {{ $review->rating }}</p>
    
@endforeach
@endif
<!-- <div id="reviewsSection" style="display: none;">
    @if($reviews->isEmpty())
        <p>ยังไม่มีข้อมูลรีวิว</p>
    @else
        @foreach($reviews as $review)
            <table>
                <tr>
                    <td class="profile">
                        @if($review->users)
                          
                            <span class="name">{{ $review->users->username }}</span><br>
                            <span class="email">{{ $review->users->email }}</span>
                        @else
                            <span class="name">ไม่พบข้อมูลผู้ใช้</span><br>
                        @endif
                    </td>
                    <td class="text">
                
                        <h5>วันที่รีวิว: {{ date('d F', strtotime($review->created_at)) }} {{ date('Y', strtotime($review->created_at)) + 543 }}</h5>
                        <p>{{ $review->review }}</p>
                        <p>คะแนนรีวิว: {{ $review->rating }}</p>
                    </td>
                </tr>
            </table>
        @endforeach
    @endif
</div>
</div> -->

<!-- 
<script>
    document.getElementById("reviewButton").addEventListener("click", function(event){
        event.preventDefault();
        var reviewsSection = document.getElementById("reviewsSection");
        if (reviewsSection.style.display === "none") {
            reviewsSection.style.display = "block";
        } else {
            reviewsSection.style.display = "none";
        }
    });
</script> -->

    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
@endsection