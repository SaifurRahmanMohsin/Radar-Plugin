<?php namespace Mohsin\Radar\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'mohsin_radar_settings';

    public $settingsFields = 'fields.yaml';

}
