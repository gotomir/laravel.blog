@extends('layouts.category_layout')

@section('page-title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>{{ $category->title }}</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $category->title }}</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
@endsection

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if($posts->count() == 0)
                <h3>
                    Статей в категории "{{ $category->title }}" пока нет.
                </h3>
            @endif
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
                        <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                               title="">{{ $post->title }}</a></h4>
                        <p>{!! $post->description !!} </p>
                        <small><a href="{{ route('category.single', ['slug' => $post->category->slug]) }}"
                                  title="">{{ $post->category->title }}</a></small>
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
