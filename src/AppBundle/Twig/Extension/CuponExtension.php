<?php

namespace AppBundle\Twig\Extension;

class CuponExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('descuento', array($this, 'descuento')),
            );
    }

    public function descuento($precio, $descuento, $decimales = 0)
    {
        if (!is_numeric($precio) || !is_numeric($descuento)) {
            return '-';
        }
        if ($descuento == 0 || $descuento == null) {
            return '0%';
        }
        $precio_original = $precio + $descuento;
        $porcentaje = ($descuento / $precio_original) * 100;
        return '-'.number_format($porcentaje, $decimales).'%';
    }

        public function getName()
    {
    return 'cupon';
    }
}