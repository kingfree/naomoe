<?php

use App\Admin\Extensions\JSONEditor;
use Encore\Admin\Form;

app('translator')->addNamespace('admin', resource_path('lang/admin'));
app('view')->prependNamespace('admin', resource_path('views/admin'));

Form::forget(['map', 'editor']);
Form::extend('json', JSONEditor::class);
