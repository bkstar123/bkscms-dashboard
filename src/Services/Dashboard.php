<?php
/**
 * @author: tuanha
 * @last-mod: 19-Nov-2019
 */
namespace Bkstar123\BksCMS\Dashboard\Services;

use Bkstar123\BksCMS\Dashboard\Contracts\Dashboard as DashboardContract;

class Dashboard implements DashboardContract
{

    /**
     * Get system information including CPU, memory utilization, HDD usage & bandwidth in/out
     *
     * @return array
     */
    public function getSysInfo() : array
    {
        /**
         * Network Statistics and CPU usage
         */

        // network statistics at sample t0
        $rx = trim(file_get_contents(config('bkstar123_bkscms_dashboard.rx_bytes_stream_path'))); // in bytes
        $tx = trim(file_get_contents(config('bkstar123_bkscms_dashboard.tx_bytes_stream_path'))); // in bytes

        // cpu time at sample t0
        $cpuStatsT0 =  shell_exec("cat /proc/stat | awk '/cpu /{print ($2+$3+$4+$5+$6+$7+$8+$9+$10) \" \" $5}'");
        list($totalCPUTimeT0, $idleCPUTimeT0) = explode(' ', $cpuStatsT0);
        
        // specify the dt (delta time)
        // dt = 1 sec
        // if being too high, it will reduce the system performance when redirecting to/from dashboard page)
        $dt = 1;
        sleep($dt);

        // increment network statistics after dt
        $drx = trim(file_get_contents(config('bkstar123_bkscms_dashboard.rx_bytes_stream_path'))) - $rx; // in bytes
        $dtx = trim(file_get_contents(config('bkstar123_bkscms_dashboard.tx_bytes_stream_path'))) - $tx; // in bytes
        $sysStat['rx_total'] = round($rx/1048576, 2); // in MBs
        $sysStat['tx_total'] = round($tx/1048576, 2); // in MBs
        $sysStat['rx_rate'] = $drx/$dt; // in bytes/sec
        $sysStat['tx_rate'] = $dtx/$dt; // in bytes/sec
        $sysStat['human_rx_rate'] = $this->setAppropriateUnitForNetworkRate($drx);
        $sysStat['human_tx_rate'] = $this->setAppropriateUnitForNetworkRate($dtx);
        
        // increment cpu time after dt
        $cpuStatsT1 =  shell_exec("cat /proc/stat | awk '/cpu /{print ($2+$3+$4+$5+$6+$7+$8+$9+$10) \" \" $5}'");
        list($totalCPUTimeT1, $idleCPUTimeT1) = explode(' ', $cpuStatsT1);
        $totalCPUTimeDelta = intval($totalCPUTimeT1) - intval($totalCPUTimeT0);
        $idleCPUTimeDelta = intval($idleCPUTimeT1) - intval($idleCPUTimeT0);
        $cpuUtilization = (1 - $idleCPUTimeDelta/$totalCPUTimeDelta)*100;
        $sysStat['cpu_usage'] = round($cpuUtilization, 2); // in percentage

        /**
         * Memery usage
         */
        if (config('bkstar123_bkscms_dashboard.system_os') === 'centos6') {
            $sysStat['memory_usage'] = round(shell_exec("free | awk '/Mem/{print ($3-$6-$7)/$2 * 100}'"), 2);
        } elseif (config('dashboard.system_os') === 'centos7') {
            $sysStat['memory_usage'] = round(shell_exec("free | awk '/Mem/{print $3/$2 * 100}'"), 2);
        } else {
            $sysStat['memory_usage'] = 0; // only support centos6 & centos7
        }
        
        $mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
        $sysStat['memory_total'] = round(preg_replace("/[^0-9]+(?:\.[0-9]*)?/", "", $mem_result)/1048576, 3); // in GBs
        
        /**
         * Disk space usage
         */
        $disk_free =  round(disk_free_space("/")/1073741824, 2);
        $disk_total = round(disk_total_space("/")/1073741824, 2);
        $sysStat['hdd_usage'] = round(($disk_total - $disk_free)/$disk_total*100, 2); # in percentage
        $sysStat['hdd_total'] = $disk_total; // in GBs

        /**
         * Display time
         */
        $sysStat['display_time'] = time(); // in seconds
        $sysStat['human_display_time'] = date('r', $sysStat['display_time']); // human-readable datetime string
        
        return $sysStat;
    }

    /**
     * Convert the bandwidth in/out information into human-readable format
     *
     * @param string $data
     * @return string
     */
    protected function setAppropriateUnitForNetworkRate($data)
    {
        if ($data < 1024) {
            return $data.' bytes/s';
        } elseif ($data > 1024 && $data < 1048576) {
            return round($data/1024, 2).' KBs/s';
        } elseif ($data > 1048576 && $data < 1073741824) {
            return round($data/1048576, 2).' MBs/s';
        } elseif ($data > 1073741824) {
            return round($data/1073741824, 2).' GBs/s';
        }
    }
}
