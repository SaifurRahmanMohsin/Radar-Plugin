<?php namespace Mohsin\Radar\Components;

use Lang;
use Redirect;
use JsonMapper;
use GuzzleHttp\Client;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Mohsin\Radar\Models\Settings;
use Mohsin\Radar\Models\Destination;
use Mohsin\Radar\Components\Element;
use Mohsin\Radar\Components\DistanceMatrix;

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
    // Initialize variables and get user input
    $apikey     = Settings::get('api_key');
    $addresses  = $this->addresses();
    $dest       = join('|',$addresses);
    $src        = post('fmtaddr');

    $client = new Client();
    $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $src . "&destinations=" . $dest . "&key=" . $apikey);
    $json = $response->json();
    $closest = $this->findShortestPath($json);
    return Redirect::to('http://maps.google.com/maps?saddr=' . $src . '&daddr=' . $closest);
  }

  /*
   * Internally used function
   * Takes distance matrix JSON, returns destination string with shortest distance
   */
  public function findShortestPath($json)
  {
    $dest = $this -> addresses()[0];
    $mapper = new JsonMapper();
    $matrix = $mapper->map($json, new DistanceMatrix());

    if($matrix -> status == "REQUEST_DENIED")
      return $dest;

    $rows = array();
    foreach($matrix -> rows[0]['elements'] as $row)
      array_push($rows, $row);

    $elements = array();
    foreach($rows as $key => $value)
      array_push($elements, new Element($key, $value));

    // Get all distances as array
    $distances = array_map(function($element) {
          return $element -> distance;
    }, $elements);

    // Get index of destination with least distance
    $index = array_search(min($distances), $distances);
      return $matrix -> destination_addresses[$index];
  }

}
