<?php

use app\TripSorter\Transportation\AirportBus;

class AirportBusTest extends PHPUnit\Framework\TestCase
{

    protected $bus;

    protected $trip = array(
        'Departure' => 'C',
        'Arrival' => 'D',
        'Transportation' => 'AirportBus',
    );

    public function setUp(){
        $this->bus = new AirportBus($this->trip);
    }

    public function testGetMessage()
    {
        $message = $this->bus->getMessage();
        $this->assertTrue(strlen($message) > 0);
    }
}
