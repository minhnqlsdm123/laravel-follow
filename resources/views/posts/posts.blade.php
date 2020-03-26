@extends('layouts.app')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

@section('content')


    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Posts</div>

                    <div class="card-body" >
                        @if($posts->count())
                            @foreach($posts as $post)
                                <article class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="post panel panel-info" data-id="{{ $post->id }}" >
                                        <div class="panel-body" >
                                            <h2>{{$post->name}}</h2>
                                            <h3>{{$post->description}}</h3>
                                            <p>{{$post->content}}</p>
                                        </div>
                                        <div class="panel-footer">
                                            <div id="like-{{$post->id}}" class="like col-lg-6 col-md-6 col-xs-6" {{ auth()->user()->hasLiked($post) ? 'like-post' : '' }} >
                                                <span class="like-btn">
                                                <i  class=" glyphicon glyphicon-thumbs-up "></i>
                                                <span>Like</span>
                                                </span>
                                            </div>
                                            <div style="text-align: right">
                                                <span id="like-{{$post->id}}-count" >{{ $post->likers()->get()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.like').click(function(){
                var id = $(this).parents(".post").data('id');
                var count = $('#'+this.id+'-count').html();
                var countObjId = this.id;
                var countObj = $(this);

                $.ajax({
                    type:'POST',
                    url:'/like',
                    data:{id:id},
                    success:function(data){
                        if(jQuery.isEmptyObject(data.success.attached)){
                            $('#'+countObjId+'-count').html(parseInt(count) - 1);
                            $(countObj).removeClass("like-post");
                        }else{
                            $('#'+countObjId+'-count').html(parseInt(count)+1);
                            $(countObj).addClass("like-post");
                        }
                    }
                });

            });

        });
    </script>
@endsection