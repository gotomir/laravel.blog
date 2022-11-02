@extends('admin.layouts.layout')

@section('content')

<section class="content">
    <div class="mt-2">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование статьи</h3>
                        </div>
                              <form role="form" method="post"  action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="card-body">
                                      <div class="form-group">
                                          <label for="title">Название статьи</label>
                                          <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                 id="title" name="title" value="{{ $post->title }}">
                                      </div>
                                      <div class="form-group">
                                          <label for="description">Цитата</label>
                                          <textarea class="form-control @error('description') is-invalid @enderror"
                                                    id="description" name="description">{{ $post->description}}</textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="content">Текст статьи</label>
                                          <textarea class="form-control @error('content') is-invalid @enderror"
                                                    id="content" name="content">{{ $post->content }}</textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="category_id">Категория</label>
                                          <select class="form-control" id="category_id" name="category_id">
                                              @foreach($categories as $k => $v)
                                                  <option value="{{ $k }}" @if($k == $post->category_id) selected @endif>{{ $v }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="tags">Теги</label>
                                          <select name="tags[]" id="tags" class="select2" multiple="multiple"
                                                  data-placeholder="Выбор тегов" style="width: 100%;">
                                              @foreach($tags as $k => $v)
                                                  <option value="{{ $k }}" @if(in_array($k, $post->tags->pluck('id')->all()
                                                  )) selected @endif>{{ $v }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="thumbnail">Изображение</label>
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file" name="thumbnail" id="thumbnail"
                                                         class="custom-file-input">
                                                  <label class="custom-file-label" for="thumbnail">Choose file</label>
                                              </div>
                                          </div>
                                          <img src="{{ $post->imgGet() }}" width="200" class="img-thumbnail mt-3">
                                      </div>
                                  </div>
                                  <div class="card-footer">
                                      <button type="submit" class="btn btn-primary">Сохранить</button>
                                  </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>




    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>



@endsection

