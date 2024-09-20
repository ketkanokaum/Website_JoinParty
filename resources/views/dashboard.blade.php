
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
                <li><a href="#">กิจกรรมของของฉัน</a></li>
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
                <form action="">
                    <input type="text" placeholder="ค้นหา party ...">
                    <select id="province" name="province">
                        <option value="">จังหวัด</option>
                        <option value="Bangkok">กรุงเทพมหานคร</option>
                        <option value="Amnat Charoen">อำนาจเจริญ</option>
                        <option value="Ang Thong">อ่างทอง</option>
                        <option value="Ayutthaya">พระนครศรีอยุธยา</option>
                        <option value="Bueng Kan">บึงกาฬ</option>
                        <option value="Buriram">บุรีรัมย์</option>
                        <option value="Chachoengsao">ฉะเชิงเทรา</option>
                        <option value="Chai Nat">ชัยนาท</option>
                        <option value="Chaiyaphum">ชัยภูมิ</option>
                        <option value="Chanthaburi">จันทบุรี</option>
                        <option value="Chiang Mai">เชียงใหม่</option>
                        <option value="Chiang Rai">เชียงราย</option>
                        <option value="Chonburi">ชลบุรี</option>
                        <option value="Chumphon">ชุมพร</option>
                        <option value="Kalasin">กาฬสินธุ์</option>
                        <option value="Kamphaeng Phet">กำแพงเพชร</option>
                        <option value="Kanchanaburi">กาญจนบุรี</option>
                        <option value="Khon Kaen">ขอนแก่น</option>
                        <option value="Krabi">กระบี่</option>
                        <option value="Lampang">ลำปาง</option>
                        <option value="Lamphun">ลำพูน</option>
                        <option value="Loei">เลย</option>
                        <option value="Lopburi">ลพบุรี</option>
                        <option value="Mae Hong Son">แม่ฮ่องสอน</option>
                        <option value="Maha Sarakham">มหาสารคาม</option>
                        <option value="Mukdahan">มุกดาหาร</option>
                        <option value="Nakhon Nayok">นครนายก</option>
                        <option value="Nakhon Pathom">นครปฐม</option>
                        <option value="Nakhon Phanom">นครพนม</option>
                        <option value="Nakhon Ratchasima">นครราชสีมา</option>
                        <option value="Nakhon Sawan">นครสวรรค์</option>
                        <option value="Nakhon Si Thammarat">นครศรีธรรมราช</option>
                        <option value="Nan">น่าน</option>
                        <option value="Narathiwat">นราธิวาส</option>
                        <option value="Nong Bua Lamphu">หนองบัวลำภู</option>
                        <option value="Nong Khai">หนองคาย</option>
                        <option value="Nonthaburi">นนทบุรี</option>
                        <option value="Pathum Thani">ปทุมธานี</option>
                        <option value="Pattani">ปัตตานี</option>
                        <option value="Phang Nga">พังงา</option>
                        <option value="Phatthalung">พัทลุง</option>
                        <option value="Phayao">พะเยา</option>
                        <option value="Phetchabun">เพชรบูรณ์</option>
                        <option value="Phetchaburi">เพชรบุรี</option>
                        <option value="Phichit">พิจิตร</option>
                        <option value="Phitsanulok">พิษณุโลก</option>
                        <option value="Phrae">แพร่</option>
                        <option value="Phuket">ภูเก็ต</option>
                        <option value="Prachinburi">ปราจีนบุรี</option>
                        <option value="Prachuap Khiri Khan">ประจวบคีรีขันธ์</option>
                        <option value="Ranong">ระนอง</option>
                        <option value="Ratchaburi">ราชบุรี</option>
                        <option value="Rayong">ระยอง</option>
                        <option value="Roi Et">ร้อยเอ็ด</option>
                        <option value="Sa Kaeo">สระแก้ว</option>
                        <option value="Sakon Nakhon">สกลนคร</option>
                        <option value="Samut Prakan">สมุทรปราการ</option>
                        <option value="Samut Sakhon">สมุทรสาคร</option>
                        <option value="Samut Songkhram">สมุทรสงคราม</option>
                        <option value="Saraburi">สระบุรี</option>
                        <option value="Satun">สตูล</option>
                        <option value="Sing Buri">สิงห์บุรี</option>
                        <option value="Sisaket">ศรีสะเกษ</option>
                        <option value="Songkhla">สงขลา</option>
                        <option value="Sukhothai">สุโขทัย</option>
                        <option value="Suphanburi">สุพรรณบุรี</option>
                        <option value="Surat Thani">สุราษฎร์ธานี</option>
                        <option value="Surin">สุรินทร์</option>
                        <option value="Tak">ตาก</option>
                        <option value="Trang">ตรัง</option>
                        <option value="Trat">ตราด</option>
                        <option value="Ubon Ratchathani">อุบลราชธานี</option>
                        <option value="Udon Thani">อุดรธานี</option>
                        <option value="Uthai Thani">อุทัยธานี</option>
                        <option value="Uttaradit">อุตรดิตถ์</option>
                        <option value="Yala">ยะลา</option>
                        <option value="Yasothon">ยโสธร</option>
                    </select>
                    <select id="month" name="month">
                        <option value="">เดือน</option>
                        <option value="January">มกราคม</option>
                        <option value="February">กุมภาพันธ์</option>
                        <option value="March">มีนาคม</option>
                        <option value="April">เมษายน</option>
                        <option value="May">พฤษภาคม</option>
                        <option value="June">มิถุนายน</option>
                        <option value="July">กรกฎาคม</option>
                        <option value="August">สิงหาคม</option>
                        <option value="September">กันยายน</option>
                        <option value="October">ตุลาคม</option>
                        <option value="November">พฤศจิกายน</option>
                        <option value="December">ธันวาคม</option>
                    </select>
                    <input type="date">
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
                        <li class="all">กิจกรรมทั้งหมด<span>{{count($parties)}}</span></li>
                        <li>ท่องเที่ยว<span>9</span></li>
                        <li>จิตอาสา<span>2</span></li>
                        <li>สังสรรค์<span>8</span></li>
                        <li>พัฒนาทักษะ<span>5</span></li>
                    </ul>
                    </div>
                </td>
                <td class="partys">
                @if(isset($parties) && count($parties) > 0)
                    @foreach($parties as $party)
                        <div class="party">
                            <div class="image">
                                <img src="/images/a2df086-dd63.jpg" alt="Event Image">
                            </div>
                            <div class="data">
                                <h2>{{ $party->party_name }}</h2>
                                <p><b>เวลา : </b> {{ date('d F Y', strtotime($party->date)) }}</p>
                                <p><b>เวลาที่เหลือ : </b> {{ floor((strtotime($party->date) - time()) / 86400) }} วัน</p>
                                <p><b>สถานที่ : </b> {{ $party->location }}</p>
                                <p class="description">{{ $party->detail }}</p>
                                <div class="buttons">
                                    @auth
                                        <!-- แสดงปุ่ม "เข้าร่วม" เฉพาะเมื่อผู้ใช้เข้าสู่ระบบ -->
                                        <button class="join">เข้าร่วม</button>
                                    @endauth
                                    <button class="more">ข้อมูลเพิ่มเติม</button>
                                </div>
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
</body>
</html>
