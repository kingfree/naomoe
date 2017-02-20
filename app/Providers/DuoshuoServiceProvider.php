<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class DuoshuoServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once(app_path().'/Helpers/Duoshuo/SDK.php');
    }

}
