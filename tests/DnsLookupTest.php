<?php

namespace Tests\Unit;

namespace Riddman\DnsLookup;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class DnsLookupTest extends TestCase
{
    public function testGetDnsRecords()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'Answer' => [
                    [
                        'name' => 'example.com',
                        'type' => 'A',
                        'data' => '93.184.216.34',
                    ],
                    [
                        'name' => 'example.com',
                        'type' => 'MX',
                        'data' => '10 mx.example.com',
                    ],
                ],
            ])),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $dnsLookup = new DnsLookup($httpClient);
        $domain = 'example.com';

        $dnsRecords = $dnsLookup->getDnsRecords($domain);

        $this->assertCount(2, $dnsRecords);

        $this->assertEquals('example.com', $dnsRecords[0]['name']);
        $this->assertEquals('A', $dnsRecords[0]['type']);
        $this->assertEquals('93.184.216.34', $dnsRecords[0]['data']);

        $this->assertEquals('example.com', $dnsRecords[1]['name']);
        $this->assertEquals('MX', $dnsRecords[1]['type']);
        $this->assertEquals('10 mx.example.com', $dnsRecords[1]['data']);
    }
}
