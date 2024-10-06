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

</head>

<body>
    <div id="top"></div>

    <!-- ปุ่มเลื่อนขึ้นและลง -->
    <div class="scroll-buttons">
        <a href="#top">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-chevron-double-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z" />
                <path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z" />
            </svg>
        </a>
    </div>


    <section class="head">
        <div class="head-text">
            <h2>Find joy in the journey.</h2>
            <p>ความสุขไม่ใช่จุดหมายปลายทาง แต่เป็นการเดินทางที่เราเริ่มต้นใหม่ในทุกๆ วัน มันซ่อนอยู่ในช่วงเวลาที่เราอาจมองข้ามไป<br>
                ความอบอุ่นจากแสงแดดยามเช้า เสียงหัวเราะที่แบ่งปันกับเพื่อนๆ และความพึงพอใจจากการทำงานที่สำเร็จลุล่วง</p>
            <div class="search-bar">
                <form action="{{ route('searchParty') }}" method="GET">
                    <input type="text" id="search-input" name="search" placeholder="ค้นหากิจกรรม ..." value="{{ request()->get('search') }}">
                    <select id="province" name="province">
                        <option value="">จังหวัด</option>
                        <option value="กระบี่" {{ request()->get('province') == 'กระบี่' ? 'selected' : '' }}>กระบี่</option>
                        <option value="กรุงเทพมหานคร" {{ request()->get('province') == 'กรุงเทพมหานคร' ? 'selected' : '' }}>กรุงเทพมหานคร</option>
                        <option value="กาญจนบุรี" {{ request()->get('province') == 'กาญจนบุรี' ? 'selected' : '' }}>กาญจนบุรี</option>
                        <option value="กาฬสินธุ์" {{ request()->get('province') == 'กาฬสินธุ์' ? 'selected' : '' }}>กาฬสินธุ์</option>
                        <option value="กำแพงเพชร" {{ request()->get('province') == 'กำแพงเพชร' ? 'selected' : '' }}>กำแพงเพชร</option>
                        <option value="ขอนแก่น" {{ request()->get('province') == 'ขอนแก่น' ? 'selected' : '' }}>ขอนแก่น</option>
                        <option value="จันทบุรี" {{ request()->get('province') == 'จันทบุรี' ? 'selected' : '' }}>จันทบุรี</option>
                        <option value="ฉะเชิงเทรา" {{ request()->get('province') == 'ฉะเชิงเทรา' ? 'selected' : '' }}>ฉะเชิงเทรา</option>
                        <option value="ชลบุรี" {{ request()->get('province') == 'ชลบุรี' ? 'selected' : '' }}>ชลบุรี</option>
                        <option value="ชัยนาท" {{ request()->get('province') == 'ชัยนาท' ? 'selected' : '' }}>ชัยนาท</option>
                        <option value="ชัยภูมิ" {{ request()->get('province') == 'ชัยภูมิ' ? 'selected' : '' }}>ชัยภูมิ</option>
                        <option value="ชุมพร" {{ request()->get('province') == 'ชุมพร' ? 'selected' : '' }}>ชุมพร</option>
                        <option value="เชียงราย" {{ request()->get('province') == 'เชียงราย' ? 'selected' : '' }}>เชียงราย</option>
                        <option value="เชียงใหม่" {{ request()->get('province') == 'เชียงใหม่' ? 'selected' : '' }}>เชียงใหม่</option>
                        <option value="ตรัง" {{ request()->get('province') == 'ตรัง' ? 'selected' : '' }}>ตรัง</option>
                        <option value="ตราด" {{ request()->get('province') == 'ตราด' ? 'selected' : '' }}>ตราด</option>
                        <option value="ตาก" {{ request()->get('province') == 'ตาก' ? 'selected' : '' }}>ตาก</option>
                        <option value="นครนายก" {{ request()->get('province') == 'นครนายก' ? 'selected' : '' }}>นครนายก</option>
                        <option value="นครปฐม" {{ request()->get('province') == 'นครปฐม' ? 'selected' : '' }}>นครปฐม</option>
                        <option value="นครพนม" {{ request()->get('province') == 'นครพนม' ? 'selected' : '' }}>นครพนม</option>
                        <option value="นครราชสีมา" {{ request()->get('province') == 'นครราชสีมา' ? 'selected' : '' }}>นครราชสีมา</option>
                        <option value="นครศรีธรรมราช" {{ request()->get('province') == 'นครศรีธรรมราช' ? 'selected' : '' }}>นครศรีธรรมราช</option>
                        <option value="นครสวรรค์" {{ request()->get('province') == 'นครสวรรค์' ? 'selected' : '' }}>นครสวรรค์</option>
                        <option value="นนทบุรี" {{ request()->get('province') == 'นนทบุรี' ? 'selected' : '' }}>นนทบุรี</option>
                        <option value="นราธิวาส" {{ request()->get('province') == 'นราธิวาส' ? 'selected' : '' }}>นราธิวาส</option>
                        <option value="น่าน" {{ request()->get('province') == 'น่าน' ? 'selected' : '' }}>น่าน</option>
                        <option value="บึงกาฬ" {{ request()->get('province') == 'บึงกาฬ' ? 'selected' : '' }}>บึงกาฬ</option>
                        <option value="บุรีรัมย์" {{ request()->get('province') == 'บุรีรัมย์' ? 'selected' : '' }}>บุรีรัมย์</option>
                        <option value="ปทุมธานี" {{ request()->get('province') == 'ปทุมธานี' ? 'selected' : '' }}>ปทุมธานี</option>
                        <option value="ประจวบคีรีขันธ์" {{ request()->get('province') == 'ประจวบคีรีขันธ์' ? 'selected' : '' }}>ประจวบคีรีขันธ์</option>
                        <option value="ปราจีนบุรี" {{ request()->get('province') == 'ปราจีนบุรี' ? 'selected' : '' }}>ปราจีนบุรี</option>
                        <option value="ปัตตานี" {{ request()->get('province') == 'ปัตตานี' ? 'selected' : '' }}>ปัตตานี</option>
                        <option value="พระนครศรีอยุธยา" {{ request()->get('province') == 'พระนครศรีอยุธยา' ? 'selected' : '' }}>พระนครศรีอยุธยา</option>
                        <option value="พะเยา" {{ request()->get('province') == 'พะเยา' ? 'selected' : '' }}>พะเยา</option>
                        <option value="พังงา" {{ request()->get('province') == 'พังงา' ? 'selected' : '' }}>พังงา</option>
                        <option value="พัทลุง" {{ request()->get('province') == 'พัทลุง' ? 'selected' : '' }}>พัทลุง</option>
                        <option value="พิจิตร" {{ request()->get('province') == 'พิจิตร' ? 'selected' : '' }}>พิจิตร</option>
                        <option value="พิษณุโลก" {{ request()->get('province') == 'พิษณุโลก' ? 'selected' : '' }}>พิษณุโลก</option>
                        <option value="เพชรบุรี" {{ request()->get('province') == 'เพชรบุรี' ? 'selected' : '' }}>เพชรบุรี</option>
                        <option value="เพชรบูรณ์" {{ request()->get('province') == 'เพชรบูรณ์' ? 'selected' : '' }}>เพชรบูรณ์</option>
                        <option value="แพร่" {{ request()->get('province') == 'แพร่' ? 'selected' : '' }}>แพร่</option>
                        <option value="ภูเก็ต" {{ request()->get('province') == 'ภูเก็ต' ? 'selected' : '' }}>ภูเก็ต</option>
                        <option value="มหาสารคาม" {{ request()->get('province') == 'มหาสารคาม' ? 'selected' : '' }}>มหาสารคาม</option>
                        <option value="มุกดาหาร" {{ request()->get('province') == 'มุกดาหาร' ? 'selected' : '' }}>มุกดาหาร</option>
                        <option value="แม่ฮ่องสอน" {{ request()->get('province') == 'แม่ฮ่องสอน' ? 'selected' : '' }}>แม่ฮ่องสอน</option>
                        <option value="ยโสธร" {{ request()->get('province') == 'ยโสธร' ? 'selected' : '' }}>ยโสธร</option>
                        <option value="ยะลา" {{ request()->get('province') == 'ยะลา' ? 'selected' : '' }}>ยะลา</option>
                        <option value="ร้อยเอ็ด" {{ request()->get('province') == 'ร้อยเอ็ด' ? 'selected' : '' }}>ร้อยเอ็ด</option>
                        <option value="ระนอง" {{ request()->get('province') == 'ระนอง' ? 'selected' : '' }}>ระนอง</option>
                        <option value="ระยอง" {{ request()->get('province') == 'ระยอง' ? 'selected' : '' }}>ระยอง</option>
                        <option value="ราชบุรี" {{ request()->get('province') == 'ราชบุรี' ? 'selected' : '' }}>ราชบุรี</option>
                        <option value="ลพบุรี" {{ request()->get('province') == 'ลพบุรี' ? 'selected' : '' }}>ลพบุรี</option>
                        <option value="ลำปาง" {{ request()->get('province') == 'ลำปาง' ? 'selected' : '' }}>ลำปาง</option>
                        <option value="ลำพูน" {{ request()->get('province') == 'ลำพูน' ? 'selected' : '' }}>ลำพูน</option>
                        <option value="เลย" {{ request()->get('province') == 'เลย' ? 'selected' : '' }}>เลย</option>
                        <option value="ศรีสะเกษ" {{ request()->get('province') == 'ศรีสะเกษ' ? 'selected' : '' }}>ศรีสะเกษ</option>
                        <option value="สกลนคร" {{ request()->get('province') == 'สกลนคร' ? 'selected' : '' }}>สกลนคร</option>
                        <option value="สงขลา" {{ request()->get('province') == 'สงขลา' ? 'selected' : '' }}>สงขลา</option>
                        <option value="สตูล" {{ request()->get('province') == 'สตูล' ? 'selected' : '' }}>สตูล</option>
                        <option value="สมุทรปราการ" {{ request()->get('province') == 'สมุทรปราการ' ? 'selected' : '' }}>สมุทรปราการ</option>
                        <option value="สมุทรสงคราม" {{ request()->get('province') == 'สมุทรสงคราม' ? 'selected' : '' }}>สมุทรสงคราม</option>
                        <option value="สมุทรสาคร" {{ request()->get('province') == 'สมุทรสาคร' ? 'selected' : '' }}>สมุทรสาคร</option>
                        <option value="สระบุรี" {{ request()->get('province') == 'สระบุรี' ? 'selected' : '' }}>สระบุรี</option>
                        <option value="สระแก้ว" {{ request()->get('province') == 'สระแก้ว' ? 'selected' : '' }}>สระแก้ว</option>
                        <option value="สิงห์บุรี" {{ request()->get('province') == 'สิงห์บุรี' ? 'selected' : '' }}>สิงห์บุรี</option>
                        <option value="สุโขทัย" {{ request()->get('province') == 'สุโขทัย' ? 'selected' : '' }}>สุโขทัย</option>
                        <option value="สุพรรณบุรี" {{ request()->get('province') == 'สุพรรณบุรี' ? 'selected' : '' }}>สุพรรณบุรี</option>
                        <option value="สุราษฎร์ธานี" {{ request()->get('province') == 'สุราษฎร์ธานี' ? 'selected' : '' }}>สุราษฎร์ธานี</option>
                        <option value="สุรินทร์" {{ request()->get('province') == 'สุรินทร์' ? 'selected' : '' }}>สุรินทร์</option>
                        <option value="หนองคาย" {{ request()->get('province') == 'หนองคาย' ? 'selected' : '' }}>หนองคาย</option>
                        <option value="หนองบัวลำภู" {{ request()->get('province') == 'หนองบัวลำภู' ? 'selected' : '' }}>หนองบัวลำภู</option>
                        <option value="อำนาจเจริญ" {{ request()->get('province') == 'อำนาจเจริญ' ? 'selected' : '' }}>อำนาจเจริญ</option>
                        <option value="อุดรธานี" {{ request()->get('province') == 'อุดรธานี' ? 'selected' : '' }}>อุดรธานี</option>
                        <option value="อุตรดิตถ์" {{ request()->get('province') == 'อุตรดิตถ์' ? 'selected' : '' }}>อุตรดิตถ์</option>
                        <option value="อุทัยธานี" {{ request()->get('province') == 'อุทัยธานี' ? 'selected' : '' }}>อุทัยธานี</option>
                        <option value="อุบลราชธานี" {{ request()->get('province') == 'อุบลราชธานี' ? 'selected' : '' }}>อุบลราชธานี</option>
                        <option value="อ่างทอง" {{ request()->get('province') == 'อ่างทอง' ? 'selected' : '' }}>อ่างทอง</option>
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
                            <li class=" {{ request()->is('searchParty') && is_null(request('type')) ? 'active' : '' }}">
                                <a href="{{ route('searchParty') }}">
                                    กิจกรรมทั้งหมด
                                </a>
                            </li>
                            <li class=" {{ request()->is('searchParty') && request('type') == '1' ? 'active' : '' }}">
                                <a href="{{ route('searchParty', ['type' => '1']) }}">
                                    การท่องเที่ยว
                                </a>
                            </li>
                            <li class=" {{ request()->is('searchParty') && request('type') == '2' ? 'active' : '' }}">
                                <a href="{{ route('searchParty', ['type' => '2']) }}">
                                    จิตอาสา
                                </a>
                            </li>
                            <li class=" {{ request()->is('searchParty') && request('type') == '3' ? 'active' : '' }}">
                                <a href="{{ route('searchParty', ['type' => '3']) }}">
                                    สังสรรค์
                                </a>
                            </li>
                            <li class=" {{ request()->is('searchParty') && request('type') == '4' ? 'active' : '' }}">
                                <a href="{{ route('searchParty', ['type' => '4']) }}">
                                    พัฒนาทักษะ
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td class="partys" id="party-list">
                    @if(isset($activeParties) && count($activeParties) > 0)
                    @foreach($activeParties as $party)
                    <div class="party">
                        <div class="image">
                            <img src="{{ asset('party_images/' . $party->img) }}" alt="Event Image" width="200px">
                        </div>
                        <div class="data">
                            <p style="text-align: right;"><small>จำนวนผู้เข้าร่วมกิจกรรม: {{ $party->joined_count }} / {{$party->numpeople}} คน</small></p>

                            @php
                            $daysLeft = floor((strtotime($party->start_date) - time()) / 86400);
                            @endphp

                            @if($daysLeft > 0)
                            <p style="color: #ee6464; text-align: right;"><small>เหลือเวลารับสมัครอีก : {{ $daysLeft }} วัน</small></p>
                            @else
                            <p style="color: #ee6464;">หมดเวลารับสมัคร</p>
                            @endif

                            <h2>{{ $party->party_name }}</h2>
                            <p>วันที่จัดกิจกรรม :
                                @if (thaidate($party->start_date) == thaidate($party->end_date))
                                <!-- กรณีจัดกิจกรรมวันเดียว -->
                                {{ thaidate($party->start_date) }}
                                @else
                                <!-- กรณีจัดหลายวัน -->
                                {{ thaidate($party->start_date) }} ถึง {{ thaidate($party->end_date) }}
                                @endif

                            <p>สถานที่: {{ $party->location }}</p>
                            <p>จังหวัด: {{ $party->province }}</p>

                            <div class="buttons">
                                @if($daysLeft > 0)
                                @if($party->attendees->count() == $party->numpeople)
                                <!-- กรณีผู้เข้าร่วมเต็ม -->
                                <p style="color: red;">เต็มแล้ว</p>
                                @else
                                @if(in_array($party->id, $joinAttendances))
                                <!-- กรณีผู้ใช้เข้าร่วมแล้ว -->
                                <p class="join2 joined" style="color: green; cursor: default;">เข้าร่วมแล้ว</p>
                                @else
                                @auth
                                <a class="join" onclick="join({{ $party->id }})">เข้าร่วม</a>
                                @endauth
                                @guest
                                <!-- ยังไม่เข้าสู่ระบบ -->
                                @endguest
                                @endif
                                @endif
                                @else
                                <!-- หมดเขตรับสมัครแล้ว -->

                                @endif
                                <!-- แสดงเสมอ -->
                                <a href="{{ route('party.details', $party->id) }}" class="more">ข้อมูลเพิ่มเติม</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p id="not-search">ไม่พบกิจกรรมที่ค้นหา</p>
                    @endif


                    @if(isset($pastParties) && count($pastParties) > 0)
                    @foreach($pastParties as $party)
                    <div class="party">
                        <div class="image">
                            <img src="{{ asset('party_images/' . $party->img) }}" alt="Even Image" width="200px">
                        </div>
                        <div class="data">
                            <p style="color: #ee6464;">หมดเวลารับสมัคร</p>
                            <h2>{{ $party->party_name }}</h2>
                            <p>วันที่จัดกิจกรรม : {{ thaidate($party->start_date) }} ถึง {{ thaidate($party->end_date)}}</p>
                            <p>สถานที่ : {{ $party->location }}</p>
                            <p>จังหวัด : {{ $party->province }}</p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </td>
            </tr>
        </table>

    </section>


    <script>
        function join(id) {
            if (confirm("คุณต้องการเข้าร่วมกิจกรรมนี้ใช่หรือไม่")) {
                window.location.href = "/join/" + id;
            }

        }
    </script>


</body>

</html>
@endsection