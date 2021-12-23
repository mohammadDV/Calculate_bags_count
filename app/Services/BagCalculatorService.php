<?php

namespace App\Services;

class BagCalculatorService {
    private $length         = null;
    private $width          = null;
    private $depth          = null;
    private $unit           = null;
    private $depth_unit     = null;
    private $bags_count     = 0;
    const BAG_COST          = 72;
    const X                 = 0.025;
    const Y                 = 1.4;
    const METERS = [
        'Meter'           => 1,
        'Yard'            => 1.09361,
        'Inch'            => 39.3701,
        'Foot'            => 3.28084,
        'Centimeters'     => 100,
    ];

    public function set_dimensions(int $length,int $with, int $depth) : void {
        $this->length   = $length;
        $this->width    = $with;
        $this->depth    = $depth;
    }

    public function set_units(string $unit, string $depth_unit) : void {
        $this->unit         = ucfirst($unit);
        $this->depth_unit   = ucfirst($depth_unit);
    }

    private function convert_to_meter() : void
    {
        $this->length   = $this->length / self::METERS[$this->unit];
        $this->width    = $this->width  / self::METERS[$this->unit];
        $this->depth    = $this->depth  / self::METERS[$this->depth_unit];
    }

    public function calculate_bags_count() : int
    {
        $this->convert_to_meter();
        $Cubic_meters       = $this->length * $this->width * $this->depth;
        $this->bags_count   = ceil($Cubic_meters * self::X * self::Y);
        return $this->bags_count;
    }

    public function calculate_prices() : int
    {
        return $this->bags_count * self::BAG_COST;
    }
}
