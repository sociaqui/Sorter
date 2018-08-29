<?php

use app\TripSorter\Transportation\Plane;

class PlaneTest extends PHPUnit\Framework\TestCase
{

    protected $plane;

    protected $trip = array(
        'Departure' => 'A',
        'Arrival' => 'B',
        'Transportation' => 'Plane',
        'Transportation_number' => '10A',
        'Seat' => '10A',
        'Gate' => '10A',
    );

    public function setUp()
    {
        $this->plane = new Plane($this->trip);
    }

    public function testGetMessage()
    {
        $message = $this->plane->getMessage();
        $this->assertTrue(strlen($message) > 0);
    }
}
