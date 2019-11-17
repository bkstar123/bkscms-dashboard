/**
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */
function DashboardGetSystemInfoSuccess(data, status) 
{
    if (status == 'success') {   
        let result = data;
        
        $('#human-display-time').text(result.sysinfo.human_display_time);

        $('#cpu-usage-value').text('CPU: '+ result.sysinfo.cpu_usage + '%');
        $('#cpu-usage-bar').attr('aria-valuenow',result.sysinfo.cpu_usage);
        $('#cpu-usage-bar').css('width',result.sysinfo.cpu_usage + '%');

        $('#memory-usage-value').text('Memory: '+ result.sysinfo.memory_usage + '%');
        $('#memory-usage-bar').attr('aria-valuenow',result.sysinfo.memory_usage);
        $('#memory-usage-bar').css('width',result.sysinfo.memory_usage + '%');

        $('#hdd-usage-value').text('HDD: '+ result.sysinfo.hdd_usage + '%');
        $('#hdd-usage-bar').attr('aria-valuenow',result.sysinfo.hdd_usage);
        $('#hdd-usage-bar').css('width',result.sysinfo.hdd_usage + '%');

        $('#memory-total-value').text(result.sysinfo.memory_total + ' GB');
        $('#hdd-total-value').text(result.sysinfo.hdd_total + ' GB');
        
        $('#transmit-rate-value').text(result.sysinfo.human_tx_rate);
        $('#receive-rate-value').text(result.sysinfo.human_rx_rate);
                
        $('#total-sent-value').text(result.sysinfo.tx_total + ' MB');
        $('#total-received-value').text(result.sysinfo.rx_total + ' MB');
    }
}
    
function DashboardFailure(xhr, status, errorMsg) 
{
    return;
}

function DashboardGetSystemInfo() 
{
    var xhrOptions = {
        url: '/cms/json/dashboard/sysinfo',    
        type: "GET",
    };
    $.ajax(xhrOptions).done(DashboardGetSystemInfoSuccess).fail(DashboardFailure);
    setTimeout(DashboardGetSystemInfo, DASHBOARD_REFRESH_INTERVAL);
}

$(document).ready(function() {
    setTimeout(DashboardGetSystemInfo, DASHBOARD_REFRESH_INTERVAL);
});
