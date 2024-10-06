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
      <h1>จัดการกิจกรรม</h1>
      <div class="search">
        <form action="{{ url('/admin/searchparty') }}" method="GET">
          <input id="search-input" type="text" name="query" placeholder="ค้นหากิจกรรม" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2">
          <input id="submit-input" type="submit" value="ค้นหา">
        </form>

      </div>

      <div class="ceate-bt">
        <button type="button" class="btn btn ceat" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16" style="margin: 0px 10px 5px;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
          </svg>สร้างกิจกรรม
        </button>
        <form action="{{ route('admin.searchparty') }}" method="GET" class="fromm">
          <button type="submit" name="sort" value="asc">มากไปน้อย
          </button>
          <button type="submit" name="sort" value="desc">น้อยไปมาก

          </button>
        </form>
      </div>

      @if($parties->count())
      <table style=" border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <thead>
          <tr>
            <th style=" border-top-left-radius: 10px;">ID</th>
            <th>ชื่อกิจกรรม</th>
            <th>วันที่จัดกิจกรรม</th>
            <th>จำนวนผู้เข้าร่วม</th>
            <th></th>
            <th></th>
            <th style=" border-top-right-radius: 10px;"></th>
          </tr>
        </thead>
        <tbody>
          <!-- กิจกรรมที่กำลังจะมาถึง -->
          @foreach($parties as $party)
          <tr>
            <td>{{ $party->id }}</td>
            <td>
              <button class="transparent-btn" data-bs-toggle="modal" data-bs-target="#partyModal{{ $party->id }}">
                {{ $party->party_name }}
              </button>
            </td>
            <td>{{ thaidate($party->start_date) }}</td>
            <td>{{ $party->joined_count }} / {{ $party->numpeople }}</td>

            @php
            $daysLeft = floor((strtotime($party->start_date) - time()) / 86400);
            $daysEnd = floor((strtotime($party->end_date) - time()) / 86400);
            @endphp

            <td style="padding: 0 5px;">
              @if($daysLeft > 0)
              <button type="button" class="table-bt" data-bs-toggle="modal" data-bs-target="#exampleModal{{$party->id}}">
                แก้ไข
              </button>
              @else
              <button type="button" class="table-bt" disabled>แก้ไข</button>
              @endif
            </td>
            <td style="padding: 0 5px;">
              @if($daysLeft > 0)
              <button type="button" class="table-bt-t" onclick="confirmDelete({{ $party->id }})">ลบ</button>
              @else
              <button type="button" class="table-bt-t" disabled>ลบ</button>
              @endif
            </td>
            <td>
              @if($daysLeft > 0)
              <p style="color: #008000; text-align: right;">อยู่ระหว่างการรับสมัคร</p>
              @elseif($daysLeft <= 0 && $daysEnd>= 0)
                <p style="color: #ffa500; text-align: right;">อยู่ระหว่างการจัดกิจกรรม</p>
                @else
                <p style="color: #ee6464;">หมดเวลารับสมัคร</p>
                @endif
            </td>
          </tr>

          <!-- Modal สำหรับแต่ละกิจกรรม -->
          <div class="modal fade" id="partyModal{{ $party->id }}" tabindex="-1" aria-labelledby="partyModalLabel{{ $party->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="partyModalLabel{{ $party->id }}">{{ $party->party_name }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card mb-3">
                  <div class="card-body">
                    <p>จำนวนผู้เข้าร่วม: {{$party->joined_count}} / {{ $party->numpeople }} คน</p>

                    @foreach($party->attendees as $attendee)
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">ชื่อผู้ใช้: {{ $attendee->username }}</h5>
                        <p class="card-text">ชื่อ - นามสกุล: {{ $attendee->firstname }} {{ $attendee->lastname }}</p>
                        <p class="card-text">อีเมล: {{ $attendee->email }}</p>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
    
        </tbody>
      </table>


    </section>
  </div>

  <!-- สร้างปาร์ตี้ -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">สร้างกิจกรรม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{ url('/admin/insert') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm({{ $party->id ?? '' }})">
            @csrf
            <div class="form-group">
              <label for="party-name">ชื่อกิจกรรม :</label>
              <input type="text" id="party-name" name="party_name" placeholder="กรอกชื่อกิจกรรม" required>
            </div>

            <div class="form-group">
              <label for="party-date">วันที่จัดกิจกรรม :</label>
              <input type="date" id="party-date" name="start_date" required>
            </div>
            <div class="form-group">
              <label for="party-date">วันที่สิ้นสุดกิจกรรม :</label>
              <input type="date" id="party-end-date" name="end_date" required>
            </div>

            <div class="form-group">
              <label for="party-date">เวลาที่เริ่มทำกิจกรรม :</label>
              <input type="Time" id="start-time" name="start_time" required>
            </div>

            <div class="form-group">
              <label for="party-date">เวลาที่สิ้นสุด :</label>
              <input type="Time" id="end-time" name="end_time" required>
            </div>

            <div class="form-group">
              <label for="party-type">จังหวัด:</label required>
              <select id="province" name="province">
                <option value="">จังหวัด</option>
                <option value="กระบี่">กระบี่</option>
                <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                <option value="กาญจนบุรี">กาญจนบุรี</option>
                <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                <option value="กำแพงเพชร">กำแพงเพชร</option>
                <option value="ขอนแก่น">ขอนแก่น</option>
                <option value="จันทบุรี">จันทบุรี</option>
                <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                <option value="ชลบุรี">ชลบุรี</option>
                <option value="ชัยนาท">ชัยนาท</option>
                <option value="ชัยภูมิ">ชัยภูมิ</option>
                <option value="ชุมพร">ชุมพร</option>
                <option value="ตรัง">ตรัง</option>
                <option value="ตราด">ตราด</option>
                <option value="ตาก">ตาก</option>
                <option value="นครนายก">นครนายก</option>
                <option value="นครปฐม">นครปฐม</option>
                <option value="นครพนม">นครพนม</option>
                <option value="นครราชสีมา">นครราชสีมา</option>
                <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                <option value="นครสวรรค์">นครสวรรค์</option>
                <option value="นนทบุรี">นนทบุรี</option>
                <option value="นราธิวาส">นราธิวาส</option>
                <option value="น่าน">น่าน</option>
                <option value="บึงกาฬ">บึงกาฬ</option>
                <option value="บุรีรัมย์">บุรีรัมย์</option>
                <option value="ปทุมธานี">ปทุมธานี</option>
                <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                <option value="ปัตตานี">ปัตตานี</option>
                <option value="พะเยา">พะเยา</option>
                <option value="พังงา">พังงา</option>
                <option value="พัทลุง">พัทลุง</option>
                <option value="พิจิตร">พิจิตร</option>
                <option value="พิษณุโลก">พิษณุโลก</option>
                <option value="เพชรบุรี">เพชรบุรี</option>
                <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                <option value="แพร่">แพร่</option>
                <option value="ภูเก็ต">ภูเก็ต</option>
                <option value="มหาสารคาม">มหาสารคาม</option>
                <option value="มุกดาหาร">มุกดาหาร</option>
                <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                <option value="ยโสธร">ยโสธร</option>
                <option value="ยะลา">ยะลา</option>
                <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                <option value="ระนอง">ระนอง</option>
                <option value="ระยอง">ระยอง</option>
                <option value="ราชบุรี">ราชบุรี</option>
                <option value="ลพบุรี">ลพบุรี</option>
                <option value="ลำปาง">ลำปาง</option>
                <option value="ลำพูน">ลำพูน</option>
                <option value="เลย">เลย</option>
                <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                <option value="สกลนคร">สกลนคร</option>
                <option value="สงขลา">สงขลา</option>
                <option value="สตูล">สตูล</option>
                <option value="สมุทรปราการ">สมุทรปราการ</option>
                <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                <option value="สมุทรสาคร">สมุทรสาคร</option>
                <option value="สระแก้ว">สระแก้ว</option>
                <option value="สระบุรี">สระบุรี</option>
                <option value="สิงห์บุรี">สิงห์บุรี</option>
                <option value="สุโขทัย">สุโขทัย</option>
                <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                <option value="สุรินทร์">สุรินทร์</option>
                <option value="หนองคาย">หนองคาย</option>
                <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                <option value="อุดรธานี">อุดรธานี</option>
                <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                <option value="อุทัยธานี">อุทัยธานี</option>
                <option value="อุบลราชธานี">อุบลราชธานี</option>
              </select>
            </div>


            <div class="form-group">
              <label for="party-location">สถานที่จัดกิจกรรม :</label>
              <input type="text" id="location" name="location" placeholder="กรอกสถานที่จัดกิจกรรม" required>
            </div>

            <div class="form-group">
              <label for="party-description">รายละเอียด:</label>
              <textarea id="detail" name="detail" placeholder="รายละเอียดเพิ่มเติม" required></textarea>
            </div>

            <div class="form-group">
              <label for="party-type">ประเภทของกิจกรรม:</label>
              <select id="party-type" name="party_type_id" required>
                @foreach($partyTypes as $partyType)
                <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
              <input type="number" id="party-guests" name="numpeople" placeholder="จำนวนผู้เข้าร่วม" required>
            </div>

            <div class="form-img">
              <label for="party-guests">รูปภาพกิจกรรม:</label><br>
              <input type="file" id="party-img" name="img" required>
            </div>

            <div class="form-group">
              <label for="party-contact">ช่องทางการติดต่อ:</label>
              <textarea id="contact" name="contact" placeholder="ช่องทางการติดต่อ" required></textarea>
            </div>

            <div class="form-img">
              <label for="party-guests">คิวอาร์โค้ด:</label><br>
              <input type="file" id="party-img_contact" name="img_contact">
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
            @method('POST')
            <div class="form-group">
              <label for="party-name">ชื่อกิจกรรม :</label>
              <input type="text" id="party-name" name="party_name" value="{{$party->party_name}}" placeholder="กรอกชื่อปาร์ตี้" required>
            </div>

            <div class="form-group">
              <label for="party-date">วันที่จัดกิจกรรม :</label>
              <input type="date" id="party-date" name="start_date" value="{{$party->start_date}}" required>
            </div>

            <div class="form-group">
              <label for="party-date">วันที่สิ้นสุดกิจกรรม :</label>
              <input type="date" id="party-end-date" name="end_date" value="{{$party->end_date}}" required>
            </div>


            <div class="form-group">
              <label for="party-date">เวลาที่เริ่มทำกิจกรรม:</label>
              <input type="Time" id="start-time" name="start_time" value="{{$party->start_time}}" required>
            </div>

            <div class="form-group">
              <label for="party-date">เวลาที่สิ้นสุด:</label>
              <input type="Time" id="end-time" name="end_time" value="{{$party->end_time}}" required>
            </div>

            <div class="form-group">
              <label for="party-type">จังหวัด:</label>
              <select id="province" name="province" required>
                <option value="">เลือกจังหวัด</option>
                <option value="กระบี่" {{ $party->province == 'กระบี่' ? 'selected' : '' }}>กระบี่</option>
                <option value="กรุงเทพมหานคร" {{ $party->province == 'กรุงเทพมหานคร' ? 'selected' : '' }}>กรุงเทพมหานคร</option>
                <option value="กาญจนบุรี" {{ $party->province == 'กาญจนบุรี' ? 'selected' : '' }}>กาญจนบุรี</option>
                <option value="กาฬสินธุ์" {{ $party->province == 'กาฬสินธุ์' ? 'selected' : '' }}>กาฬสินธุ์</option>
                <option value="กำแพงเพชร" {{ $party->province == 'กำแพงเพชร' ? 'selected' : '' }}>กำแพงเพชร</option>
                <option value="ขอนแก่น" {{ $party->province == 'ขอนแก่น' ? 'selected' : '' }}>ขอนแก่น</option>
                <option value="จันทบุรี" {{ $party->province == 'จันทบุรี' ? 'selected' : '' }}>จันทบุรี</option>
                <option value="ฉะเชิงเทรา" {{ $party->province == 'ฉะเชิงเทรา' ? 'selected' : '' }}>ฉะเชิงเทรา</option>
                <option value="ชลบุรี" {{ $party->province == 'ชลบุรี' ? 'selected' : '' }}>ชลบุรี</option>
                <option value="ชัยนาท" {{ $party->province == 'ชัยนาท' ? 'selected' : '' }}>ชัยนาท</option>
                <option value="ชัยภูมิ" {{ $party->province == 'ชัยภูมิ' ? 'selected' : '' }}>ชัยภูมิ</option>
                <option value="ชุมพร" {{ $party->province == 'ชุมพร' ? 'selected' : '' }}>ชุมพร</option>
                <option value="ตรัง" {{ $party->province == 'ตรัง' ? 'selected' : '' }}>ตรัง</option>
                <option value="ตราด" {{ $party->province == 'ตราด' ? 'selected' : '' }}>ตราด</option>
                <option value="ตาก" {{ $party->province == 'ตาก' ? 'selected' : '' }}>ตาก</option>
                <option value="นครนายก" {{ $party->province == 'นครนายก' ? 'selected' : '' }}>นครนายก</option>
                <option value="นครปฐม" {{ $party->province == 'นครปฐม' ? 'selected' : '' }}>นครปฐม</option>
                <option value="นครพนม" {{ $party->province == 'นครพนม' ? 'selected' : '' }}>นครพนม</option>
                <option value="นครราชสีมา" {{ $party->province == 'นครราชสีมา' ? 'selected' : '' }}>นครราชสีมา</option>
                <option value="นครศรีธรรมราช" {{ $party->province == 'นครศรีธรรมราช' ? 'selected' : '' }}>นครศรีธรรมราช</option>
                <option value="นครสวรรค์" {{ $party->province == 'นครสวรรค์' ? 'selected' : '' }}>นครสวรรค์</option>
                <option value="นนทบุรี" {{ $party->province == 'นนทบุรี' ? 'selected' : '' }}>นนทบุรี</option>
                <option value="นราธิวาส" {{ $party->province == 'นราธิวาส' ? 'selected' : '' }}>นราธิวาส</option>
                <option value="น่าน" {{ $party->province == 'น่าน' ? 'selected' : '' }}>น่าน</option>
                <option value="บึงกาฬ" {{ $party->province == 'บึงกาฬ' ? 'selected' : '' }}>บึงกาฬ</option>
                <option value="บุรีรัมย์" {{ $party->province == 'บุรีรัมย์' ? 'selected' : '' }}>บุรีรัมย์</option>
                <option value="ปทุมธานี" {{ $party->province == 'ปทุมธานี' ? 'selected' : '' }}>ปทุมธานี</option>
                <option value="ปราจีนบุรี" {{ $party->province == 'ปราจีนบุรี' ? 'selected' : '' }}>ปราจีนบุรี</option>
                <option value="ประจวบคีรีขันธ์" {{ $party->province == 'ประจวบคีรีขันธ์' ? 'selected' : '' }}>ประจวบคีรีขันธ์</option>
                <option value="ปัตตานี" {{ $party->province == 'ปัตตานี' ? 'selected' : '' }}>ปัตตานี</option>
                <option value="พะเยา" {{ $party->province == 'พะเยา' ? 'selected' : '' }}>พะเยา</option>
                <option value="พังงา" {{ $party->province == 'พังงา' ? 'selected' : '' }}>พังงา</option>
                <option value="พัทลุง" {{ $party->province == 'พัทลุง' ? 'selected' : '' }}>พัทลุง</option>
                <option value="พิจิตร" {{ $party->province == 'พิจิตร' ? 'selected' : '' }}>พิจิตร</option>
                <option value="พิษณุโลก" {{ $party->province == 'พิษณุโลก' ? 'selected' : '' }}>พิษณุโลก</option>
                <option value="เพชรบุรี" {{ $party->province == 'เพชรบุรี' ? 'selected' : '' }}>เพชรบุรี</option>
                <option value="เพชรบูรณ์" {{ $party->province == 'เพชรบูรณ์' ? 'selected' : '' }}>เพชรบูรณ์</option>
                <option value="แพร่" {{ $party->province == 'แพร่' ? 'selected' : '' }}>แพร่</option>
                <option value="ภูเก็ต" {{ $party->province == 'ภูเก็ต' ? 'selected' : '' }}>ภูเก็ต</option>
                <option value="มหาสารคาม" {{ $party->province == 'มหาสารคาม' ? 'selected' : '' }}>มหาสารคาม</option>
                <option value="มุกดาหาร" {{ $party->province == 'มุกดาหาร' ? 'selected' : '' }}>มุกดาหาร</option>
                <option value="แม่ฮ่องสอน" {{ $party->province == 'แม่ฮ่องสอน' ? 'selected' : '' }}>แม่ฮ่องสอน</option>
                <option value="ยโสธร" {{ $party->province == 'ยโสธร' ? 'selected' : '' }}>ยโสธร</option>
                <option value="ยะลา" {{ $party->province == 'ยะลา' ? 'selected' : '' }}>ยะลา</option>
                <option value="ร้อยเอ็ด" {{ $party->province == 'ร้อยเอ็ด' ? 'selected' : '' }}>ร้อยเอ็ด</option>
                <option value="ระนอง" {{ $party->province == 'ระนอง' ? 'selected' : '' }}>ระนอง</option>
                <option value="ระยอง" {{ $party->province == 'ระยอง' ? 'selected' : '' }}>ระยอง</option>
                <option value="ราชบุรี" {{ $party->province == 'ราชบุรี' ? 'selected' : '' }}>ราชบุรี</option>
                <option value="ลพบุรี" {{ $party->province == 'ลพบุรี' ? 'selected' : '' }}>ลพบุรี</option>
                <option value="ลำปาง" {{ $party->province == 'ลำปาง' ? 'selected' : '' }}>ลำปาง</option>
                <option value="ลำพูน" {{ $party->province == 'ลำพูน' ? 'selected' : '' }}>ลำพูน</option>
                <option value="เลย" {{ $party->province == 'เลย' ? 'selected' : '' }}>เลย</option>
                <option value="ศรีสะเกษ" {{ $party->province == 'ศรีสะเกษ' ? 'selected' : '' }}>ศรีสะเกษ</option>
                <option value="สกลนคร" {{ $party->province == 'สกลนคร' ? 'selected' : '' }}>สกลนคร</option>
                <option value="สงขลา" {{ $party->province == 'สงขลา' ? 'selected' : '' }}>สงขลา</option>
                <option value="สตูล" {{ $party->province == 'สตูล' ? 'selected' : '' }}>สตูล</option>
                <option value="สมุทรปราการ" {{ $party->province == 'สมุทรปราการ' ? 'selected' : '' }}>สมุทรปราการ</option>
                <option value="สมุทรสงคราม" {{ $party->province == 'สมุทรสงคราม' ? 'selected' : '' }}>สมุทรสงคราม</option>
                <option value="สมุทรสาคร" {{ $party->province == 'สมุทรสาคร' ? 'selected' : '' }}>สมุทรสาคร</option>
                <option value="สระแก้ว" {{ $party->province == 'สระแก้ว' ? 'selected' : '' }}>สระแก้ว</option>
                <option value="สระบุรี" {{ $party->province == 'สระบุรี' ? 'selected' : '' }}>สระบุรี</option>
                <option value="สิงห์บุรี" {{ $party->province == 'สิงห์บุรี' ? 'selected' : '' }}>สิงห์บุรี</option>
                <option value="สุโขทัย" {{ $party->province == 'สุโขทัย' ? 'selected' : '' }}>สุโขทัย</option>
                <option value="สุพรรณบุรี" {{ $party->province == 'สุพรรณบุรี' ? 'selected' : '' }}>สุพรรณบุรี</option>
                <option value="สุราษฎร์ธานี" {{ $party->province == 'สุราษฎร์ธานี' ? 'selected' : '' }}>สุราษฎร์ธานี</option>
                <option value="สุรินทร์" {{ $party->province == 'สุรินทร์' ? 'selected' : '' }}>สุรินทร์</option>
                <option value="หนองคาย" {{ $party->province == 'หนองคาย' ? 'selected' : '' }}>หนองคาย</option>
                <option value="หนองบัวลำภู" {{ $party->province == 'หนองบัวลำภู' ? 'selected' : '' }}>หนองบัวลำภู</option>
                <option value="อำนาจเจริญ" {{ $party->province == 'อำนาจเจริญ' ? 'selected' : '' }}>อำนาจเจริญ</option>
                <option value="อุดรธานี" {{ $party->province == 'อุดรธานี' ? 'selected' : '' }}>อุดรธานี</option>
                <option value="อุตรดิตถ์" {{ $party->province == 'อุตรดิตถ์' ? 'selected' : '' }}>อุตรดิตถ์</option>
                <option value="อุทัยธานี" {{ $party->province == 'อุทัยธานี' ? 'selected' : '' }}>อุทัยธานี</option>
                <option value="อุบลราชธานี" {{ $party->province == 'อุบลราชธานี' ? 'selected' : '' }}>อุบลราชธานี</option>
              </select>
            </div>

            <div class="form-group">
              <label for="party-location">สถานที่จัดกิจกรรม:</label>
              <input type="text" id="location" name="location" value="{{$party->location}}" placeholder="กรอกสถานที่จัดปาร์ตี้" required>
            </div>

            <div class="form-group">
              <label for="party-description">รายละเอียด:</label>
              <textarea id="detail" name="detail" placeholder="รายละเอียดเพิ่มเติม" required>{{$party->detail}}</textarea>
            </div>

            <div class="form-group">
              <label for="party-type">ประเภทของกิจกรรม:</label>
              <select id="party-type" name="party_type_id" value="{{$party->type_party}}" required>
                @foreach($partyTypes as $partyType)
                <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
              <input type="number" id="party-guests" name="numpeople" value="{{$party->numpeople}}" placeholder="จำนวนผู้เข้าร่วม" required>
            </div>

            <div class="form-group">
              <label for="img">รูปภาพกิจกรรม:</label><br>

              @if($party->img)
              <!-- แสดงรูปภาพที่มีอยู่แล้ว -->
              <img src="{{ asset('party_images/' . $party->img) }}" alt="Current Image" width="200px"><br>
              @endif

              <input type="file" id="party-img" name="img">
            </div>

            <div class="form-group">
              <label for="party-contact">ช่องทางการติดต่อ:</label>
              <textarea id="contact" name="contact" placeholder="ช่องทางการติดต่อ" required>{{ $party->contact }}</textarea>
            </div>

            <div class="form-img">
              <label for="party-guests">คิวอาร์โค้ด:</label><br>
              @if($party->img_contact)
              <!-- แสดงรูปภาพที่มีอยู่แล้ว -->
              <img src="{{ asset('contact_images/' . $party->img_contact) }}" alt="Current Image" width="200px"><br>
              @endif
              <input type="file" id="party-img_contact" name="img_contact">
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
  @endforeach
  <div class="pagination">
    {{ $parties->links() }}
  </div>
  

  @else
  <p style="text-align: center; font-size: 15pt; margin-top: 40px;">ไม่พบกิจกรรม</p>
  @endif
  <script>
    function confirmDelete(id) {
      if (confirm("คุณต้องการลบกิจกรรมนี้ใช่หรือไม่")) {
        window.location.href = "/admin/delete/" + id;
      }
    }

    function validateForm(partyId) {

      const partyName = document.getElementById('party-name' + partyId).value;
      const numpeople = document.getElementById('party-guests' + partyId).value;
      const startTime = document.getElementById('start-time' + partyId).value;
      const endTime = document.getElementById('end-time' + partyId).value;
      const province = document.getElementById('province' + partyId).value;
      const location = document.getElementById('location' + partyId).value;
      const detail = document.getElementById('detail' + partyId).value;
      const partyType = document.getElementById('party-type' + partyId).value;
      const contact = document.getElementById('contact' + partyId).value;

      if (partyName === "") {
        alert("กรุณากรอกชื่อกิจกรรม");
        return false;
      }
      if (numpeople === "" || numpeople < 1) {
        alert("กรุณากรอกจำนวนผู้เข้าร่วมใหม่อีกครั้ง");
        return false;
      }
      if (startTime === "") {
        alert("กรุณากรอกเวลาเริ่มทำกิจกรรม");
        return false;
      }
      if (endTime === "") {
        alert("กรุณากรอกเวลาสิ้นสุดกิจกรรม");
        return false;
      }
      if (province === "") {
        alert("กรุณาเลือกจังหวัด");
        return false;
      }
      if (location === "") {
        alert("กรุณากรอกสถานที่");
        return false;
      }
      if (detail === "") {
        alert("กรุณากรอกรายละเอียดเพิ่มเติม");
        return false;
      }
      if (partyType === "") {
        alert("กรุณาเลือกประเภทกิจกรรม");
        return false;
      }
      if (contact === "") {
        alert("กรุณากรอกข้อมูลการติดต่อ");
        return false;
      }

      return true;
    }

    // ฟังก์ชันตรวจสอบ
    function validateDates() {
      const startDate = document.getElementById('party-date').value;
      const endDate = document.getElementById('party-end-date').value;


      if (!startDate || !endDate) {
        alert("กรุณากรอกทั้งวันที่เริ่มและวันที่สิ้นสุดกิจกรรม");
        return false;
      }


      const startDateObj = new Date(startDate);
      const endDateObj = new Date(endDate);


      if (endDateObj < startDateObj) {
        alert("วันที่สิ้นสุดกิจกรรมต้องไม่น้อยกว่าวันเริ่มกิจกรรม");
        return false;
      }

      return true;
    }

    // เ
    document.querySelector('form').addEventListener('submit', function(e) {
      if (!validateDates()) {
        e.preventDefault();
      }
    });

    // ผู้ใช้เปลี่ยนแปลงฟิลด์วันที่
    document.addEventListener('DOMContentLoaded', function() {
      const startDateInput = document.getElementById('party-date');
      const endDateInput = document.getElementById('party-end-date');

      // เปลี่ยนแปลงของวันที่เริ่ม
      startDateInput.addEventListener('change', function() {
        checkDate();
      });

      // เปลี่ยนแปลงของวันที่สิ้นสุด
      endDateInput.addEventListener('change', function() {
        checkDate();
      });

      // ตรวจสอบวันที่
      function checkDate() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (endDate < startDate) {
          alert("วันที่สิ้นสุดกิจกรรมต้องไม่น้อยกว่าวันเริ่มกิจกรรม");
          endDateInput.value = '';
        }
      }
    });
  </script>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
@endsection