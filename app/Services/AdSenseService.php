<?php
namespace App\Services;

use Google\Client;
use Google\Service\AdSense;

class AdSenseService
{
    protected $client;
    protected $adsense;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(public_path('google_adsense_credentials.json'));
        $this->client->addScope(AdSense::ADSENSE_READONLY);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->adsense = new AdSense($this->client);
    }

    public function authenticate($authCode = null)
    {
        if ($authCode) {
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
            $this->client->setAccessToken($accessToken);
            file_put_contents(public_path('google_adsense_credentials.json'), json_encode($accessToken));
        } elseif (file_exists(public_path('google_adsense_credentials.json'))) {
            $accessToken = json_decode(file_get_contents(public_path('google_adsense_credentials.json')), true);
            $this->client->setAccessToken($accessToken);

            if ($this->client->isAccessTokenExpired()) {
                $accessToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->client->setAccessToken($accessToken);
                file_put_contents(public_path('google_adsense_credentials.json'), json_encode($accessToken));
            }
        } else {

            return $this->client->createAuthUrl();
        }
    }


    public function getAdUnits()
    {
        $this->authenticate();
        $accounts = $this->adsense->accounts->listAccounts();
        $accountId = $accounts->getItems()[0]->getName();
        return $this->adsense->accounts_adunits->listAccountsAdunits($accountId);
    }

    public function saveAdUnitsToDatabase()
    {
        $adUnits = $this->getAdUnits();

        foreach ($adUnits as $adUnit) {
            Ad::updateOrCreate(
                ['ad_unit_id' => $adUnit->getName()],
                [
                    'name' => $adUnit->getDisplayName(),
                    'location' => 'header',
                    'content' => null,
                ]
            );
        }
    }
}
