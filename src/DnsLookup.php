<?php

namespace Riddman\DnsLookup;

use GuzzleHttp\Client;

class DnsLookup
{
    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getDnsRecords(string $domain): array
    {
        $response = $this->httpClient->get('https://dns.google/resolve', [
            'query' => [
                'name' => $domain,
                'type' => 'ANY',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['Answer'] ?? [];
    }
}