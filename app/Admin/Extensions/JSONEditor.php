<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class JSONEditor extends Field
{
    protected $view = 'admin.json-editor';

    protected static $css = [
        '/packages/codemirror/lib/codemirror.css',
    ];

    protected static $js = [
        '/packages/codemirror/lib/codemirror.js',
        '/packages/codemirror/addon/edit/matchbrackets.js',
        '/packages/codemirror/mode/htmlmixed/htmlmixed.js',
        '/packages/codemirror/mode/xml/xml.js',
        '/packages/codemirror/mode/javascript/javascript.js',
        '/packages/codemirror/mode/css/css.js',
        '/packages/codemirror/mode/clike/clike.js'
    ];

    public function render()
    {
        $this->script = <<<JS

CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
    lineNumbers: true,
    mode: "application/json",
    extraKeys: {
        "Tab": function(cm){
            cm.replaceSelection("  " , "end");
        }
     }
});

JS;
        return parent::render();

    }
}