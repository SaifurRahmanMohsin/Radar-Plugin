<?php namespace Mohsin\Radar\Components;

class DistanceMatrix
{
    public $destination_addresses;

    public $origin_addresses;

    public $rows;

    public $status;

    /*
     * Returns true if distance matrix JSON returns OK
     */
    public function isOK()
    {
      if($this -> status == "OK")
        return true;
      else
        return false;
    }

}
