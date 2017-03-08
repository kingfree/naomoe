<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class KanPiao extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }

    public function script()
    {
        $token = csrf_token();
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {

    if(confirm("确定标记?")) {
        $.ajax({
            method: 'post',
            url: '/admin/api/kanpiao',
            data: {
                _token: '{$token}',
                ids: selectedRows(),
                action: {$this->action}
            },
            success: function () {
                $.pjax.reload('#pjax-container');
                toastr.success('操作成功');
            }
        });
    }
});

EOT;

    }
}