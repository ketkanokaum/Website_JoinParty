@extends('layouts.myapp')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="style_home.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        footer {
            position: absolute;
            bottom: 0;
        }

        section {
            display: flex;
            flex-direction: column;
            gap: 30px;
            position: relative;
            top: 160px;
            width: 100%;
        }

        h2 {
            text-align: center;
            font-size: 30px;
        }

        button a {
            text-decoration: none;
            color: #000;
        }

        button {
            width: 10%;
            height: 50px;
            margin: auto;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <section>
        <h2>สามารถดูรายละเอียดได้เฉพาะแอดมินเท่านั้น</h2>
        <button class="more">
            <a href="{{ url('/dashboard') }}" class="btn-back">กลับสู่หน้าหลัก</a>
        </button>
    </section>

</body>

</html>
@endsection