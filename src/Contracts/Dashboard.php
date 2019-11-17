<?php
/**
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */
namespace Bkstar123\BksCMS\Dashboard\Contracts;

interface Dashboard
{

    /**
     * Get system information including CPU, memory utilization, HDD usage as well as bandwidth in/out
     *
     * @return array
    */
    public function getSysInfo() : array;
}
