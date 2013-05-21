<?php

namespace GTranslate\Service;

/**
 *  GTranslate\Service\Translate
 *
 * Zend Framework2 Google Translate Class
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 
 * This class enables the Google translate
 *
 * @package		Zend Framework 2
 * @author		Ramkumar 
 */
class Translate {

    ///language from what we translate
    var $translate_from;
    ////language in what we whant to translate
    var $translate_into;
    ///debug the code
    var $debug;

    public function __construct() {
        //set charset as utf8
        header('Content-Type: text/html; charset=utf-8');
        //default values
        $this->debug = 0;
        $this->translate_from = "en";
        $this->translate_into = "it";
    }

    public function __initialize($config = array()) {
        ini_set("display_errors", $this->debug);
        //from lang
        if (isset($config['from'])) {
            $this->translate_from = $config['from'];
        }
        //to language
        if (isset($config['to'])) {
            $this->translate_into = $config['to'];
        }
    }

    public function getTranslateUrl($word) {
        if (!$word) {
            die("you need to adda a translate word");
        }
        ///we need to encode the word that we want to translate
        $word = urlencode($word);
        $url = "http://translate.google.com/?sl=" . $this->translate_from . "&tl=" . $this->translate_into . "&js=n&prev=_t&hl=it&ie=UTF-8&eotf=1&text=" . $word . "";
        return $url;
    }

    public function translate($word) {
        $dom = new \DOMDocument();
        $html = $this->curl_download($this->getTranslateUrl($word));
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        $tags = $xpath->query('//*[@id="result_box"]');
        foreach ($tags as $tag) {
           $var = trim($tag->nodeValue);
            if (!$var) {
                $this->sendEmail();
            } else {
                return ($var);
            }
        }
    }

    /*
      function for downloading the gooogle page content for translating
     */
    public function curl_download($Url) {
        // is cURL installed yet?
        if (!function_exists('curl_init')) {
            if (function_exists('file_get_contents')) {
                return file_get_contents($Url);
            } else {
                die("Your server dosen't support curl or file get contents");
            }
        }
        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();
        // Now set some options (most are optional)
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);
        // Set a referer
        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
       // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // Download the given URL, and return output
        $output = curl_exec($ch);
        // Close the cURL resource, and free system resources
        curl_close($ch);
        return $output;
    }

}

//$var = new translate("en", "ta");
//
//echo $var->get("good");
