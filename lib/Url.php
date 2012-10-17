<?php
/**
 *
 * Url Model used to insert
 * and retrieve data from database.
 */
include 'config.php';

class Url
{   
    /**
     * @var obj $_db
     */
    private $_db;
    
    /**
     *
     * Create Db connection
     *
     * @return null
     */
    public function __construct()
    {
        global $config;
        $this->_db($config['user'], $config['pass']);
    }
    
    /**
     *
     * Create Db connection
     *
     * @param string $user
     * @param string $pass
     *
     * @return null
     */
    private function _db($user, $pass)
    {
        $mysqli = new mysqli('localhost', $user, $pass, 'short');
        if (mysqli_connect_errno()) {
            throw new Exception('An error occurred. Please try again.');
        } else {
            $this->_db = $mysqli;
        }
    }
    
    /**
     *
     * Save the long url and unique id in database
     *
     * @param string $url
     * @param string $uniqueId
     *
     * @return null
     */
    public function saveUrl($url, $uniqueId)
    {
        $escUrl    = $this->_db->real_escape_string($url);
        $escUnique = $this->_db->real_escape_string($uniqueId);
        
        $query  = "INSERT INTO url (id, long_url, unique_id) "
                . "VALUES ('', '{$escUrl}', '{$escUnique}')";
        
        $this->_db->query($query);
    }
    
    /**
     *
     * Retrieve a long Url using the unique id
     *
     * @param string $uniqueId
     * @return string 
     */
    public function fetchLongUrl($uniqueId)
    {
        $escId = $this->_db->real_escape_string($uniqueId);
        
        $query  = "SELECT long_url "
                . "FROM url "
                . "WHERE unique_id = '{$escId}'";
        
        $result = $this->_db->query($query);
        if ($result) {
            return $result->fetch_object()->long_url;
        } 
    }
    
    /**
     *
     * Close Db connection
     *
     * @return null
     */
    public function __destruct()
    {
        $this->_db->close();
    }
}