@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel ="stylesheet" href='{{asset('css/style.css')}}'>
    <style>
        body {
            text-align: center;
        }
        input {
            border: 1px solid;
        }
        
    </style>
</head>
<body>
<h2>สร้างปาร์ตี้</h2>
<form action="{{ url('/admin/create') }}" method="post" enctype="multipart/form-data">
    @csrf
    ชื่อปาร์ตี้ <br>
    <input type="text" name="party_name" ><br>
    เวลาที่เริ่มจัดปาร์ตี้ <br>
    <input type="time" name="start_time" ><br>
    เวลาสิ้นสุดปาร์ตี้ <br>
    <input type="time" name="end_time" ><br>
    วันที่จัดปาร์ตี้ <br>
    <input type="date" name="date" ><br>
    สถานที่จัด <br>
    <input type="text"name="location" ><br>
    ประเภทปาร์ตี้ <br>
    <select  name="type_party" >
        <option value="travel">การท่องเที่ยว</option>
        <option value="volunteer">จิตอาสา</option>
        <option value="social">สังสรรค์</option>
        <option value="skill_development">พัฒนาทักษะ</option>
    </select><br>
    รายละเอียด <br>
    <input type="text" name="detail" ><br>
    จำนวนผู้เข้าร่วม <br>
    <input type="text" name="numpeople" ><br>
    เพิ่มรูปภาพ <br>
    <input type="file" name="img" ><br>
    <button type="submit" class="btn btn-primary">ยืนยัน</button>
    <button type="button" id="cancelButton">ยกเลิก</button>
</form>

<h2>Party</h2> 
<table border="1">
    <thead>
        <tr>
            <th>Party ID</th>
            <th>date</th>
            <th>party_name</th>
            <th>location</th>
            <th>details</th>
            <th>participants</th>
            <th>img</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parties as $party)
            <tr>
                <td>{{$party->id}} </td> 
                <td>{{$party->date}} </td> 
                <td>{{$party->party_name}} </td> 
                <td>{{$party->location}} </td> 
                <td>{{$party->detail}} </td> 
                <td>{{$party->numpeople}} </td>
                <td>{{$party->img}} </td>  
            </tr>
        @endforeach 
    </tbody>
</table>
</body>
</html>
@endsection 
