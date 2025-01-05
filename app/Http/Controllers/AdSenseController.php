<?php
namespace App\Http\Controllers;

use App\Services\AdSenseService;
use Illuminate\Http\Request;

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
            return redirect($authUrl); // Kullanıcıyı Google'a yönlendir
        }

        // Kimlik doğrulaması başarılı olduktan sonra reklam birimlerini listele
        $adUnits = $this->adsenseService->getAdUnits();
        return view('adsense.index', ['adUnits' => $adUnits]);
    }

    public function callback(Request $request)
    {
        // Google'dan dönen authCode ile kimlik doğrulamasını tamamla
        $authCode = $request->get('code');
        $this->adsenseService->authenticate($authCode);

        return redirect()->route('adsense.index'); // Yeniden yönlendir
    }
}
