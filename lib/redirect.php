<?php
/**
 *
 * Class containing methods for redirecting
 */
include_once 'Url.php';

class Redirect
{
    /**
     * @var string $_id
     */
    private $_id;
    
    /**
     *
     * Set the unique Id and perform query
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->setUniqueId($id);
        $this->queryUniqueId();
    }
    
    /**
     *
     * Set unique Id
     *
     * @param string $id
     * @return null
     */
    public function setUniqueId($id)
    {
        if (ctype_alnum($id) && strlen($id) == 6) {
            $this->_id = $id;
        } else {
            throw new Exception('Invalid short Id.');
        }
    }
    
    /**
     *
     * Get unique Id
     *
     * @return string $this->_id
     */
    public function getUniqueId()
    {
        return $this->_id;
    }
    
    /**
     *
     * Redirect user using long url
     *
     * @return string
     */
    public function redirect()
    {
        if ($this->getRedirect()) {
            header("Location: http://{$this->getRedirect()}");
        }
    }
    
    /**
     *
     * Query for the unique Id 
     *
     * @return null
     */
    public function queryUniqueId()
    {
        $url = new Url();
        $this->_redirect = $url->fetchLongUrl($this->getUniqueId());
    }
    
    /**
     *
     * Get the long Url used to redirect
     *
     * @return string $this->_redirect
     */
    public function getRedirect()
    {
        return $this->_redirect;
    }
} 
 