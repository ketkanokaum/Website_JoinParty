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


    <!-- Main content -->
    <section>
    <h1>Reviews</h1>
    @foreach($reviews as $review)
    
            <table>
                <tr>
                    <td class="profile">
                        <div class="img">
                            <img src="" alt="">
                        </div>
                        <span class="name">{{ $attendance->users->username }}</span><br>
                        <span class="email">Kaija@kkumail.com</span>
                    </td>
                    <td class="text">
                        <h5>15/04/2056</h5>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam voluptas delectus reprehenderit! Quas optio, amet voluptates, molestias nihil eaque numquam nesciunt ratione minus distinctio nam error aspernatur repudiandae odit ullam?
                    </td>
                </tr>
            </table>
      @endforeach

    <!-- หน้าปาร์ตี้ขึึ้น -->
    <div class="card" style="width: 18rem; margin-right: 10px;">
    <img src="./images/a2df086-dd63.jpg" class="card-img-top" alt="รูปการท่องเที่ยว">
    <div class="card-body">
        <h5 class="card-title">ชื่อปาร์ตี้</h5>
        <a href="#" class="btn" style="width: 250px; background-color: #999;">Review All</a>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
@endsection