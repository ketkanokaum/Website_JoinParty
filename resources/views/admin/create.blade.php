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
      <h1>สร้างกิจกรรม</h1>
      <div class="search">
        <input id="search-input" type="text" placeholder="Search Praty Name" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2">
        <input id="submit-input" type="submit" value="ค้นหา">
      </div>

      <div class="ceate-bt">
      <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                สร้างกิจกรรม
      </button>
      </div>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>ชื่อกิจกรรม</th>
            <th>วันที่จัดกิจกรรม</th>
            <th>จำนวนผู้เข้าร่วม</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          @foreach($parties as $party)
            <td>{{$party->id}}</td>
            <td>{{$party->party_name}}</td>
            <td>
            {{ date('d F', strtotime($party->start_date)) }} {{ date('Y', strtotime($party->start_date)) + 543 }}
            </td>
            <td>{{$party->numpeople}}</td>
            <td style="padding: 0;">
                <button type="button" class="table-bt" data-bs-toggle="modal" data-bs-target="#exampleModal{{$party->id}}" data-bs-whatever="@mdo">
                    แก้ไข
                </button>
            </td>
            <td style="padding: 0;">
                <button type="button" class="table-bt-t" data-bs-toggle="modal" data-bs-whatever="@mdo" onclick="confirmDelete({{$party->id}})">
                    ลบ
                </button>
            </td>
          </tr>
          </tr>
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

        <form action="{{ url('/admin/insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
                <label for="party-name">ชื่อกิจกรรม :</label>
                <input type="text" id="party-name" name="party_name" placeholder="กรอกชื่อปาร์ตี้" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">วันที่จัดกิจกรรม :</label>
                <input type="date" id="party-date" name="start_date" required onchange="checkForm()">
            </div>
            <div class="form-group">
                <label for="party-date">วันที่สิ้นสุดกิจกรรม :</label>
                <input type="date" id="party-end-date" name="end_date" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่เริ่มทำกิจกรรม :</label>
                <input type="Time" id="start" name="start_time" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่สิ้นสุด :</label>
                <input type="Time" id="end" name="end_time" required onchange="checkForm()">
            </div>
            <div class="form-group">
                <label for="party-type">จังหวัด:</label required>
                <select id="province" name="province">
                        <option value="">จังหวัด</option>
                        <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                        <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                        <option value="อ่างทอง">อ่างทอง</option>
                        <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                        <option value="บึงกาฬ">บึงกาฬ</option>
                        <option value="บุรีรัมย์">บุรีรัมย์</option>
                        <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                        <option value="ชัยนาท">ชัยนาท</option>
                        <option value="ชัยภูมิ">ชัยภูมิ</option>
                        <option value="จันทบุรี">จันทบุรี</option>
                        <option value="เชียงใหม่">เชียงใหม่</option>
                        <option value="เชียงราย">เชียงราย</option>
                        <option value="ชลบุรี">ชลบุรี</option>
                        <option value="ชุมพร">ชุมพร</option>
                        <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                        <option value="กำแพงเพชร">กำแพงเพชร</option>
                        <option value="กาญจนบุรี">กาญจนบุรี</option>
                        <option value="ขอนแก่น">ขอนแก่น</option>
                        <option value="กระบี่">กระบี่</option>
                        <option value="ลำปาง">ลำปาง</option>
                        <option value="ลำพูน">ลำพูน</option>
                        <option value="เลย">เลย</option>
                        <option value="ลพบุรี">ลพบุรี</option>
                        <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                        <option value="มหาสารคาม">มหาสารคาม</option>
                        <option value="มุกดาหาร">มุกดาหาร</option>
                        <option value="นครนายก">นครนายก</option>
                        <option value="นครปฐม">นครปฐม</option>
                        <option value="นครพนม">นครพนม</option>
                        <option value="นครราชสีมา">นครราชสีมา</option>
                        <option value="นครสวรรค์">นครสวรรค์</option>
                        <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                        <option value="น่าน">น่าน</option>
                        <option value="นราธิวาส">นราธิวาส</option>
                        <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                        <option value="หนองคาย">หนองคาย</option>
                        <option value="นนทบุรี">นนทบุรี</option>
                        <option value="ปทุมธานี">ปทุมธานี</option>
                        <option value="ปัตตานี">ปัตตานี</option>
                        <option value="พังงา">พังงา</option>
                        <option value="พัทลุง">พัทลุง</option>
                        <option value="พะเยา">พะเยา</option>
                        <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                        <option value="เพชรบุรี">เพชรบุรี</option>
                        <option value="พิจิตร">พิจิตร</option>
                        <option value="พิษณุโลก">พิษณุโลก</option>
                        <option value="แพร่">แพร่</option>
                        <option value="ภูเก็ต">ภูเก็ต</option>
                        <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                        <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                        <option value="ระนอง">ระนอง</option>
                        <option value="ราชบุรี">ราชบุรี</option>
                        <option value="ระยอง">ระยอง</option>
                        <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                        <option value="สระแก้ว">สระแก้ว</option>
                        <option value="สกลนคร">สกลนคร</option>
                        <option value="สมุทรปราการ">สมุทรปราการ</option>
                        <option value="สมุทรสาคร">สมุทรสาคร</option>
                        <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                        <option value="สระบุรี">สระบุรี</option>
                        <option value="สตูล">สตูล</option>
                        <option value="สิงห์บุรี">สิงห์บุรี</option>
                        <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                        <option value="สงขลา">สงขลา</option>
                        <option value="สุโขทัย">สุโขทัย</option>
                        <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                        <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                        <option value="สุรินทร์">สุรินทร์</option>
                        <option value="ตาก">ตาก</option>
                        <option value="ตรัง">ตรัง</option>
                        <option value="ตราด">ตราด</option>
                        <option value="อุบลราชธานี">อุบลราชธานี</option>
                        <option value="อุดรธานี">อุดรธานี</option>
                        <option value="อุทัยธานี">อุทัยธานี</option>
                        <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                        <option value="ยะลา">ยะลา</option>
                        <option value="ยโสธร">ยโสธร</option>

                    </select>
            </div>

            <div class="form-group">
                <label for="party-location">สถานที่จัดกิจกรรม :</label>
                <input type="text" id="party-location" name="location" placeholder="กรอกสถานที่จัดปาร์ตี้" required >
            </div>

            <div class="form-group">
                <label for="party-description">รายละเอียด:</label>
                <textarea id="party-description" name="detail" placeholder="รายละเอียดเพิ่มเติม" required ></textarea >
            </div>

            <div class="form-group">
                <label for="party-type">ประเภทของกิจกรรม:</label>
                <select id="party-type" name="party_type_id" required >
                @foreach($partyTypes as $partyType)
            <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
              @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
                <input type="number" id="party-guests" name="numpeople" placeholder="จำนวนผู้เข้าร่วม" required onchange="checkForm()">
            </div>

            <div class="form-img">
              <label for="party-guests">รูปภาพกิจกรรม:</label><br>
              <input type="file" id="party-img" name="img" required onchange="checkForm()">
          </div>

          <div class="form-group">
                <label for="party-contact">ช่องทางการติดต่อ:</label>
                <textarea id="party-contact" name="contact" placeholder="ช่องทางการติดต่อ" required ></textarea>
            </div>

            <div class="form-img">
              <label for="party-guests">คิวอาร์โค้ด:</label><br>
              <input type="file" id="party-img_contact" name="img_contact"required >
          </div>

            <div class="form-buttons">
                <button type="submit" >ยืนยัน</button>
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
                <input type="text" id="party-name" name="party_name"  value="{{$party->party_name}}" placeholder="กรอกชื่อปาร์ตี้" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">วันที่จัดกิจกรรม :</label>
                <input type="date" id="party-date" name="start_date" value="{{$party->start_date}}"required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">วันที่สิ้นสุดกิจกรรม :</label>
                <input type="date" id="party-end-date" name="end_date" value="{{$party->end_date}}" required onchange="checkForm()">
            </div>


            <div class="form-group">
                <label for="party-date">เวลาที่เริ่มทำกิจกรรม:</label>
                <input type="Time" id="start" name="start_time" value="{{$party->start_time}}" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-date">เวลาที่สิ้นสุด:</label>
                <input type="Time" id="end" name="end_time" value="{{$party->end_time}}" required onchange="checkForm()">
            </div>

            <div class="form-group">
                <label for="party-type">จังหวัด:</label>
                <select id="province" name="province" required >
    <option value="">เลือกจังหวัด</option>
    <option value="กรุงเทพมหานคร" {{ $party->province == 'กรุงเทพมหานคร' ? 'selected' : '' }}>กรุงเทพมหานคร</option>
    <option value="อำนาจเจริญ" {{ $party->province == 'อำนาจเจริญ' ? 'selected' : '' }}>อำนาจเจริญ</option>
    <option value="อ่างทอง" {{ $party->province == 'อ่างทอง' ? 'selected' : '' }}>อ่างทอง</option>
    <option value="พระนครศรีอยุธยา" {{ $party->province == 'พระนครศรีอยุธยา' ? 'selected' : '' }}>พระนครศรีอยุธยา</option>
    <option value="บึงกาฬ" {{ $party->province == 'บึงกาฬ' ? 'selected' : '' }}>บึงกาฬ</option>
    <option value="บุรีรัมย์" {{ $party->province == 'บุรีรัมย์' ? 'selected' : '' }}>บุรีรัมย์</option>
    <option value="ฉะเชิงเทรา" {{ $party->province == 'ฉะเชิงเทรา' ? 'selected' : '' }}>ฉะเชิงเทรา</option>
    <option value="ชัยนาท" {{ $party->province == 'ชัยนาท' ? 'selected' : '' }}>ชัยนาท</option>
    <option value="ชัยภูมิ" {{ $party->province == 'ชัยภูมิ' ? 'selected' : '' }}>ชัยภูมิ</option>
    <option value="จันทบุรี" {{ $party->province == 'จันทบุรี' ? 'selected' : '' }}>จันทบุรี</option>
    <option value="เชียงใหม่" {{ $party->province == 'เชียงใหม่' ? 'selected' : '' }}>เชียงใหม่</option>
    <option value="เชียงราย" {{ $party->province == 'เชียงราย' ? 'selected' : '' }}>เชียงราย</option>
    <option value="ชลบุรี" {{ $party->province == 'ชลบุรี' ? 'selected' : '' }}>ชลบุรี</option>
    <option value="ชุมพร" {{ $party->province == 'ชุมพร' ? 'selected' : '' }}>ชุมพร</option>
    <option value="กาฬสินธุ์" {{ $party->province == 'กาฬสินธุ์' ? 'selected' : '' }}>กาฬสินธุ์</option>
    <option value="กำแพงเพชร" {{ $party->province == 'กำแพงเพชร' ? 'selected' : '' }}>กำแพงเพชร</option>
    <option value="กาญจนบุรี" {{ $party->province == 'กาญจนบุรี' ? 'selected' : '' }}>กาญจนบุรี</option>
    <option value="ขอนแก่น" {{ $party->province == 'ขอนแก่น' ? 'selected' : '' }}>ขอนแก่น</option>
    <option value="กระบี่" {{ $party->province == 'กระบี่' ? 'selected' : '' }}>กระบี่</option>
    <option value="ลำปาง" {{ $party->province == 'ลำปาง' ? 'selected' : '' }}>ลำปาง</option>
    <option value="ลำพูน" {{ $party->province == 'ลำพูน' ? 'selected' : '' }}>ลำพูน</option>
    <option value="เลย" {{ $party->province == 'เลย' ? 'selected' : '' }}>เลย</option>
    <option value="ลพบุรี" {{ $party->province == 'ลพบุรี' ? 'selected' : '' }}>ลพบุรี</option>
    <option value="แม่ฮ่องสอน" {{ $party->province == 'แม่ฮ่องสอน' ? 'selected' : '' }}>แม่ฮ่องสอน</option>
    <option value="มหาสารคาม" {{ $party->province == 'มหาสารคาม' ? 'selected' : '' }}>มหาสารคาม</option>
    <option value="มุกดาหาร" {{ $party->province == 'มุกดาหาร' ? 'selected' : '' }}>มุกดาหาร</option>
    <option value="นครนายก" {{ $party->province == 'นครนายก' ? 'selected' : '' }}>นครนายก</option>
    <option value="นครปฐม" {{ $party->province == 'นครปฐม' ? 'selected' : '' }}>นครปฐม</option>
    <option value="นครพนม" {{ $party->province == 'นครพนม' ? 'selected' : '' }}>นครพนม</option>
    <option value="นครราชสีมา" {{ $party->province == 'นครราชสีมา' ? 'selected' : '' }}>นครราชสีมา</option>
    <option value="นครสวรรค์" {{ $party->province == 'นครสวรรค์' ? 'selected' : '' }}>นครสวรรค์</option>
    <option value="นครศรีธรรมราช" {{ $party->province == 'นครศรีธรรมราช' ? 'selected' : '' }}>นครศรีธรรมราช</option>
    <option value="น่าน" {{ $party->province == 'น่าน' ? 'selected' : '' }}>น่าน</option>
    <option value="นราธิวาส" {{ $party->province == 'นราธิวาส' ? 'selected' : '' }}>นราธิวาส</option>
    <option value="หนองบัวลำภู" {{ $party->province == 'หนองบัวลำภู' ? 'selected' : '' }}>หนองบัวลำภู</option>
    <option value="หนองคาย" {{ $party->province == 'หนองคาย' ? 'selected' : '' }}>หนองคาย</option>
    <option value="นนทบุรี" {{ $party->province == 'นนทบุรี' ? 'selected' : '' }}>นนทบุรี</option>
    <option value="ปทุมธานี" {{ $party->province == 'ปทุมธานี' ? 'selected' : '' }}>ปทุมธานี</option>
    <option value="ปัตตานี" {{ $party->province == 'ปัตตานี' ? 'selected' : '' }}>ปัตตานี</option>
    <option value="พังงา" {{ $party->province == 'พังงา' ? 'selected' : '' }}>พังงา</option>
    <option value="พัทลุง" {{ $party->province == 'พัทลุง' ? 'selected' : '' }}>พัทลุง</option>
    <option value="พะเยา" {{ $party->province == 'พะเยา' ? 'selected' : '' }}>พะเยา</option>
    <option value="เพชรบูรณ์" {{ $party->province == 'เพชรบูรณ์' ? 'selected' : '' }}>เพชรบูรณ์</option>
    <option value="เพชรบุรี" {{ $party->province == 'เพชรบุรี' ? 'selected' : '' }}>เพชรบุรี</option>
    <option value="พิจิตร" {{ $party->province == 'พิจิตร' ? 'selected' : '' }}>พิจิตร</option>
    <option value="พิษณุโลก" {{ $party->province == 'พิษณุโลก' ? 'selected' : '' }}>พิษณุโลก</option>
    <option value="แพร่" {{ $party->province == 'แพร่' ? 'selected' : '' }}>แพร่</option>
    <option value="ภูเก็ต" {{ $party->province == 'ภูเก็ต' ? 'selected' : '' }}>ภูเก็ต</option>
    <option value="ปราจีนบุรี" {{ $party->province == 'ปราจีนบุรี' ? 'selected' : '' }}>ปราจีนบุรี</option>
    <option value="ประจวบคีรีขันธ์" {{ $party->province == 'ประจวบคีรีขันธ์' ? 'selected' : '' }}>ประจวบคีรีขันธ์</option>
    <option value="ระนอง" {{ $party->province == 'ระนอง' ? 'selected' : '' }}>ระนอง</option>
    <option value="ราชบุรี" {{ $party->province == 'ราชบุรี' ? 'selected' : '' }}>ราชบุรี</option>
    <option value="ระยอง" {{ $party->province == 'ระยอง' ? 'selected' : '' }}>ระยอง</option>
    <option value="ร้อยเอ็ด" {{ $party->province == 'ร้อยเอ็ด' ? 'selected' : '' }}>ร้อยเอ็ด</option>
    <option value="สระแก้ว" {{ $party->province == 'สระแก้ว' ? 'selected' : '' }}>สระแก้ว</option>
    <option value="สกลนคร" {{ $party->province == 'สกลนคร' ? 'selected' : '' }}>สกลนคร</option>
    <option value="สมุทรปราการ" {{ $party->province == 'สมุทรปราการ' ? 'selected' : '' }}>สมุทรปราการ</option>
    <option value="สมุทรสาคร" {{ $party->province == 'สมุทรสาคร' ? 'selected' : '' }}>สมุทรสาคร</option>
    <option value="สมุทรสงคราม" {{ $party->province == 'สมุทรสงคราม' ? 'selected' : '' }}>สมุทรสงคราม</option>
    <option value="สระบุรี" {{ $party->province == 'สระบุรี' ? 'selected' : '' }}>สระบุรี</option>
    <option value="สตูล" {{ $party->province == 'สตูล' ? 'selected' : '' }}>สตูล</option>
    <option value="สิงห์บุรี" {{ $party->province == 'สิงห์บุรี' ? 'selected' : '' }}>สิงห์บุรี</option>
    <option value="ศรีสะเกษ" {{ $party->province == 'ศรีสะเกษ' ? 'selected' : '' }}>ศรีสะเกษ</option>
    <option value="สงขลา" {{ $party->province == 'สงขลา' ? 'selected' : '' }}>สงขลา</option>
    <option value="สุโขทัย" {{ $party->province == 'สุโขทัย' ? 'selected' : '' }}>สุโขทัย</option>
    <option value="สุพรรณบุรี" {{ $party->province == 'สุพรรณบุรี' ? 'selected' : '' }}>สุพรรณบุรี</option>
    <option value="สุราษฎร์ธานี" {{ $party->province == 'สุราษฎร์ธานี' ? 'selected' : '' }}>สุราษฎร์ธานี</option>
    <option value="สุรินทร์" {{ $party->province == 'สุรินทร์' ? 'selected' : '' }}>สุรินทร์</option>
    <option value="ตาก" {{ $party->province == 'ตาก' ? 'selected' : '' }}>ตาก</option>
    <option value="ตรัง" {{ $party->province == 'ตรัง' ? 'selected' : '' }}>ตรัง</option>
    <option value="ตราด" {{ $party->province == 'ตราด' ? 'selected' : '' }}>ตราด</option>
    <option value="อุบลราชธานี" {{ $party->province == 'อุบลราชธานี' ? 'selected' : '' }}>อุบลราชธานี</option>
    <option value="อุดรธานี" {{ $party->province == 'อุดรธานี' ? 'selected' : '' }}>อุดรธานี</option>
    <option value="อุทัยธานี" {{ $party->province == 'อุทัยธานี' ? 'selected' : '' }}>อุทัยธานี</option>
    <option value="อุตรดิตถ์" {{ $party->province == 'อุตรดิตถ์' ? 'selected' : '' }}>อุตรดิตถ์</option>
    <option value="ยะลา" {{ $party->province == 'ยะลา' ? 'selected' : '' }}>ยะลา</option>
    <option value="ยโสธร" {{ $party->province == 'ยโสธร' ? 'selected' : '' }}>ยโสธร</option>
