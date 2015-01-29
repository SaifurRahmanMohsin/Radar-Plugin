<?php namespace Mohsin\Radar;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
  public function pluginDetails()
  {
    return [
      'name' => 'mohsin.radar::lang.plugin.name',
      'description' => 'mohsin.radar::lang.plugin.description',
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
        'label'       => 'mohsin.radar::lang.plugin.name',
        'description' => 'mohsin.radar::lang.plugin.settingsinfo',
        'icon'        => 'icon-dot-circle-o',
        'url'         => Backend::url('mohsin/radar/addresses'),
        'order'       => 500,
        'keywords'    => 'address place branch'
        ]
      ];
    }
}
