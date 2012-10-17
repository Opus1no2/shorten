<?php
/** 
 *
 * Custom class containing methods for shortening a url
 */
include_once 'lib/Url.php';

class Shorten
{   
    /** 
     * @var string $_url
     */
    protected $_url;
    /**
     * @var string $_uniqueId;
     */
    protected $_uniqueId;
    
    const BASE = 'http://0p11.com/';
    
    /**
     *
     * Set long url and process logic
     *
     * @param array $url
     * @return string
     */
    public function __construct(array $url)
    {
        if (isset($url['url'])) {
            $this->setLongUrl($url['url']);
        } else {
            throw new Exception('You must provide a Url to shorten!');
        }
        $this->_process();
    }
    
    /**
     *
     * Remove scheme and set Url
     *
     * @param string $url
     * @return null
     */
    public function setLongUrl($url)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (preg_match('/^https?/', $scheme)) {
            if(!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new Exception('The Url you have entered is not valid.');
            } else {
                $this->_url = $finalUrl = preg_replace('/^https?:\/\//', '', $url);
            }
        } else {
            if (!filter_var('http://' . $url, FILTER_VALIDATE_URL)) {
                throw new Exception('The Url you have entered is not valid.');
            } else {
                $this->_url = $url;
            }
        }
    }
    
    /**
     *
     * Get long url
     *
     * @return string $this->_url
     */
    public function getLongUrl()
    {
        return $this->_url;
    }
    
    /**
     *
     * Create a unique Id for long url
     *
     * @return null
     */
    protected function _creatUniqueId()
    {
        $num      = range(0, 9);
        $alpha    = range('a', 'z');
        $alphaCap = range('A', 'Z');
        $alphaNum = array_merge($num, $alpha, $alphaCap);
        $string = '';
        
        for ($i = 0; $i < 6; $i++) {
            shuffle($alphaNum);
            $string .= $alphaNum[array_rand($alphaNum)];
        }
        $this->_uniqueId = $string;
    }
    
    /**
     *
     * Return unique Id
     *
     * @return string $this->_uniqueId
     */
    public function getUniqueId()
    {
        return (string)$this->_uniqueId;
    }
    
    /**
     *
     * Save the new unique Id and map it to the long url
     *
     * @return null
     */
    protected function _saveUniqueId()
    {
        if ($this->getUniqueId() && $this->getLongUrl()) {
            $url = new Url();
            $url->saveUrl($this->getLongUrl(), $this->getUniqueId());
        }   
    }
    
    /**
     *
     * Return the shortened url
     *
     * @return string
     */
    public function returnShortUrl()
    {
        $url = self::BASE . $this->getUniqueId();
        return htmlentities($url, ENT_QUOTES, "UTF-8");
    }
    
    /**
     *
     * Process logic
     *
     * @return null
     */
    private function _process()
    {
        if ($this->getLongUrl()) {
            $this->_creatUniqueId();
            $this->_saveUniqueId();
            echo $this->returnShortUrl();
        } else {
            throw new Exception('An error has occurred. Please try again.');
        }
    }
}