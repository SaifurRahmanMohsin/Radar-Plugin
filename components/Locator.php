<?php namespace Mohsin\Radar\Components;

use Redirect;
use Cms\Classes\ComponentBase;

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
    $this->page['directions'] = 'mohsin.radar::lang.locator.directions';
  }

  public function onFindBranch()
  {
    $user_addr = post('addr');
    return Redirect::to('http://maps.google.com/maps?saddr=' . post('saddr') . '&daddr=' . post('daddr'));
  }

}
