<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload = FCPATH . 'vendor/autoload.php';
if (! file_exists($autoload)) {
    // maybe vendor sits one level up?
    $autoload = FCPATH . '../vendor/autoload.php';
}
if (! file_exists($autoload)) {
    die("ERROR: Cannot find autoload.php at $autoload");
}
require_once $autoload;

use BackblazeB2\Client;

class B2 {
    /** @var CI_Controller **/
    protected $CI;

    /** @var Client **/
    protected $client;

    /** @var string **/
    protected $bucketName;

    /** @var string **/
    protected $downloadDomain;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->config('b2');

        $this->bucketName     = $this->CI->config->item('b2_bucket_name');
        $this->downloadDomain = rtrim($this->CI->config->item('b2_download_domain'), '/');

        $this->client = new Client(
            $this->CI->config->item('b2_account_id'),
            $this->CI->config->item('b2_application_key')
        );
    }

    /**
     * Upload a file to B2.
     *
     * @param string $filePath   Local temp file path
     * @param string $remoteName Path/key in B2 (e.g. 'payments/xyz.jpg')
     * @param string $mimeType   e.g. 'image/jpeg'
     * @return object            BackblazeB2\Models\UploadFile
     * @throws RuntimeException  If the local file can’t be opened
     */
    public function uploadFile($filePath, $remoteName, $mimeType) {
        // Try to open the file
        $stream = @fopen($filePath, 'r');
        if ($stream === false) {
            throw new RuntimeException("B2 Upload Error: unable to open file at {$filePath}");
        }

        try {
            // Perform the upload
            $file = $this->client->upload([
                'BucketName' => $this->bucketName,
                'FileName'   => $remoteName,
                'Body'       => $stream,
            ]);
        } finally {
            // Only close if it’s a valid resource
            if (is_resource($stream)) {
                fclose($stream);
            }
        }

        return $file;
    }

    /**
     * Build the public URL for a file in a public bucket.
     *
     * @param string $remoteName
     * @return string
     */
    public function getFileUrl($remoteName) {
        return "{$this->downloadDomain}/file/{$this->bucketName}/{$remoteName}";
    }
}
