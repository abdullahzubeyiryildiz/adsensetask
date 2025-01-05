<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdSenseService;

class AdSenseController extends Controller
{
    protected $adsenseService;

    public function __construct(AdSenseService $adsenseService)
    {
        $this->adsenseService = $adsenseService;
    }

    public function index(Request $request)
    {
        $authUrl = $this->adsenseService->authenticate();

        if ($authUrl) {
            return redirect($authUrl);
        }

        $adUnits = $this->adsenseService->getAdUnits();
        return view('adsense.index', ['adUnits' => $adUnits]);
    }

    public function callback(Request $request)
    {

        $authCode = $request->get('code');
        $this->adsenseService->authenticate($authCode);

        return redirect()->route('adsense.index');
    }
}
