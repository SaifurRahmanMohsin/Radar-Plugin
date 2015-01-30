<?php namespace Mohsin\Radar\Components;

use Lang;
use Redirect;
use Cms\Classes\ComponentBase;
use Mohsin\Radar\Models\Settings;
use Mohsin\Radar\Models\Destination;

class Locator extends ComponentBase
{

  public function componentDetails()
  {
    return [
      'name'        => 'mohsin.radar::lang.locator.name',
      'description' => 'mohsin.radar::lang.locator.description'
    ];
  }

  /*
   * This array becomes available on the page as {{ locator.addresses }}
   * You may use it to write your own code to mess with the destinations
   */
  public function addresses()
  {
    return Destination::lists('addr');
  }

  public function onRun()
  {
    $this -> page['directions'] = Lang::get('mohsin.radar::lang.locator.directions');
    $this -> addJs('http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false');
    $this -> addJs('/plugins/mohsin/radar/assets/js/location-autocomplete.js');
  }

  /*
   * Directs the user to google maps to display the route between user and closest branch
   */
  public function onRadar()
  {
    // Initialize variables
    $apikey     = Settings::get('api_key');
    $addresses  = $this->addresses();
    $dest       = join('|',$addresses);

    // Get user input
    $src = post('fmtaddr');
    $json = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $src . "&destinations=" . $dest . "&key=" . $apikey);
    $closest = $this->findShortestPath($json);
    return Redirect::to('http://maps.google.com/maps?saddr=' . $src . '&daddr=' . $closest);
  }

  /*
   * Internally used function
   * Takes distance matrix JSON, returns destination string with shortest distance
   */
  public function findShortestPath($json)
  {
    $pathsArray = json_decode($json, true);

    // Get all destinations as array
    $destinations = array_map(function($json) {
      return $json;
    }, $pathsArray["destination_addresses"]);

    // Get all distances as array
    $distances = array_map(function($elements) {
          return $elements;
    }, $pathsArray["rows"][0]);

    foreach($distances as $elements) {
      foreach($elements as $element) {
        if($element["status"] == "OK") {
          $values = array_map(function($data) {
            return $data["distance"]["value"];
          }, $elements);
        } else if($element["status"] == "ZERO_RESULTS") {
          return $destinations[0];
        }
      }
    }

    $index = array_search(min($values), $values);
    return $destinations[$index];
  }

}
