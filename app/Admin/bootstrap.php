<?php

use App\Admin\Extensions\JSONEditor;
use Encore\Admin\Form;

app('view')->prependNamespace('admin', resource_path('views/admin'));
app('translator')->addNamespace('admin', resource_path('lang/admin'));

Form::forget(['map', 'editor']);
Form::extend('json', JSONEditor::class);
