<?php

namespace Club\ExtraBundle\Twig;

class GoogleMapExtension extends \Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'club_google_map' => new \Twig_Function_Method($this, 'render')
        );
    }

    public function render($longitude, $latitude, $name)
    {
        $key = $this->container->getParameter('club_extra.google_maps_key');

        if (!$key) {
            return;
        }

        return $this->container->get('templating')->render(
            'ClubExtraBundle:GoogleMap:index.html.twig', array(
                'key' => $key,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'name' => $name
            )
        );
    }

    public function getName()
    {
        return 'club_google_map';
    }
}

