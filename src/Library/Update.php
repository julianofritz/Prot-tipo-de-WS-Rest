<?php

namespace Library;

use Zend\Db\Sql\Update as ZendUpdate;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\Sql\Exception;
use Zend\Db\Adapter\Platform\PlatformInterface;
use Zend\Db\Adapter\Driver\DriverInterface;

class Update extends ZendUpdate{

    /**
     * @var string|Expression
     */
    protected $quantifier;
    
    /**
     * @var array
     */
    protected $specifications = [
        self::SPECIFICATION_UPDATE => 'UPDATE %2$s%1$s',
        self::SPECIFICATION_JOIN => [
            '%1$s' => [
                [3 => '%1$s JOIN %2$s ON %3$s', 'combinedby' => ' ']
            ]
        ],
        self::SPECIFICATION_SET => 'SET %1$s',
        self::SPECIFICATION_WHERE => 'WHERE %1$s',
    ];
    
    /**
     * {@inheritDoc}
     * @see \Zend\Db\Sql\Update::processUpdate()
     */
    protected function processUpdate(PlatformInterface $platform, DriverInterface $driver = null, ParameterContainer $parameterContainer = null){
        if ($this->quantifier) {
            $quantifier = ($this->quantifier instanceof ExpressionInterface) 
            ? $this->processExpression($this->quantifier, $platform, $driver, $parameterContainer, 'quantifier')
            : $this->quantifier;
        }
        
        return sprintf(
                $this->specifications[static::SPECIFICATION_UPDATE],
                $this->resolveTable($this->table, $platform, $driver, $parameterContainer),
                isset($quantifier) ? "$quantifier " : ''
            );
    }
    
    /**
     * @param string|Expression $quantifier DISTINCT|ALL
     * @return Select
     */
    public function quantifier($quantifier)
    {
        if (!is_string($quantifier) && !$quantifier instanceof ExpressionInterface) {
            throw new Exception\InvalidArgumentException(
                'Quantifier must be one of DISTINCT, ALL, or some platform specific object implementing ExpressionInterface'
            );
        }
        $this->quantifier = $quantifier;
        return $this;
    }
}