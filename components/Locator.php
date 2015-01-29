<?php namespace Mohsin\Radar\Components;

use Lang;
use Redirect;
use Cms\Classes\ComponentBase;
use Mohsin\Radar\Models\Destination;

class Locator extends ComponentBase
{

  public $addresses;

  public function componentDetails()
  {
    return [
      'name'        => 'mohsin.radar::lang.locator.name',
      'description' => 'mohsin.radar::lang.locator.description'
    ];
  }

  public function onRun()
  {
    $this->page['directions'] = Lang::get('mohsin.radar::lang.locator.directions');
    $addresses = $this->page['addresses'] = Destination::lists('addr');
  }

  public function onRadar()
  {
    $user_addr = post('addr');
    return Redirect::to('http://maps.google.com/maps?saddr=' . post('saddr') . '&daddr=' . post('daddr'));
  }

}
