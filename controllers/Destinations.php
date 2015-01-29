<?php namespace Mohsin\Radar\Controllers;

use Flash;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Mohsin\Radar\Models\Destination;

/**
 * Destinations Back-end Controller
 */
class Destinations extends Controller
{
    public $implement = ['Backend.Behaviors.FormController'];

    public $formConfig = 'config_form.yaml';

    public function index()
    {
      $this->pageTitle = 'mohsin.radar::lang.plugin.name';
      $this->addJs('/modules/backend/widgets/lists/assets/js/october.list.js', 'core');
      $this->vars['addresses'] = $addresses = Destination::select('id','addr')->get()->lists('id','addr');
    }

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Mohsin.Radar', 'destinations');
    }

    public function index_onDelete()
    {
      if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
        foreach ($checkedIds as $addrId) {
          if (!$addr = Destination::find($addrId))
            continue;
          $addr->delete();
        }
        Flash::success('mohsin.radar::lang.address.delete_success');
      }
      return Redirect::back();
    }
}
