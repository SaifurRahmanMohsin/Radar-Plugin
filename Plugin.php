<?php namespace Mohsin\Radar;

use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{
  public function pluginDetails()
  {
    return [
      'name' => 'Radar',
      'description' => 'Determines closest branch to a customer',
      'author' => 'Saifur Rahman Mohsin',
      'icon' => 'icon-map-marker'
    ];
  }

  public function registerComponents()
  {
    return [
      'Mohsin\Radar\Components\Locator' => 'locator'
    ];
  }

  public function registerSettings()
  {
    return [
      'radar' => [
        'label'       => 'Radar',
        'description' => 'Manage the addresses of organization\'s branches.',
        'icon'        => 'icon-dot-circle-o',
        'url'         => Backend::url('mohsin/radar/addresses'),
        'order'       => 500,
        'keywords'    => 'address place branch'
        ]
      ];
    }
}
