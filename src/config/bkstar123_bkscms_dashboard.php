<?php 
/**
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */
return [
    'refresh_interval' => 1000, // defaults to one second
    'rx_bytes_stream_path' => env('RX_BYTES_STREAM_PATH', '/sys/class/net/eth0/statistics/rx_bytes'),
    'tx_bytes_stream_path' => env('TX_BYTES_STREAM_PATH', '/sys/class/net/eth0/statistics/tx_bytes'),
    'system_os' => env('SYSTEM_OS', 'centos6'),
];
