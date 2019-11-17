<?php
/**
 * DashboardController
 *
 * @author: tuanha
 * @last-mod: 17-Nov-2019
 */
namespace Bkstar123\BksCMS\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Bkstar123\BksCMS\Dashboard\Contracts\Dashboard;

class DashboardController extends Controller
{

    /**
     * @var \Bkstar123\BksCMS\Dashboard\Contracts\Dashboard
     */
    protected $dashboard;

    /**
     * Create instance
     *
     * @param \Bkstar123\BksCMS\Dashboard\Contracts\Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $sysinfo = $this->dashboard->getSysInfo();
        return view('bkstar123_bkscms_dashboard::dashboard.index', compact(['sysinfo']));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
    */
    public function sysinfo()
    {
        $sysinfo = $this->dashboard->getSysInfo();
        return response()->json(['sysinfo' => $sysinfo], 200);
    }
}
