@extends('cms.layouts.master')
@section('title','Dashboard')
@section('content')
<div class="row">
     <!--Time -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="badge bg-maroon">
                        Time of measurement
                    </span>
                </h3>
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span>
                            <strong>
                                <div id="human-display-time">
                                    {{ $sysinfo['human_display_time'] }}
                                </div>
                            </strong>
                        </span>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <!-- CPU Usage -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="badge bg-green">
                        CPU
                    </span>
                </h3>
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span id="cpu-usage-value" class="badge bg-green">
                            CPU usage: {{ $sysinfo['cpu_usage'] }}%
                        </span>
                    </div>&nbsp;
                    <div class="col-md-12">
                        <div class="progress">
                            <div id="cpu-usage-bar"
                                 class="progress-bar progress-bar-striped bg-success" 
                                 role="progressbar" 
                                 style="width: {{ $sysinfo['cpu_usage'] }}%" 
                                 aria-valuenow="{{ $sysinfo['cpu_usage'] }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <!-- Memory Usage -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="badge bg-info">
                        Memory ({{ $sysinfo['memory_total'] }} GB)
                    </span>
                </h3>
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span id="memory-usage-value" class="badge bg-info">
                            Memory usage: {{ $sysinfo['memory_usage'] }}%
                        </span>
                    </div>&nbsp;
                    <div class="col-md-12">
                        <div class="progress">
                            <div id="memory-usage-bar"
                                 class="progress-bar progress-bar-striped bg-info" 
                                 role="progressbar" 
                                 style="width: {{ $sysinfo['memory_usage'] }}%" 
                                 aria-valuenow="{{ $sysinfo['memory_usage'] }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">         
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>   
    <!-- Disk Usage -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="badge bg-primary">
                        Disk space ({{ $sysinfo['hdd_total'] }} GB)
                    </span>
                </h3>
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span id="memory-usage-value" class="badge bg-primary">
                            HDD usage: {{ $sysinfo['hdd_usage'] }}%
                        </span>
                    </div>&nbsp;
                    <div class="col-md-12">
                        <div class="progress">
                            <div id="hdd-usage-bar"
                                 class="progress-bar bg-primary" 
                                 role="progressbar" 
                                 style="width: {{ $sysinfo['hdd_usage'] }}%" 
                                 aria-valuenow="{{ $sysinfo['hdd_usage'] }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">         
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>   
    <!-- Network Statistics -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="badge bg-purple">
                        Network statistics 
                    </span>
                </h3>
            </div>  
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span class="badge bg-blue">
                            Transmitting
                        </span> &#47;
                        <span class="badge bg-fuchsia">
                            Receiving
                        </span> &#58;
                        <span id="transmit-rate-value" 
                              class="badge bg-blue">
                            {{ $sysinfo['human_tx_rate'] }}
                        </span> &#47;
                        <span id="receive-rate-value" 
                              class="badge bg-fuchsia">
                            {{ $sysinfo['human_rx_rate'] }}
                        </span>
                    </div> &nbsp;
                    <div class="col-md-12">
                        <span class="badge bg-teal">
                            Total Sent
                        </span> &#47;
                        <span class="badge bg-maroon">
                            Total Received
                        </span> &#58; 
                        <span id="total-sent-value" 
                              class="badge bg-teal">
                            {{ $sysinfo['tx_total'] }} MB
                        </span> &#47;
                        <span id="total-received-value"
                              class="badge bg-maroon">
                            {{ $sysinfo['rx_total'] }} MB
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
@endsection

@push('scriptBottom')
<script>
    var DASHBOARD_REFRESH_INTERVAL = {!! json_encode(config('bkstar123_bkscms_dashboard.refresh_interval')) !!};
</script>
<script src="/js/vendor/bkstar123_bkscms_dashboard/dashboard.min.js"></script>
@endpush