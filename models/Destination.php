<?php namespace Mohsin\Radar\Models;

use Flash;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Destination Model
 */
class Destination extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mohsin_radar_destinations';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['lat'];

    /**
    * @var model Validation rules
    */
    protected $rules = [
      'name'         => 'required|between:2,60',
      'address'      => 'required|between:2,80',
      'lat'          => 'required|regex:/[\d]{1,4},[\d]{1,6}/',
      'lng'          => 'required|regex:/[\d]{1,4},[\d]{1,6}/',
      'addr'         => 'required|between:2,80'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}
