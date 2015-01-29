<?php namespace Mohsin\Radar;

use Backend;
use System\Classes\PluginBase;

/**
 * Radar Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'mohsin.radar::lang.plugin.name',
            'description' => 'mohsin.radar::lang.plugin.description',
            'author'      => 'Saifur Rahman Mohsin',
            'icon'        => 'icon-map-marker'
        ];
    }

    /**
    * Registers the location component.
    *
    * @return array
    */
    public function registerComponents()
    {
        return [
          'Mohsin\Radar\Components\Locator' => 'locator'
        ];
    }

    /**
    * Registers a Settings Page.
    *
    * @return array
    */
    public function registerSettings()
    {
        return [
          'radar' => [
            'label'       => 'mohsin.radar::lang.plugin.name',
            'description' => 'mohsin.radar::lang.plugin.settingsinfo',
            'category'    => 'mohsin.radar::lang.plugin.name',
            'icon'        => 'icon-dot-circle-o',
            'url'         => Backend::url('mohsin/radar/destinations'),
            'order'       => 500,
            'keywords'    => 'address place branch'
          ],
          'settings' => [
              'label'       => 'mohsin.radar::lang.settings.label',
              'description' => 'mohsin.radar::lang.settings.description',
              'category'    => 'mohsin.radar::lang.plugin.name',
              'icon'        => 'icon-cog',
              'class'       => 'Mohsin\Radar\Models\Settings',
              'order'       => 500
          ]
          ];
    }

    public function registerFormWidgets()
    {
      return [
        'Mohsin\Radar\FormWidgets\GeoAddress' => [
          'label' => 'Geo Address',
          'alias' => 'geoaddress'
        ],
      ];
    }
}
