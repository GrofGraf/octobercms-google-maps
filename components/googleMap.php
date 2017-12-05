<?php namespace GrofGraf\GoogleMaps\Components;

use Cms\Classes\ComponentBase;
use GrofGraf\GoogleMaps\Models\Settings;

class googleMap extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'googleMap Component',
            'description' => 'Component for google map'
        ];
    }

    public function defineProperties()
    {
      return [];
    }

    public function onRun(){
      $marker_image = null;
      if(Settings::instance()->get_marker_image()){
        $marker_image = Settings::instance()->get_marker_image()->path;
      }
      $this->page['map'] = [
        'height' => Settings::get('height'),
        'width' => Settings::get('width'),
        'latitude' => Settings::get('latitude'),
        'longtitude' => Settings::get('longtitude'),
        'zoom' => Settings::get('zoom'),
        'type' => Settings::get('map_type'),
        'show_marker' => Settings::get('show_marker'),
        'marker_image' => $marker_image
      ];
      $this->addJs('assets/js/main.js');
      $this->addJs('https://maps.googleapis.com/maps/api/js?key=' . Settings::get('api_key') . '&callback=initMap');
    }

    public function getHeight(){
      return Settings::get('height');
    }
    public function getWidth(){
      return Settings::get('width');
    }

    public function getDirectionsButtonText(){
      return Settings::instance()->directions_button_text;
    }
}
