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
            // Display all users when no query is present
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
    }

    // When typing in the search input
    $('#search-input').on('keyup', function() {
        performSearch();
    });

    // When clicking the GO button
    $('#search-btn').on('click', function() {
        performSearch();
    });

    // Display all users on page load
    performSearch();
});
