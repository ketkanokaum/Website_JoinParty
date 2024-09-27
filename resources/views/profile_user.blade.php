@extends('layouts.myapp')
@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ของคุณ</title>
    <link rel="stylesheet" href="/profile.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>


<div class="bg">
    <div class="profile-card">
    <h3 class="bold"><b>โปรไฟล์ของฉัน</b></h3>
    <img src="{{ $user->images ? asset('storage/users_images/' . $user->images) : asset('images/user-default.png') }}" class="profile-image" alt="User Profile Image">
        <div class="profile-info">
            <h2>{{$user->username}}</h2>
            <p><b>{{ $user->fristname . ' ' . $user->lastname }}</b></p>
            <p><b>อีเมล : {{$user->email}} </b></p>
            <p><b>เพศ : {{$user->gender}}</b></p>
            <p><b>วันเกิด : {{$user->birthday}}</b></p>
            <p><b>เบอร์โทรศัพท์: {{$user->phone}}</b></p>
        </div>
        <div class="profile-bio"><br><br>อธิบายเกี่ยวกับตัวเอง</div>
        <div class="bio-content">{{$user->Introduction}}</div>

        <div class="buttons">
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}" data-bs-whatever="@mdo" >
            <img src="" alt="">แก้ไขโปรไฟล์
        </button>
            <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background-color: #d9d9d9;">
                            <img src="" alt="">ออกจากระบบ
                        </button>
                    </form>
        </div>
    </div>

  <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModal{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModal{{$user->id}}">แก้ไขโปรไฟล์</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
  <div class="container">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-left">
      <div class="form-group">
        <label for="username">ชื่อบัญชีผู้ใช้ :</label>
        <input type="text" id="username" name="username" value="{{$user->username}}" placeholder="กรอกชื่อบัญชีผู้ใช้ใหม่">
      </div>

      <div class="form-group">
        <label for="fristname">ชื่อจริง :</label>
        <input type="text" id="fristname" name="fristname" value="{{$user->fristname}}" placeholder="กรอกชื่อ">
      </div>

      <div class="form-group">
        <label for="lastname">นามสกุล :</label>
        <input type="text" id="lastname" name="lastname" value="{{$user->lastname}}" placeholder="กรอกนามสกุล">
      </div>

      <div class="form-group">
        <label for="gender">เพศ :</label><br>
        <input type="radio" id="male" name="gender" value="ชาย"{{ $user->gender == 'ชาย' ? 'checked' : '' }}>
        <label for="male">ชาย</label><br>
        <input type="radio" id="female" name="gender" value="หญิง" {{ $user->gender == 'หญิง' ? 'checked' : '' }}>
        <label for="female">หญิง</label><br>
        <input type="radio" id="other" name="gender" value="ไม่ระบุ" {{ $user->gender == 'ไม่ระบุ' ? 'checked' : '' }}>
        <label for="other">ไม่ระบุ</label><br>
      </div>

    </div>

    <div class="form-right">
      <div class="form-group">
        <label for="birthday">วัน/เดือน/ปีเกิด :</label>
        <input type="date" id="birthday" name="birthday" value="{{$user->birthday}}">
      </div>

      <div class="form-group">
        <label for="phone">เบอร์โทรศัพท์ :</label>
        <input type="tell" id="phone" name="phone" value="{{$user->phone}}" placeholder="กรอกเบอร์โทรศัพท์">
      </div>

  <div class="form-group">
    <label for="Introduction">คำอธิบายตัวเอง :</label><br>
    <textarea id="Introduction" name="Introduction" placeholder="กรอกคำอธิบายตัวเอง" style="height: 100px;">{{$user->Introduction}}</textarea>
  </div>


      <div class="form-img">
        <label for="images">เพิ่มรูปโปรไฟล์ :</label><br>
    <!-- @if($user->images) -->
        <img src="{{ asset('storage/users_images/' . $user->images) }}" alt="User Profile Image" class="profile-image">
    <!-- @else
        <img src="{{ asset('images/user-default.png') }}" alt="Default Profile Image" class="profile-image">
    @endif -->

    <input type="file" id="images" name="images">
    </div>

      <div class="form-buttons">
        <button type="submit"onclick="success()" >ยืนยัน</button>
      </div>

    </div>
  </form>
</div>
  </div>

<script>

function success(){
  alert("แก้ไขโปรไฟล์เรียบร้อยแล้ว")
}

        
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@endsection