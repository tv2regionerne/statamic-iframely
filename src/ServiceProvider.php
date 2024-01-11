<?php

namespace Tv2regionerne\StatamicIframely;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        Tags\Iframely::class,
    ];
    public function bootAddon()
    {
        //
    }
}
