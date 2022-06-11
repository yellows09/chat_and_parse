<?php

namespace App\Services;

use Jenssegers\Agent\Agent;

class GetUserInformation
{
    public $agent;

    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    /**
     * @return array
     */
    public function isRobot() : array
    {
        $isRobot = $this->agent->isRobot();
        return [
            'isRobot' => $isRobot
        ];
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $browser = $this->agent->browser();
        $platform = $this->agent->platform();
        return [
            'Browser' => $browser,
            'Platform' => $platform,
        ];
    }
}
