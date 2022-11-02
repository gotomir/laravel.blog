@extends('layouts.layout')



@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            @foreach($posts as $post)
            <div class="blog-box wow fadeIn">
                <div class="post-media">
                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">
                        <img src="{{ asset("uploads/$post->thumbnail") }}" alt="" class="img-fluid">
                        <div class="hovereffect">
                            <span></span>
                        </div>
                        <!-- end hover -->
                    </a>
                </div>
                <!-- end media -->
                <div class="blog-meta big-meta text-center">
                    <div class="post-sharing">
                        <ul class="list-inline">
                            <li><a href="https://t.me/goto_mir" class="fb-button btn btn-primary" target="_blank"
                                   class="brand-link"><i class="fa fa-telegram"></i> <span
                                        class="down-mobile">Telegram</span></a></li>

                            <li><a href="https://www.instagram.com/" class="tw-button btn btn-primary" target="_blank"
                                   class="brand-link"><i class="fa fa-instagram" aria-hidden="true"></i> <span
                                        class="down-mobile">Instagram</span></a></li>

                            <li><a href="https://ok.ru/profile/577445883997" class="gp-button btn btn-primary" target="_blank"
                                   class="brand-link"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> <span
                                        class="down-mobile">Одноклассники</span></a></li>
                        </ul>
                    </div><!-- end post-sharing -->
                    <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                    <p>{!! $post->description !!} </p>
                    <small><a href="{{ route('category.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->title }}</a></small>
                    <small>{{ $post->getPostDate() }}</small>
                    <small><i class="fa fa-eye"></i>{{ $post->views }}</small>
                </div><!-- end meta -->
            </div><!-- end blog-box -->

            <hr class="invis">
            @endforeach
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->links() }}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
