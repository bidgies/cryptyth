<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('make:service {name}', function () {
  $name = $this->argument('name');
  $serviceContents = "<?php

namespace App\Services;
use App\Services\Contracts\\".$name."Service as I".$name."Service;

class ".$name."Service implements I".$name."Service
{

}
";
    $interfaceContents = "<?php

namespace App\Services\Contracts;

interface ".$name."Service
{

}
";

    $providerContents = "<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\\".$name."Service;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      \$this->app->bind('App\Services\Contracts\\".$name."Service', function (\$app) {
          return new ".$name."Service();
        });
    }
}
";
    $this->comment('Creating '.$name.'Service files');
    file_put_contents('app/Services/'.$name.'Service.php', $serviceContents);
    file_put_contents('app/Services/Contracts/'.$name.'Service.php', $interfaceContents);

    $this->comment('Creating '.$name.'ServiceProvider');
    file_put_contents('app/Providers/'.$name.'ServiceProvider.php', $providerContents);

    $this->comment('To implement, update config/app.php to include your new provider.');
})->describe('Create a service');
