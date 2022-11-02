<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Популярные посты</h2>
        <div class="blog-list-widget">
            <div class="list-group">

                @foreach($popular_posts as $popular_post)
                    <a href="{{ route('posts.single', ['slug'=> $popular_post->slug]) }}"
                       class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <img src="{{ $popular_post->imgGet() }}" alt="" class="img-fluid float-left">
                            <h5 class="mb-1">{{$popular_post->title}}</h5>
                            <small>{{ $popular_post->getPostDate() }}</small>
                        </div>
                    </a>
                @endforeach

            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->


    <div class="widget">
        <h2 class="widget-title">Категории на сайте</h2>
        <div class="link-widget">
            <ul>
                @foreach($categories_for_H as $category)
                <li><a href="{{ route('category.single', ['slug' => $category->slug]) }}">{{ $category->title }}<span>{{ $category->posts_count }}</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->
