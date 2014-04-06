<?php

namespace Club\ExtraBundle\Helper;

class GoogleGeocode
{
    private $container;

    private $sensor = 'false';
    private $outputFormat;
    private $key;
    private $result;
    private $decodedResult;

    public function __construct($container)
    {
        $this->container = $container;

        $this->outputFormat = $container->getParameter('club_extra.google_geocode_output_format');
        $this->key = $container->getParameter('club_extra.google_geocode_key');
    }

    public function lookupAddress($address)
    {
        $url = sprintf('https://maps.googleapis.com/maps/api/geocode/%s?address=%s&sensor=%s&key=%s',
            $this->outputFormat,
            urlencode($address),
            $this->sensor,
            $this->key
        );

        $this->decodedResult = null;
        $this->result = file_get_contents($url);

        return $this;
    }

    public function lookupLatLon($latitude, $longitude)
    {
        $url = sprintf('https://maps.googleapis.com/maps/api/geocode/%s?latlng=%s,%s&sensor=%s&key=%s',
            $this->outputFormat,
            $latitude,
            $longitude,
            $this->sensor,
            $this->key
        );

        $this->decodedResult = null;
        $this->result = file_get_contents($url);

        return $this;
    }

    public function getRawResult()
    {
        return $this->result;
    }

    public function getFirstResult()
    {
        if (!$this->decodedResult) {
            $this->decode();
        }

        return $this->decodedResult->results[0];
    }

    public function getStatus()
    {
        if (!$this->decodedResult) {
            $this->decode();
        }

        return $this->decodedResult->status;
    }

    private function decode()
    {
        $this->decodedResult = json_decode($this->result);

        return $this;
    }
}
