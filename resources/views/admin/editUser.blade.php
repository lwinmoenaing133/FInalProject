<x-adminlayout>
<form class="text-center border border-light p-5" action="{{route("updateUser",$updateUser->id)}}" method="post">
@csrf

    <p class="h4 mb-4">Contact Us</p>

    <!--name -->
    <input type="text" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Username" name="name" value="{{$updateUser->name}}">
    @error("name")
    <p class="text-danger">{{$message}}</p>
    @enderror

    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="email" value="{{$updateUser->email}}">
    @error("email")
    <p class="text-danger">{{$message}}</p>
    @enderror
    <!-- isAdmin  -->
    <label for="">isAdmin</label><br>
    <select name="isAdmin" id="" class="form-control mb-4">
        <option value="1" {{$updateUser->isAdmin=="1" ? "selected":" "}}>True</option>
        <option value="0" {{$updateUser->isAdmin=="0" ?  "selected":" "}}>False</option>
    </select>
    <!-- isPremium  -->
    <label for="">isPremium</label><br>
    <select name="isPremium" id="" class="form-control mb-4">
        <option value="1" {{$updateUser->isPremium=="1" ? "selected":" "}}>True</option>
        <option value="0" {{$updateUser->isPremium=="0" ?  "selected":" "}}>False</option>
    </select>
    
    
    <!-- send message button -->
    <button class="btn btn-info btn-block my-4" type="submit">update</button>

</form>
</x-adminlayout>
