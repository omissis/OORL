<?php

namespace OORL;

/**
 * This class is a wrapper around php's native parse_url
 */
class Parser
{
    protected $pieces;

    protected $scheme;
    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    protected $path;
    protected $query;
    protected $fragment;

    public function __construct($str)
    {
        if (empty($str)) {
            throw new \InvalidArgumentException("Empty connection string");
        }

        $this->pieces = parse_url($str);

        if (empty($this->pieces)) {
            throw new \InvalidArgumentException("Wrong connection string");
        }

        $this->scheme   = $this->getPiece('scheme');
        $this->host     = $this->getPiece('host');
        $this->port     = $this->getPiece('port');
        $this->user     = $this->getPiece('user');
        $this->pass     = $this->getPiece('pass');
        $this->path     = $this->getPiece('path');
        $this->query    = $this->getPiece('query');
        $this->fragment = $this->getPiece('fragment');
    }

    /**
     * get a piece of the url
     *
     * @param string $name name of the piece
     * @param string|number|null $default default value of the required piece
     * @param boolean $required flag to set if the wanted piece is required or not
     *
     * @return string|number|null
     */
    public function getPiece($name, $default = null, $required = false)
    {
        if (isset($this->pieces[$name]) && !empty($this->pieces[$name])) {
            return $this->pieces[$name];
        }

        if (true === $required) {
            throw new \RuntimeException("'$name' url piece is required");
        }

        return $default;
    }

    /**
     * get scheme
     *
     * @return string|null
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * get host
     *
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * get port
     *
     * @return number|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * get user
     *
     * @return string|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * get pass
     *
     * @return string|null
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * get path
     *
     * @return string|null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * get query
     *
     * @return string|null
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * get fragment
     *
     * @return string|null
     */
    public function getFragment()
    {
        return $this->fragment;
    }
}
