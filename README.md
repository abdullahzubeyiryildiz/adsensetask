# Laravel Google AdSense Entegrasyonu

Bu proje, bir Laravel uygulamasında Google AdSense ile nasıl entegre olunacağını, reklam birimlerini nasıl alınacağını ve bir tabloda nasıl görüntüleneceğini gösterir. Servis odaklı bir mimari kullanılmıştır.

---

## Özellikler
- OAuth 2.0 ile Google AdSense API üzerinden kimlik doğrulama.
- Bir Google AdSense hesabına ait reklam birimlerini getirme ve listeleme.
- AdSense API mantığını kapsayan bir servis katmanı.


Services\AdSenseService.php
---

## Kurulum Talimatları

### Gereksinimler
1. AdSense API etkinleştirilmiş bir Google Cloud projesi.
2. OAuth 2.0 istemci kimlik bilgilerinizi içeren bir `google_adsense_credentials.json` dosyası.
3. Yerel bir Laravel uygulaması ya da bir sunucuda dağıtılmış bir proje.

---

### Kurulum Adımları

#### 1. Depoyu Klonlayın
```bash
git clone <repository-url>
cd <repository-folder>
