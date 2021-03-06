<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $form->title() }}</h3>

        <div class="box-tools">

            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="{{ $resource }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;{{ trans('admin::lang.list') }}</a>
            </div>

            <div class="btn-group pull-right" style="margin-right: 10px">
                <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('admin::lang.back') }}</a>
            </div>

        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! $form->open(['class' => "form-horizontal"]) !!}
        <div class="box-body">

            @if(!$tabObj->isEmpty())
                @include('admin::form.tab', compact('tabObj'))
            @else
                <div class="fields-group">
                    @foreach($form->fields() as $field)
                        @if( ! $field instanceof \Encore\Admin\Form\Field\HasMany)
                            {!! $field->render() !!}
                        @endif
                    @endforeach
                </div>
                <div class="fields-group">
                    @foreach($form->fields() as $field)
                        @if( $field instanceof \Encore\Admin\Form\Field\HasMany)
                            {!! $field->render() !!}
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-2 col-lg-2">

            </div>
            <div class="col-sm-8 col-lg-8">

                <div class="btn-group pull-right">
                {!! $form->submit() !!}
                </div>

                <div class="btn-group pull-left">
                    <input type="reset" class="btn btn-warning" value="{{ trans('admin::lang.reset') }}"/>
                </div>

            </div>

        </div>

        @foreach($form->getHiddenFields() as $hiddenField)
            {!! $hiddenField->render() !!}
        @endforeach

        <!-- /.box-footer -->
    {!! $form->close() !!}
</div>

