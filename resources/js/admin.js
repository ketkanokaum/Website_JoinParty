$(document).ready(function() {
    function performSearch() {
        var query = $('#search-input').val();

        if (query.length > 0) {
            $.ajax({
                url: "{{ route('showUser.users') }}",
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    $('tbody').empty();
                    if (data.length > 0) {
                        $.each(data, function(index, user) {
                            // แปลงวันที่ให้เป็นฟอร์แมตที่ต้องการ (d/m/Y)
                            var createdAt = user.created_at ? new Date(user.created_at).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }) : '-';

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
                                    <td>${createdAt}</td> <!-- แสดงวันที่ที่แปลงแล้ว -->
                                </tr>
                            `);
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="5">No results found</td></tr>');
                    }
                }
            });
        } else {
            // แสดงผู้ใช้ทั้งหมดเมื่อไม่มีการค้นหา
            $.ajax({
                url: "{{ route('showUser.users') }}",
                method: 'GET',
                success: function(data) {
                    $('tbody').empty();
                    $.each(data, function(index, user) {
                        // แปลงวันที่ให้เป็นฟอร์แมตที่ต้องการ (d/m/Y)
                        var createdAt = user.created_at ? new Date(user.created_at).toLocaleDateString('th-TH', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        }) : '-';

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
                                <td>${createdAt}</td> <!-- แสดงวันที่ที่แปลงแล้ว -->
                            </tr>
                        `);
                    });
                }
            });
        }
    }

    // เมื่อมีการพิมพ์ใน input
    $('#search-input').on('keyup', function() {
        performSearch();
    });

    // เมื่อคลิกปุ่ม GO
    $('#search-btn').on('click', function() {
        performSearch();
    });

    // แสดงผู้ใช้ทั้งหมดเมื่อโหลดหน้า
    performSearch();
});
