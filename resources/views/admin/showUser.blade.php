@extends('layouts.myadmin')
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
   
    <!-- Main content -->
    <section>
    <h1>User</h1>
    <div class="search">
    <input id="search-input" type="text" placeholder="Search by first or last name" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2">
    <input id="submit-input" type="submit" value="ค้นหา">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var query = $(this).val();

            if(query.length > 0) {
                $.ajax({
                    url: "{{ route('showUser.users') }}",  // Path to your search function
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        $('tbody').empty();

                        if(data.length > 0) {
                            // Append results to table
                            $.each(data, function(index, user) {
                                var formattedDate = new Date(user.created_at).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
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
                                        <td>${formattedDate}</td>
                                    </tr>
                                `);
                            });
                        } else {
                            $('tbody').append('<tr><td colspan="5">ไม่พบบัญชีผู้ใช้</td></tr>');
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
                            var formattedDate = new Date(user.created_at).toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
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
                                    <td>${formattedDate}</td>
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
            <th>ชื่อผู้ใช้</th>
            <th>อีเมล</th>
            <th>วันที่ลงชื่อเข้าใช้</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td style="padding: 0 0 0 15px;">
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#UserModal{{$user->id}}" data-bs-whatever="@mdo">
                    <img src="/images/ไอคอนคน.png" alt="">
                </button>
            </td>
            <td>{{$user->id}} </td>
            <td>{{ $user->fristname . ' ' . $user->lastname }}</td>
            <td>{{$user->email}} </td>
            <td> {{ date('d F', strtotime($user->created_at)) }} {{ date('Y', strtotime($user->created_at)) + 543 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </section>
</div>

<!-- ป๊อปอัพขึ้น -->
@foreach($users as $user)
<div class="modal fade" id="UserModal{{$user->id}}" tabindex="-1" aria-labelledby="userModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="UserModal{{$user->id}}">บัญชีผู้ใช้งาน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table>
                <thead>
                <tr>
                    <th>อีเมลของผู้ใช้</th>
                    <th style="width: 10px; background-color: white;"></th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->email}}</td>
                    <th style="width: 10px; background-color: white;"></th>
                    <td>
                        @if(isset($user->phone) && !empty($user->phone))
                            {{$user->phone}}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>ชื่อ</th>
                    <th style="width: 10px; background-color: white;"></th>
                    <th>นามสกุล</th>
                </tr>
                <tr>
                    <td>{{$user->fristname}}</td>
                    <th style="width: 10px; background-color: white;"></th>
                    <td>{{$user->lastname}}</td>
                </tr>
                <tr>
                <tr>
                    <th>วันเกิด</th>
                    <th style="width: 10px; background-color: white;"></th>
                    <th>เพศ</th>
                </tr>
                <tr>
                    <td> @if(isset($user->birthday) && !empty($user->birthday))
                            {{$user->birthday}}
                        @else
                            -
                        @endif
                    </td>
                    <th style="width: 10px; background-color: white;"></th>
                    <td> @if(isset($user->gender) && !empty($user->gender))
                            {{$user->gender}}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: center;">เกี่ยวกับฉัน</th>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                    @if(isset($user->Introduction) && !empty($user->Introduction))
                            {{$user->Introduction}}
                        @else
                            -
                        @endif

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endforeach

</body>
</html>
@endsection