<?php

namespace Riddman\DnsLookup;

use Illuminate\Support\ServiceProvider;
use Riddman\DnsLookup\DnsLookup;
use GuzzleHttp\Client;

class DnsLookupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('dns-lookup', function () {
            $httpClient = new Client();
            return new DnsLookup($httpClient);
        });
    }

    public function boot()
    {
        //
    }
}
