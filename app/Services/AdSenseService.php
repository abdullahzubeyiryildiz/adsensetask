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
        // Kimlik doğrulama dosyanızı doğru konuma yerleştirin
        $this->client->setAuthConfig(public_path('google_adsense_credentials.json'));
        $this->client->addScope(AdSense::ADSENSE_READONLY);
        $this->client->setAccessType('offline');  // Yenileme jetonu almak için
        $this->client->setPrompt('consent');
        $this->adsense = new AdSense($this->client);
    }

    // Kimlik doğrulama için gerekli işlem
    public function authenticate($authCode = null)
    {
        // Kullanıcı giriş yaptıysa, authCode ile erişim jetonu al
        if ($authCode) {
            $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
            $this->client->setAccessToken($accessToken);
            file_put_contents(storage_path('app/google_adsense_token.json'), json_encode($accessToken));
        } elseif (file_exists(storage_path('app/google_adsense_token.json'))) {
            // Erişim jetonunu dosyadan al ve geçerliliğini kontrol et
            $accessToken = json_decode(file_get_contents(storage_path('app/google_adsense_token.json')), true);
            $this->client->setAccessToken($accessToken);

            if ($this->client->isAccessTokenExpired()) {
                // Jeton süresi dolmuşsa, yenileme işlemi yap
                $accessToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                $this->client->setAccessToken($accessToken);
                file_put_contents(storage_path('app/google_adsense_token.json'), json_encode($accessToken));
            }
        } else {
            // Kimlik doğrulaması için URL'yi döndür
            return $this->client->createAuthUrl();
        }
    }

    // AdSense reklam birimlerini al
    public function getAdUnits()
    {
        $this->authenticate(); // Kimlik doğrulaması yap
        $accounts = $this->adsense->accounts->listAccounts();
        $accountId = $accounts->getItems()[0]->getName(); // İlk hesabı al
        return $this->adsense->accounts_adunits->listAccountsAdunits($accountId);
    }
}
