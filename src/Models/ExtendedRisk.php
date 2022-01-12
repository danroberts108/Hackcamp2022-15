<?php

class ExtendedRisk extends Risk
{
    protected $riskLevel;

    public function __construct($id, $lat, $lon, $distance, $district, $riskLevel)
    {
        parent::__construct($lat, $lon, $distance, $district);
        $this->riskLevel = $riskLevel;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRiskLevel()
    {
        return $this->riskLevel;
    }

    /**
     * @param mixed $riskLevel
     */
    public function setRiskLevel($riskLevel): void
    {
        $this->riskLevel = $riskLevel;
    }

}