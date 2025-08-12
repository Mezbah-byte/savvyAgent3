<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// SohojPay recharge API configuration
$config['sohojpay'] = [
    // Prefer env var, fallback to existing value for compatibility
    'api_key'    => getenv('SOHOJPAY_API_KEY') ?: 'sUGsmZ0Jjkk65oiHxhM69e9WK2pXNwmMtccH25xgmJ04JWde3r3ohCQG7VLg',
    'base_url'   => getenv('SOHOJPAY_BASE_URL') ?: 'https://secure.sohojpaybd.com',
    // If your server misses CA bundle during development, set env SOHOJPAY_VERIFY_SSL=false
    'verify_ssl' => strtolower((string) getenv('SOHOJPAY_VERIFY_SSL')) !== 'false',
    // Request timeouts (seconds)
    'timeout'    => (int) (getenv('SOHOJPAY_TIMEOUT') ?: 20),
    'connect_timeout' => (int) (getenv('SOHOJPAY_CONNECT_TIMEOUT') ?: 10),
];

