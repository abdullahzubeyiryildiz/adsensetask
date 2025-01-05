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
            file_put_contents(storage_path('app/google_adsense_token.json'), json_encode($accessToken));
        } elseif (file_exists(storage_path('app/google_adsense_token.json'))) {
            $accessToken = json_decode(file_get_contents(storage_path('app/google_adsense_token.json')), true);
            $this->client->setAccessToken($accessToken);

            if ($this->client->isAccessTokenExpired()) {
                $accessToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->client->setAccessToken($accessToken);
                file_put_contents(storage_path('app/google_adsense_token.json'), json_encode($accessToken));
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
}
