<?php

use App\Admin\Extensions\JSONEditor;
use Encore\Admin\Form;

Form::forget(['map']);
Form::extend('json', JSONEditor::class);
