<?php namespace Mohsin\Radar\FormWidgets;

use HTML;
use Mohsin\Radar\Models\Settings;
use Backend\Classes\FormWidgetBase;

/**
 * Google Place
 * Renders a geocoded address field.
 *
 * Usage:
 *
 *   address:
 *       label: Address
 *       type: geoaddress
 *       fieldMap:
 *           latitude: latitude
 *           longitude: longitude
 *           city: city
 *           zip: zip
 *
 * @package responsiv\pyrolancer
 * @author Responsiv Internet
 */
class GeoAddress extends FormWidgetBase
{
    /**
     * {@inheritDoc}
     */
    public $defaultAlias = 'geoaddress';

    protected $fieldMap;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fieldMap = $this->getConfig('fieldMap', []);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('geoaddress');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['field'] = $this->formField;
        Settings::get('use_map') == 1 ? $this->vars['map'] = '<div id="map-canvas" style="height: 300px" class="span-full"></div>' : $this->vars['map'] = '';
    }

    public function getFieldMapAttributes()
    {
        $widget = $this->controller->formGetWidget();
        $fields = $widget->getFields();
        $result = [];
        foreach ($this->fieldMap as $map => $fieldName) {

            if (!$field = array_get($fields, $fieldName))
                continue;

            $result['data-input-'.$map] = '#'.$field->getId();
        }

        return HTML::attributes($result);
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addJs('http://maps.googleapis.com/maps/api/js?libraries=places&signed_in=true&sensor=false');
        if(Settings::get('use_map') == 1)
          $this->addJs('js/geoaddress-main.js', 'core');
        else
          $this->addJs('/plugins/mohsin/radar/assets/js/location-autocomplete.js', 'core');
    }

}
