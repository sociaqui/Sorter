<?php

namespace app\TripSorter;

/**
 * Class TripSorter
 */
class TripSorter
{

    /**
     * Array of trips
     *
     * @var array
     */
    private $tripCollection = array();

    /**
     * Default set of transportation
     *
     * @var array
     */
    protected static $transportation = array(
        'train' => 'app\TripSorter\Transportation\Train',
        'airportbus' => 'app\TripSorter\Transportation\AirportBus',
        'plane' => 'app\TripSorter\Transportation\Plane',
    );

    public function __construct(array $tripCollection)
    {
        $this->tripCollection = $tripCollection;
    }

    /**
     * Extract the first and the last Trip
     *
     * @return array
     */
    private function extractFirstLastTrip()
    {
        // If trip is shorter than 3 legs, there is actually no need anymore
        if (count($this->tripCollection) < 2) {
            return $this->tripCollection;
        }

        // Find the start and end point for the trips
        for ($i = 0, $max = count($this->tripCollection); $i < $max; $i++) {
            $hasPreviousTrip = false;
            $isLastTrip = true;

            foreach ($this->tripCollection as $index => $trip) {
                // If this trip is attached to a previous trip, we pass!
                if (strcasecmp($this->tripCollection[$i]['Departure'], $trip['Arrival']) == 0) {
                    $hasPreviousTrip = true;
                } // If this trip is not the last trip, we pass!
                elseif (strcasecmp($this->tripCollection[$i]['Arrival'], $trip['Departure']) == 0) {
                    $isLastTrip = false;
                }
            }

            // We found the start point of the trip,
            // so we put it on the top of the list
            if (!$hasPreviousTrip) {
                array_unshift($this->tripCollection, $this->tripCollection[$i]);
                unset($this->tripCollection[$i]);
            } // And the end of the trip
            elseif ($isLastTrip) {
                array_push($this->tripCollection, $this->tripCollection[$i]);
                unset($this->tripCollection[$i]);
            }

        }

        // Reset indexes
        $this->tripCollection = array_merge($this->tripCollection);
    }

    /**
     * Sort a trip collection from Departure to Arrival
     *
     * @return $this
     */
    public function sort()
    {
        $this->extractFirstLastTrip();
        $this->paringTrips();

        return $this;
    }

    /**
     * Paring trips
     */
    private function paringTrips()
    {
        // Start pairing trips
        for ($i = 0, $max = count($this->tripCollection) - 1; $i < $max; $i++) {

            foreach ($this->tripCollection as $index => $trip) {

                if (strcasecmp($this->tripCollection[$i]['Arrival'], $trip['Departure']) == 0) {
                    $nextIndex = $i + 1;

                    $tempRow = $this->tripCollection[$nextIndex];
                    $this->tripCollection[$nextIndex] = $trip;
                    $this->tripCollection[$index] = $tempRow;

                    break;
                }
            }
        }
    }

    /**
     * Get sorted transportation as an array of objects
     *
     * @return array
     * @throws Exception\RuntimeException
     */
    public function getTransportation()
    {
        $transportationList = array();

        if (count($this->tripCollection) == 0) {
            return $transportationList;
        }

        foreach ($this->tripCollection as $trip) {
            $type = strtolower($trip['Transportation']);

            if (!isset(static::$transportation[$type])) {
                throw new Exception\RuntimeException(
                    sprintf(
                        'Unsupported transportation : %s',
                        $type
                    )
                );
            }
            $transportationList[] = new static::$transportation[$type]($trip);
        }

        return $transportationList;

    }

    /**
     * Get the sorted Trips
     *
     * @return array
     */
    public function getTripCollection()
    {
        return $this->tripCollection;
    }
}
