# DnsLookup

Simple PHP package that allow us to get all DNS records for the specified domain name.

Requirements:
- PHP 8 or higher

## Installation

### Step 1
Add following record within repositories section:
    {
        "type": "vcs",
        "url": "git@github.com:riddman/dns-lookup.git"
    }

### Step 2
Run the following command

    composer require riddman/dns-lookup

## Usage

Example


    <?php

        use Riddman\DnsLookup\DnsLookup;
        use GuzzleHttp\Client;

        /* Some of your awesome code*/

        $httpClient = new Client();
        $dnsLookup = new DnsLookup($httpClient);

        $dnsRecords = $dnsLookup->getDnsRecords($domain);



Variable $dnsRecords will contains  the following data:

    [
    0 => [▶
        "name" => "gmail.com."
        "type" => 1
        "TTL" => 300
        "data" => "192.178.25.165"
    ]
    1 => [▶
        "name" => "gmail.com."
        "type" => 28
        "TTL" => 300
        "data" => "2a00:1450:401b:814::2005"
    ]
    2 => [▶
        "name" => "gmail.com."
        "type" => 16
        "TTL" => 300
        "data" => "globalsign-smime-dv=CDYX+XFHUw2wml6/Gb8+59BsH31KzUr6c1l2BPvqKX8="
    ]
]