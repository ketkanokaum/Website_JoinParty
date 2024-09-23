@extends('layouts.myapp')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="style_home.css">

</head>
<body>
<nav>
<div class="container-nav">
        <ul>
            <li><a href="{{ url('/dashboard') }}"><img src="/images/logo.png" alt=""></a></li>

            @auth
                <!-- เมื่อผู้ใช้เข้าสู่ระบบ -->
                <li><a href="{{ url('/dashboard') }}" style="margin-left: 100px;">หน้าแรก</a></li>
                <li><a href="{{ url('/favorites') }}">กิจกรรมของของฉัน</a></li>
                <li><a href="#">รายการโปรด</a></li>
                <li><a href="{{ url('/user/profile') }}">โปรไฟล์ของฉัน</a></li>
                <li class="unuser">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0;">ออกจากระบบ</button>
                    </form>
                </li>
            @else
                <!-- < เมื่อผู้ใช้ยังไม่เข้าสู่ระบบ  -->
                <li><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">เข้าสู่ระบบ</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ลงชื่อเข้าใช้</a></li>
                @endif
            @endauth
        </ul>
    </div>
</nav>

    <section class="head">
        <div class="head-text">
            <h2>Find joy in the journey.</h2>
            <p>ความสุขไม่ใช่จุดหมายปลายทาง แต่เป็นการเดินทางที่เราเริ่มต้นใหม่ในทุกๆ วัน มันซ่อนอยู่ในช่วงเวลาที่เราอาจมองข้ามไป<br>
                ความอบอุ่นจากแสงแดดยามเช้า เสียงหัวเราะที่แบ่งปันกับเพื่อนๆ และความพึงพอใจจากการทำงานที่สำเร็จลุล่วง</p>
                <div class="search-bar">
                <form action="{{ route('searchParty') }}" method="GET">
                <input type="text" id="search-input" name="search" placeholder="ค้นหา party ...">
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
                    <input type="submit" value="ค้นหา">
                </form>
            </div>
        </div>
    </section>

    <section class="party-cotent">
        <table>
            <tr>
                <td class="catagory">
                    <div class="catagorys">
                    <ul>
                        <li class="all">กิจกรรมทั้งหมด<span>{{count($activeParties)}}</span></li>
                        <li>ท่องเที่ยว<span>9</span></li>
                        <li>จิตอาสา<span>2</span></li>
                        <li>สังสรรค์<span>8</span></li>
                        <li>พัฒนาทักษะ<span>5</span></li>
                    </ul>
                    </div>
                </td>
                <td class="partys" id="party-list">
                <!-- รายการปาร์ตี้จะถูกแสดงที่นี่ -->
                @if(isset($activeParties) && count($activeParties) > 0)
                    @foreach($activeParties as $party)
                        <div class="party">
                            <div class="image">
                                <img src="/images/a2df086-dd63.jpg" alt="Event Image">
                            </div>
                            <div class="data">
                                @php
                                $daysLeft = floor((strtotime($party->start_date) - time()) / 86400);
                                @endphp
                                @if($daysLeft > 0)
                                    <p style="color:red;"><b>เหลือเวลาอีก : </b> {{ $daysLeft }} วัน</p>
                                @else
                                    <p style="color:red;"><b>หมดเวลารับสมัคร</b></p>
                                @endif
                                <h2>{{ $party->party_name }}</h2>
                                <p><b>สถานที่ : </b> {{ $party->location }}</p>
                                <p><b>เวลา : </b> {{ date('d F Y', strtotime($party->start_date)) }}</p>

                                @if($daysLeft > 0)
                                <div class="buttons">
                                    @auth
                                        <button class="join">เข้าร่วม</button>
                                    @endauth
                                    <a href="{{ route('party.details', $party->id) }}" class="more">ข้อมูลเพิ่มเติม</a>

                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if(isset($pastParties) && count($pastParties) > 0)
                    @foreach($pastParties as $party)
                        <div class="party">
                            <div class="image">
                                <img src="/images/a2df086-dd63.jpg" alt="Event Image">
                            </div>
                            <div class="data">
                                <p style="color:red;"><b>หมดเวลารับสมัคร</b></p>
                                <h2>{{ $party->party_name }}</h2>
                                <p><b>เวลา : </b> {{ date('d F Y', strtotime($party->start_date )) }}</p>
                                <p><b>สถานที่ : </b> {{ $party->location }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </td>
        </tr>
    </table>
</section>


    <footer>
        <p>&copy; 2024 Join Party. All rights reserved.</p>
    </footer>
    <script>
    $(document).ready(function() {
        // เมื่อพิมพ์ในช่องค้นหา
        $('#search-input, #province').on('input', function() {
            var query = $('#search-input').val();
            var province = $('#province').val();

            if(query.length > 0) {
                // ส่งคำขอ AJAX เมื่อมีข้อความในช่องค้นหา
                $.ajax({
                    url: "{{ route('searchParty') }}",  // Route ที่ไปยังฟังก์ชันค้นหาปาร์ตี้
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        $('#party-list').empty(); // ล้างข้อมูลปาร์ตี้เดิมออก

                        if(data.length > 0) {
                            // แสดงผลปาร์ตี้ที่ค้นพบ
                            $.each(data, function(index, party) {
                                var formattedDate = new Date(party.start_date).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
                                $('#party-list').append(`
                                    <div class="party">
                                        <div class="image">
                                            <img src="/images/ไอคอนคน.png" alt="Event Image">
                                        </div>
                                        <div class="data">
                                            <h2>${party.party_name}</h2>
                                            <p><b>สถานที่:</b> ${party.location}</p>
                                            <p><b>วันที่:</b> ${formattedDate}</p>
                                        </div>
                                    </div>
                                `);
                            });
                        } else {
                            // แสดงข้อความเมื่อไม่พบปาร์ตี้
                            $('#party-list').append('<p>ไม่พบปาร์ตี้ที่ค้นหา</p>');
                        }
                    }
                });
            } else {
                // ถ้าช่องค้นหาว่าง ให้แสดงข้อมูลปาร์ตี้ทั้งหมด
                $.ajax({
                    url: "{{ route('party.show') }}",  // Route สำหรับแสดงปาร์ตี้ทั้งหมด
                    method: 'GET',
                    success: function(data) {
                        $('#party-list').empty(); // ล้างข้อมูลปาร์ตี้เดิมออก
                        $.each(data, function(index, party) {
                            var formattedDate = new Date(party.start_date).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
                            $('#party-list').append(`
                                <div class="party">
                                    <div class="image">
                                        <img src="/images/ไอคอนคน.png" alt="Event Image">
                                    </div>
                                    <div class="data">
                                        <h2>${party.party_name}</h2>
                                        <p><b>สถานที่:</b> ${party.location}</p>
                                        <p><b>วันที่:</b> ${formattedDate}</p>
                                    </div>
                                </div>
                            `);
                        });
                    }
                });
            }
        });

        // เมื่อคลิกปุ่มค้นหา
        $('#search-btn').on('click', function() {
            $('#search-input').trigger('keyup');
        });
    });
</script>

</body>
</html>
@endsection