</select>

            </div>

            <div class="form-group">
                <label for="party-location">สถานที่จัดกิจกรรม:</label>
                <input type="text" id="party-location" name="location" value="{{$party->location}}" placeholder="กรอกสถานที่จัดปาร์ตี้" required >
            </div>

            <div class="form-group">
                <label for="party-description">รายละเอียด:</label>
                <textarea id="party-description" name="detail" placeholder="รายละเอียดเพิ่มเติม" required >{{$party->detail}}</textarea>
            </div>

            <div class="form-group">
                <label for="party-type">ประเภทของกิจกรรม:</label>
                <select id="party-type" name="party_type_id" value="{{$party->type_party}}" required >
                @foreach($partyTypes as $partyType)
              <option value="{{ $partyType->id }}">{{ $partyType->type_name }}</option>
          @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="party-guests">จำนวนผู้เข้าร่วมกิจกรรม :</label>
                <input type="number" id="party-guests" name="numpeople" value="{{$party->numpeople}}" placeholder="จำนวนผู้เข้าร่วม" required onchange="checkForm()">
            </div>

            <div class="form-group">
    <label for="img">รูปภาพกิจกรรม:</label><br>
    
    @if($party->img)
        <!-- แสดงรูปภาพที่มีอยู่แล้ว -->
        <img src="{{ asset('party_images/' . $party->img) }}" alt="Current Image" width="200px"><br>
    @endif

    <input type="file" id="img" name="img" >
    </div>

    <div class="form-group">
                <label for="party-contact">ช่องทางการติดต่อ:</label>
                <textarea id="party-contact" name="contact " placeholder="ช่องทางการติดต่อ" required >{{ $party->contact }}</textarea>
            </div>

            <div class="form-img">
              <label for="party-guests">คิวอาร์โค้ด:</label><br>
              @if($party->img_contact)
        <!-- แสดงรูปภาพที่มีอยู่แล้ว -->
        <img src="{{ asset('contact_images/' . $party->img_contact) }}" alt="Current Image" width="200px"><br>
          @endif
              <input type="file" id="party-img_contact" name="img_contact"  >
          </div>

            <div class="form-buttons">
                <button type="submit" >ยืนยัน</button>
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

