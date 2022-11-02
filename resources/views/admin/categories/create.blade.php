@extends('admin.layouts.layout')

@section('content')





        <section class="content">
            <div class="mt-2">
                <div class="container-fluid" >

                    <div class="row">

                        <div class="col-12">

                            <div class="card mt-5">

                                <div class="card-header">
                                    <h3 class="card-title">Добавление новой категории</h3>
                                </div>

                                <form role="form" method="post"  action="{{ route('categories.store') }}">

                                    @csrf

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Название категории</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="title" name="title" placeholder="Категория...">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>




        <!-- /.content -->



@endsection

