@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
  <link rel="stylesheet" type="text/css" href="/style_user.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  <style>
    .modal-content {
    width: 750px;
    position: relative;
    right: 120px;
}
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Manu -->
    <aside>
        <img src="/images/logo.png" alt="logo">
      <ul>
        <a href="./reveiw.html"><li class="unuser"><img src="/images/รีวิว.png" alt="">Review</li></a>
        <a href="./user.html"><li class="user"><img src="/images/ไอคอนคน.png" alt="" style="width: 15px; height: 25px;"><b>User</b></li></a>
        <a href="./created.html"><li class="unuser"><img src="/images/38.png" alt="">Created party</li></a>
      </ul>
    </aside>

    <!-- Main content -->
    <section>
    <h1>User</h1>
    <div class="search">
    <input id="search-input" type="text" placeholder="Search by first or last name" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2">
    <button id="search-btn" class="btn btn-primary">GO</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var query = $(this).val();

            if(query.length > 0) {
                $.ajax({
                    url: "{{ route('showUser.users') }}",  // เส้นทางที่เชื่อมต่อไปยังฟังก์ชันการค้นหา
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        // เคลียร์ตารางเดิม
                        $('tbody').empty();

                        if(data.length > 0) {
                            // แสดงผลลัพธ์ในตาราง
                            $.each(data, function(index, user) {
                                $('tbody').append(`
                                    <tr>
                                        <td style="padding: 0 0 0 15px;">
                                            <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                <img src="/images/ไอคอนคน.png" alt="">
                                            </button>
                                        </td>
                                        <td>${user.id}</td>
                                        <td>${user.fristname} ${user.lastname}</td>
                                        <td>${user.email}</td>
                                        <td>${user.created_at}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('tbody').append('<tr><td colspan="5">No results found</td></tr>');
                        }
                    }
                });
            } else {

                $.ajax({
                url: "{{ route('showUser.users') }}",
                method: 'GET',
                success: function(data) {
                    $('tbody').empty();
                    $.each(data, function(index, user) {
                        $('tbody').append(`
                            <tr>
                                <td style="padding: 0 0 0 15px;">
                                    <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                        <img src="/images/ไอคอนคน.png" alt="">
                                    </button>
                                </td>
                                <td>${user.id}</td>
                                <td>${user.fristname} ${user.lastname}</td>
                                <td>${user.email}</td>
                                <td>${user.created_at}</td>
                            </tr>
                            `);
                        });
                    }
                });
            }
        });
        $('#search-btn').on('click', function() {
            $('#search-input').trigger('keyup');
        });
    });
</script>



    <table>
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td style="padding: 0 0 0 15px;">
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <img src="/images/ไอคอนคน.png" alt="">
                </button>
            </td>
            <td>{{$user->id}} </td>
            <td>{{ $user->fristname . ' ' . $user->lastname }}</td>
            <td>{{$user->email}} </td>
            <td>{{$user->created_at}} </td>
            </tr>

        </tr>
        @endforeach
        </tr>
        </tbody>
    </table>
    </section>
</div>

<!-- ป๊อปอัพขึ้น -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">บัญชีผู้ใช้งาน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <table>
                <tr>
                    <th>อีเมลของผู้ใช้</th>
                    <th style="width: 10px; background-color: white;"></th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
                <tr>
                    <!-- @endfoeach -->
                    <td>nuchsara@kkumail.com</td>
                    <th style="width: 10px; background-color: white;"></th>
                    <td>0953470633</td>
                    <!-- @endfoeach -->
                </tr>
                <tr>
                    <th>ชื่อ</th>
                    <th style="width: 10px; background-color: white;"></th>
                    <th>นามสกุล</th>
                </tr>
                <!-- @endfoeach -->
                <tr>
                    <td>นุสรา</td>
                    <th style="width: 10px; background-color: white;"></th>
                    <td>สารธิราช</td>
                </tr>
                <!-- @endfoeach -->
                <tr>
                    <th colspan="3" style="text-align: center;">รายละเอียดเพิ่มเติม</th>
                </tr>
                <!-- @endfoeach -->
                <tr>
                    <td colspan="3" style="text-align: center;">ชอบตกปลาบึงศรีฐาน</td>
                </tr>
                <!-- @endfoeach -->
            </table>

        </div>
    </div>
    </div>
</div>

</body>
</html>
