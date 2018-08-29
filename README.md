# TRIP SORTER

## Installation
clone / download / copy project to your web server root folder (/var/www usually)

the tests in tests folder are for PHPUnit

You can get PHPUnit any way that is [convenient for you](https://phpunit.de/getting-started/phpunit-7.html), but I strongly suggest installing it with [Composer](https://getcomposer.org/) - the composer.json file can be found in the root directory.

## Usage
Navigate to the \index.phtml subpage of your domain and use the primitive UI to give the sorter an input list.
Currently the only working format is as follows:

a json file, containing an unordered list of 'transportation' (boarding card / ticket) objects. Each transportation object should have at least 3 porperties:

 1. "Departure"
 1. "Arrival"
 1. "Transportation"
 (Transportation is currently limited to 3 options. Following the example from the task description: Plane, Train and AirportBus).
 * Transportation_number, Seat, Gate, and Baggage are optional.
 
 An example.json file can be found in the root directory.