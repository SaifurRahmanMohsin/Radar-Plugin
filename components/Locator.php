<?php namespace Mohsin\Radar\Components;

use Cms\Classes\ComponentBase;
use Redirect;

class Locator extends ComponentBase
{

  public $addresses;

  public function componentDetails()
  {
    return [
      'name'        => 'Locator Component',
      'description' => 'An input for user to enter their address and get the route map to the nearest branch.'
    ];
  }


  // This array becomes available on the page as {{ locator.addresses }}
  public function addresses()
  {
    return ['First Address', 'Second Address', 'Third Address'];
  }

  public function onFindBranch()
  {
    $user_addr = post('addr');
    return Redirect::to('http://maps.google.com/maps?saddr=' . post('saddr') . '&daddr=' . post('daddr'));
  }

  }
