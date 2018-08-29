<?php

use app\TripSorter\TripSorter;

class TripSorterTest extends PHPUnit\Framework\TestCase
{

    protected $tripCollection = array(
        array(
            'Departure' => 'C',
            'Arrival' => 'D',
            'Transportation' => 'AirportBus',
        ),
        array(
            'Departure' => 'A',
            'Arrival' => 'B',
            'Transportation' => 'Train',
        ),
        array(
            'Departure' => 'B',
            'Arrival' => 'C',
            'Transportation' => 'Plane',
            'Transportation_number' => '11A',
            'Seat' => '10A',
            'Gate' => '10A',
        ),
    );

    protected $expectedTripCollection = array(
        array(
            'Departure' => 'A',
            'Arrival' => 'B',
            'Transportation' => 'Train',
        ),
        array(
            'Departure' => 'B',
            'Arrival' => 'C',
            'Transportation' => 'Plane',
            'Transportation_number' => '11A',
            'Seat' => '10A',
            'Gate' => '10A',
        ),
        array(
            'Departure' => 'C',
            'Arrival' => 'D',
            'Transportation' => 'Bus',
        ),
    );

    public function setUp()
    {
        $this->tripSorter = new TripSorter($this->tripCollection);
    }

    public function testSort()
    {
        $sortedCollection = $this->tripSorter->sort()->getTripCollection();
        $this->assertTrue($this->areSimilar($this->expectedTripCollection, $sortedCollection));
    }

    public function testGetTransportation()
    {
        $transportation = $this->tripSorter->getTransportation();

        foreach ($transportation as $type)
            $this->assertInstanceOf('app\TripSorter\Transportation\AbstractTransportation', $type);
    }

    private function areSimilar($expectedCollection, $sortedCollection)
    {
        foreach ($sortedCollection as $key => $collection)
            if ($expectedCollection[$key]['Departure'] != $collection['Departure'])
                return false;

        return true;
    }
}
