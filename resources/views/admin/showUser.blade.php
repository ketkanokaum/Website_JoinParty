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

        .btn-success {
            border: none;
        }
    </style>
</head>

<body>
    
    <div class="wrapper">

        <!-- Main content -->
        <section>
            <h1>ข้อมูลผู้ใช้</h1>

            <!-- ฟอร์มค้นหาผู้ใช้ -->
            <div class="search">
                <form action="{{ route('admin.searchUser') }}" method="GET"> <!-- แก้ไข action ให้ตรงกับ route ที่ต้องการค้นหา -->
                    <input id="search-input" type="text" name="query" placeholder="ค้นหาบัญชีผู้ใช้" class="d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2" value="{{ request()->query('query') }}"> <!-- ใช้ name="query" เพื่อส่งค่าไปยัง controller -->
                    <input id="submit-input" type="submit" value="ค้นหา">
                </form>
            </div>

            <div class="ceate-bt">
                <button class="btn-success" type="button" data-bs-toggle="modal" data-bs-target="#UserModaledit" data-bs-whatever="@mdo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-clipboard-minus-fill" viewBox="0 0 16 16" style="margin: 0px 10px 3px;">
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zM6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1" />
                    </svg>
                    กู้คืนผู้ใช้งาน
                </button>
            </div>

        @if (isset($message))
        <p style="text-align: center; font-size: 15pt; margin-top: 40px;">{{ $message }}</p>
        @else
            <table style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 10px;"></th>
                        <th>ID</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>อีเมล</th>
                        <th style=" border-top-right-radius: 10px;">วันที่ลงชื่อเข้าใช้</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td style="padding: 0 0 0 15px;">
                                <img src="/images/ไอคอนคน.png" alt="">
                        </td>
                        <td>{{$user->id}} </td>
                        <td>
                        <button class="transparent-btn" data-bs-toggle="modal" data-bs-target="#UserModal{{$user->id}}">
                        {{ $user->fristname . ' ' . $user->lastname }}
                        </button>
                        </td>
                        <td>{{$user->email}} </td>

                        <td> {{ thaidate($user->created_at) }} </td>
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
                    <table style="border-radius: 10px;">
                        <thead>
                            <tr>
                                <td style="border-radius: 10px;" class="headtd">อีเมลของผู้ใช้</td>
                                <td style="width: 10px; background-color: white;"></td>
                                <td style="border-radius: 10px;" class="headtd">เบอร์โทรศัพท์</td>
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
                                <th style="border-radius: 10px; class="headtd"">ชื่อ</th>
                                <th style="width: 10px; background-color: white;"></th>
                                <th style="border-radius: 10px;" class="headtd">นามสกุล</th>
                            </tr>
                            <tr>
                                <td>{{$user->fristname}}</td>
                                <th style="width: 10px; background-color: white;"></th>
                                <td>{{$user->lastname}}</td>
                            </tr>
                            <tr>
                            <tr>
                                <th class="headtd">วันเกิด</th>
                                <th style="width: 10px; background-color: white;"></th>
                                <th class="headtd">เพศ</th>
                            </tr>
                            <tr>
                                <td> @if(isset($user->birthday) && !empty($user->birthday))
                                    {{ thaidate($user->birthday)}}
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
                                <th colspan="3" style="text-align: center;" class="headtd">เกี่ยวกับฉัน</th>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    @if(isset($user->Introduction) && !empty($user->Introduction))
                                    {{$user->Introduction}}
                                    @else
                                    -
                                    @endif

                                </td><br>
                            <tr></tr>
                            <td style="background-color: #fff;" class="de" colspan="_">
                                <button type="button" class="delete" onclick="confirmDelete({{$user->id}})">
                                    ลบ
                                </button>
                            </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <!-- รายชื่อการกู้คืน -->
    <div class="modal fade" id="UserModaledit" tabindex="-1" aria-labelledby="userModalLabel{{$user->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UserModal{{$user->id}}">บัญชีผู้ใช้ที่ถูกลบ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        @foreach($deletedUsers as $deletedUser)
                        <div class="card-body">
                            <tr>
                                <td>ID :{{ $deletedUser->id }}</td><br>
                                <td>ชื่อ-นามสกุล : {{ $deletedUser->fristname . ' ' . $deletedUser->lastname }}</td><br>
                                <td>อีเมล : {{ $deletedUser->email }}</td><br>
                                <td>วันที่ลงชื่อเข้าใช้ : {{ thaidate($deletedUser->created_at) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.restoreUser', $deletedUser->id) }} " onsubmit="return confirmRestore();">
                                        @csrf
                                        <button type="submit" class="recover">กู้คืน</button>
                                    </form>
                                </td>
                        </div>
                        </tr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="pagination">
    {{ $users->links() }}
    </div>
    
    <script>
        function confirmDelete(id) {
            if (confirm("คุณต้องการลบผู้ใช้นี้ใช่หรือไม่")) {
                window.location.href = "/admin/delete/user/" + id;
            }
        }

        function confirmRestore() {
            return confirm('คุณแน่ใจหรือไม่ว่าต้องการกู้คืนผู้ใช้นี้?');
        }
    </script>

</body>

</html>
@endsection