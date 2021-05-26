<x-adminlayout>
<h1>Manage Premium Users Page</h1>
<table class="table table-hover">
  <thead class="cyan white-text">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">is Admin?</th>
      <th scope="col">is Premium?</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user )
      <tr>
      <th>{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td><b>{{$user->isAdmin=="0"?"FALSE":"TRUE"}}</b></td>
      <td><b>{{$user->isPremium=="0"?"FALSE":"TRUE"}}</b></td>
      <td><a href="{{route("editUser",$user->id)}}" class="btm btn-sm green white-text">Update</a></td>
      <td><a href="{{route("deleteUser",$user->id)}}" class="btm btn-sm red white-text">Delete</a></td>
    </tr>        
    @endforeach
  </tbody>
</table>
</x-adminlayout>