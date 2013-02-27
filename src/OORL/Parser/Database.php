<?php

namespace OORL\Parser;

use OORL\Parser as BaseParser;

/**
 * Database adapter interface for OORL Parser
 */
abstract class Database extends BaseParser
{
    public function __construct($str)
    {
        if (strstr($str, $this->getProtocol() . '://') !== 0) {
            $str = $this->getProtocol() . '://' . $str;
        }

        parent::__construct($str);

        if (!isset($this->pieces["host"]) || empty($this->pieces['host'])) {
            throw new \InvalidArgumentException("Host can't be empty");
        }

        if (!isset($this->pieces["path"]) || empty($this->pieces['path'])) {
            throw new \InvalidArgumentException("Database can't be empty");
        }
    }

    /**
     * get database name
     *
     * @return string the database name
     */
    public function getDatabase()
    {
        return trim($this->path, '/');
    }

    /**
     * get protocol
     *
     * @return string the database protocol name
     */
    abstract public function getProtocol();
}
