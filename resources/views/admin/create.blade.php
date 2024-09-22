@extends('layouts.myadmin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Created party</title>
  <link rel="stylesheet" href="/style_create.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
  .modal-content {
    width: 850px;
    position: relative;
    right: 170px;
  }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Main content -->
    <section>
      <h1>Created party</h1>
      <div class="search">
        <input id="search-input" type="text" placeholder="Search Praty Name" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2">
        <input id="submit-input" type="submit" value="GO">
      </div>
      
      <table>
        <thead>
          <tr>
            <th style="padding: 0;">
              <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@mdo">
                <img src="/images/บวก.png" alt="">
              </button>
            </th>
            <th>No</th>
            <th>ชื่อกิจกรรม</th>
            <th>วันที่จัดกิจกรรม</th>
            <th>จำนวนผู้เข้าร่วม</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          @foreach($parties as $party)
            <td style="padding: 0;">
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$party->id}}" data-bs-whatever="@mdo">
                    <img src="/images/ปะแจ.png" alt="Edit Party">
                </button>
            </td>
            <td>{{$party->id}}</td>
            <td>{{$party->party_name}}</td>
            <td>{{$party->date}}</td>
            <td>{{$party->numpeople}}</td>
          </tr>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </div>

  
  <!-- สร้างปาร์ตี้ -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">สร้างกิจกรรม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        <form action="{{ url('/admin/insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
                <label for="party-name">ชื่อกิจกรรม :</label>
                <input type="text" id="party-name" name="party_name" placeholder="กรอกชื่อปาร์ตี้">
            </div>

            <div class="form-group">
                <label for="party-date">วันที่จัดกิจกรรม :</label>
                <input type="date" id="party-date" name="date">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่เริ่มทำกิจกรรม :</label>
                <input type="Time" id="start" name="start_time">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่สิ้นสุด :</label>
                <input type="Time" id="end" name="end_time">
            </div>

            <div class="form-group">
                <label for="party-location">สถานที่จัดกิจกรรม :</label>
                <input type="text" id="party-location" name="location" placeholder="กรอกสถานที่จัดปาร์ตี้">
            </div>

            <div class="form-group">
                <label for="party-description">รายละเอียด:</label>
                <textarea id="party-description" name="detail" placeholder="รายละเอียดเพิ่มเติม"></textarea>
            </div>

            <div class="form-group">
                <label for="party-type">ประเภทของกิจกรรม:</label>
                <select id="party-type" name="party_type_id">
                @foreach($partyTypes as $partyType)
            <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
              @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
                <input type="number" id="party-guests" name="numpeople" placeholder="จำนวนผู้เข้าร่วม">
            </div>

            <div class="form-img">
              <label for="party-guests">รูปภาพกิจกรรม:</label><br>
              <input type="file" id="party-img" name="img" >
          </div>

            <div class="form-buttons">
                <button type="submit">ยืนยัน</button>
            </div>
        </form>

        </div>
      </div>
    </div>
  </div>

  <!-- แก้ไขปาร์ตี้!-->
  @foreach($parties as $party)
  <div class="modal fade" id="exampleModal{{$party->id}}" tabindex="-1" aria-labelledby="exampleModal{{$party->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModal{{$party->id}}">แก้ไขกิจกรรม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin.update', $party->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
                <label for="party-name">ชื่อกิจกรรม :</label>
                <input type="text" id="party-name" name="party_name"  value="{{$party->party_name}}" placeholder="กรอกชื่อปาร์ตี้">
            </div>

            <div class="form-group">
                <label for="party-date">วันที่จัดกิจกรรม :</label>
                <input type="date" id="party-date" name="date" value="{{$party->date}}">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่เริ่มทำกิจกรรม:</label>
                <input type="Time" id="start" name="start_time" value="{{$party->start_time}}">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่สิ้นสุด:</label>
                <input type="Time" id="end" name="end_time" value="{{$party->end_time}}">
            </div>

            <div class="form-group">
                <label for="party-location">สถานที่จัดกิจกรรม:</label>
                <input type="text" id="party-location" name="location" value="{{$party->location}}" placeholder="กรอกสถานที่จัดปาร์ตี้">
            </div>

            <div class="form-group">
                <label for="party-description">รายละเอียด:</label>
                <textarea id="party-description" name="detail" placeholder="รายละเอียดเพิ่มเติม">{{$party->detail}}</textarea>
            </div>

            <div class="form-group">
                <label for="party-type">ประเภทของกิจกรรม:</label>
                <select id="party-type" name="party_type_id" value="{{$party->type_party}}">
                @foreach($partyTypes as $partyType)
              <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
        @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
                <input type="number" id="party-guests" name="numpeople" value="{{$party->numpeople}}" placeholder="จำนวนผู้เข้าร่วม">
            </div>

            <div class="form-img">
              <label for="party-guests">รูปภาพกิจกรรม:</label><br>
              <input type="file" id="party-img" name="img" >
                </div>

            <div class="form-buttons">
                <button type="submit">ยืนยัน</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  
        </tbody>
      </table>
    </section>
  </div>
  </div> 
  @endforeach



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
@endsection