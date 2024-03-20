<?php

declare(strict_types=1);

interface Figure {
    public function calc(): float;
}

class Shape implements Figure
{

    public function __construct(private float $width,private float $height)
    {}

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }


    public function calc(): float
    {
        return $this->width * $this->height;
    }
}

class Triangle implements Figure
{

    public function __construct(private float $radius)
    {}

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): void
    {
        $this->radius = $radius;
    }

    public function calc(): float
    {
        return $this->radius * $this->radius * pi();
    }
}



class AreaCalculator
{
    /**
     * @param Figure[] $shapes
     * @return float|int
     */
    public function calculate(array $shapes)
    {
        $area = array_map(fn(Figure $shape) => $shape->calc(), $shapes);
        return array_sum($area);
    }
}