<!DOCTYPE html>
<html>
<head>
    <title>Test Pagination</title>
</head>
<body>
    <h1>Test Pagination</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อกิจกรรม</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parties as $party)
                <tr>
                    <td>{{ $party->id }}</td>
                    <td>{{ $party->party_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        {{ $parties->links() }}  <!-- links() สำหรับแบ่งหน้า -->
    </div>
</body>
</html>
