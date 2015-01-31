<?php namespace Mohsin\Radar\Components;

class Element
{
    public $id;
    public $distance;
    public $status;

    public function __construct($id, $arr)
      {
        $this -> id = $id;
        $this -> status = $arr["status"];
        ($this -> status == "OK") ? $this -> distance = $arr["distance"]["value"] : $this -> distance = PHP_INT_MAX;
      }

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
