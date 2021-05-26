<x-adminlayout>
<form class="text-center border border-light p-5" action="{{route("updateMessage",$updateData->id)}}" method="post">
@csrf

    <p class="h4 mb-4">Edit Message</p>

    <!--Username -->
    <input type="text" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Username" name="username" value="{{$updateData->username}}">
    @error("username")
    <p class="text-danger">{{$message}}</p>
    @enderror

    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="email" value="{{$updateData->email}}">
    @error("email")
    <p class="text-danger">{{$message}}</p>
    @enderror

    <textarea name="message" id="" cols="30" rows="10" class="form-control mb-4" placeholder="Your Message">{{$updateData->messages}}</textarea>
    @error("message")
    <p class="text-danger">{{$message}}</p>
    @enderror
    
    <!-- send message button -->
    <button class="btn btn-info btn-block my-4" type="submit">Update Message</button>

</form>
</x-adminlayout>