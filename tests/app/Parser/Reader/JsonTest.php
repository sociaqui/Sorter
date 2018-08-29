<?php

use app\Parser\Reader\Json;

class JsonTest extends PHPUnit\Framework\TestCase
{

    protected $parser;
    protected $jsonFile = '/var/www/example.json';
    protected $jsonString = <<<EOD
[
        {
            "Departure": "Barcelona",
            "Arrival": "Gerona Airport",
            "Transportation": "AirportBus"
        },
        {
            "Departure": "Stockholm",
            "Arrival": "New York",
            "Transportation": "Plane",
            "Transportation_number": "SK22",
            "Seat": "7B",
            "Gate": "22"
        }
    ]
EOD;

    public function setUp()
    {
        $this->parser = new Json();
    }

    public function testFromString()
    {
        $data = $this->parser->fromString($this->jsonString);
        $this->assertTrue(is_array($data));
    }

    public function testFromFile()
    {
        $data = $this->parser->fromFile($this->jsonFile);
        $this->assertTrue(is_array($data));
    }
}
