<?php

namespace App\Services;

use GuzzleHttp\Client;

class Captcha
{
    protected string $secret;
    protected string $sitekey;
    protected array $options;

    public function __construct(?string $secret = null, ?string $sitekey = null, array $options = [])
    {
        $this->secret = $secret ?? (string) config('captcha.secret', '');
        $this->sitekey = $sitekey ?? (string) config('captcha.sitekey', '');
        $this->options = $options ?: (array) config('captcha.options', []);
    }

    /**
     * Render the reCAPTCHA HTML widget and script.
     */
    public function display(array $attributes = [], ?string $lang = null): string
    {
        $attributes['data-sitekey'] = $this->sitekey;

        if (isset($attributes['class'])) {
            $attributes['class'] = 'g-recaptcha ' . $attributes['class'];
        } else {
            $attributes['class'] = 'g-recaptcha';
        }

        $htmlAttributes = [];
        foreach ($attributes as $key => $value) {
            $htmlAttributes[] = htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') . '"';
        }

        $js = $this->displayJs($lang);

        return '<div ' . implode(' ', $htmlAttributes) . '></div>' . $js;
    }

    /**
     * Render the reCAPTCHA script tag.
     */
    public function displayJs(?string $lang = null): string
    {
        $url = 'https://www.google.com/recaptcha/api.js';
        if ($lang) {
            $url .= '?hl=' . urlencode($lang);
        }

        return '<script src="' . $url . '" async defer></script>';
    }

    /**
     * Verify the reCAPTCHA response token.
     */
    public function verify(?string $response, ?string $clientIp = null): bool
    {
        if (empty($response)) {
            return false;
        }

        $client = new Client($this->options);

        $formParams = [
            'secret' => $this->secret,
            'response' => $response,
        ];

        if ($clientIp) {
            $formParams['remoteip'] = $clientIp;
        }

        $verifyResponse = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => $formParams,
        ]);

        $body = json_decode((string) $verifyResponse->getBody(), true);

        return isset($body['success']) && $body['success'] === true;
    }
}

