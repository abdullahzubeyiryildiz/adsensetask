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

    public function index()
    {
        $this->adsenseService->saveAdUnitsToDatabase();

        $ads = \App\Models\Ad::all();
        return view('adsense.index', compact('ads'));
    }

    public function callback(Request $request)
    {
        $authCode = $request->get('code');
        $this->adsenseService->authenticate($authCode);

        return redirect()->route('adsense.index');
    }
}
