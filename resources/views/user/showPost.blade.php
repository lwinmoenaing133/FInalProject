<x-pagelayout>
<div class="container mt-5 mr-5">

<h2 class="mt-3">
        {{$post->title}}
    </h2>
    <img src="{{asset("image/posts/".$post->image)}}" width="700px" height="400px" class="mr-5">

    
    <p class="mt-3">
        {{$post->content}}
    </p>
    <div class="mr-5">
    @can("PremiumAdminPostowner",$post->id)
        <a href="{{route('editPost',$post->id)}}" class="btn btn-success">Edit Post</a>
        <a href="{{route('deletePost',$post->id)}}" class="btn btn-danger">Delete Post</a>
    @endcan    
    </div>
</div>
</x-pagelayout>