<script>

function checkForm() {
    const requiredFields = [
        document.getElementById('party-name'),
        document.getElementById('party-date'),
        document.getElementById('party-end-date'),
        document.getElementById('start'),
        document.getElementById('end'),
        document.getElementById('province'),
        document.getElementById('party-location'),
        document.getElementById('party-description'),
        document.getElementById('party-type'),
        document.getElementById('party-guests'),
        document.getElementById('party-img'),
        document.getElementById('party-contact'),
        document.getElementById('party-img_contact')
    ];

    const allFilled = requiredFields.every(field => field.value.trim() !== '');

    document.getElementById('submit-btn').disabled = !allFilled;
}

function validateForm() {
    const numPeople = document.getElementById('party-guests').value;
    if (numPeople < 1) {
        alert('กรุณากรอกจำนวนผู้เข้าร่วมที่ถูกต้อง!');
        return false; // หยุดการส่งข้อมูล
    }

    const img = document.getElementById('party-img').files[0];
    const imgContact = document.getElementById('party-img_contact').files[0];


    if (img && !img.type.startsWith('image/')) {
        alert('กรุณาอัปโหลดไฟล์ภาพสำหรับกิจกรรม!');
        return false;
    }

    if (imgContact && !imgContact.type.startsWith('image/')) {
        alert('กรุณาอัปโหลดไฟล์ภาพสำหรับคิวอาร์โค้ด!');
        return false;
    }

    const startDate = document.getElementById('party-date').value;
    const endDate = document.getElementById('party-end-date').value;

    if (new Date(endDate) <= new Date(startDate)) {
        alert('วันที่สิ้นสุดกิจกรรมต้องมากกว่าหรือเท่ากับวันที่เริ่ม!');
        return false; 
    }

    return true; 
}



function confirmDelete(id){
            if(confirm("คุณต้องการลบกิจกรรมนี้ใช่หรือไม่ ?")){
                window.location.href="/admin/delete" +id;
            }

        }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
@endsection
