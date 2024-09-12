<table border="1">
    <thead>
        <tr>
            <th >User ID</th>
            <th >name</th>
            <th >email</th>
            <th >created dete</th>
            
        </tr>
    </thead>
    <tbody>
    <h2>Party</h2> 
    @foreach($users as $user)
            <tr>
            <td>{{$user->id}} </td> 
            <td>{{ $user->fristname . ' ' . $user->lastname }}</td>
            <td>{{$user->email}} </td> 
            <td>{{$user->created_at}} </td> 
            </tr>
    @endforeach 

    