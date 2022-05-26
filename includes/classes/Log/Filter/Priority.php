<?php
class Log_Filter_Priority extends Log_Filter_Abstract
{
    /**
     * @var integer
     */
    protected $_priority;

    /**
     * @var string
     */
    protected $_operator;

    /**
     * Filter logging by $priority.  By default, it will accept any log
     * event whose priority value is less than or equal to $priority.
     *
     * @param  integer  $priority  Priority
     * @param  string   $operator  Comparison operator
     * @return void
     * @throws Exception
     */
    public function __construct($priority, $operator = null)
    {
        if (! is_int($priority)) {
            trigger_error('Priority must be an integer', E_USER_ERROR);
        }

        $this->_priority = $priority;
        $this->_operator = $operator === null ? '<=' : $operator;
    }

    /**
     * Create a new instance of Log_Filter_Priority
     *
     * @param  array $config
     * @return Log_Filter_Priority
     */
    static public function factory($config)
    {
        $config = self::_parseConfig($config);
        $config = array_merge(array(
            'priority' => null,
            'operator' => null,
        ), $config);

        // Add support for constants
        if (!is_numeric($config['priority']) && isset($config['priority']) && defined($config['priority'])) {
            $config['priority'] = constant($config['priority']);
        }

        return new self(
            (int) $config['priority'],
            $config['operator']
        );
    }

    /**
     * Returns TRUE to accept the message, FALSE to block it.
     *
     * @param  array    $event    event data
     * @return boolean            accepted?
     */
    public function accept($event)
    {
        return version_compare($event['priority'], $this->_priority, $this->_operator);
    }
}