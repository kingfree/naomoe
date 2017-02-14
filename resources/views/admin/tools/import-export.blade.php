@extends('admin::index')

@section('content')
    <section class="content-header">
        <h1>
            导入角色列表
            <small>从文件中生成角色和角色池</small>
        </h1>

    </section>

    <section class="content">

        @include('admin::partials.error')
        @include('admin::partials.success')
        @include('admin::partials.exception')

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{ route('import') }}" class="form-inline" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="file" name="import_file"/>
                    <button type="submit" class="btn btn-primary">导入文件</button>
                </form>
            </div>
        </div>
    </section>
@endsection