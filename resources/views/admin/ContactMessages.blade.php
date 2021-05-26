<x-adminlayout>
  <h1>Contact Messages Page</h1>
  <table class="table table-hover">
    <thead class="cyan white-text">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Messages</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($messages as $message)
        <tr>
          <td>{{$message->id}}</td>
          <td>{{$message->username}}</td>
          <td>{{$message->email}}</td>
          <td>{{$message->messages}}</td>
          <td><a href="{{route('editMessage',$message->id)}}" class="btm btn-sm green white-text">Update</a></td>
          <td><a href="{{route('deleteMessage',$message->id)}}" class="btm btn-sm red white-text">Delete</a></td>
        </tr>
        
    @endforeach
  </tbody>
</table>
</x-adminlayout>