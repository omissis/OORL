<?php

namespace OORL\Parser;

use OORL\Parser\Database as DatabaseParser;

/**
 * MongoDB adapter for OORL Parser
 */
class MongoDB extends DatabaseParser
{
    /**
     * @{inheritDoc}
     */
    public function getProtocol() {
        return 'mongodb';
    }
}
