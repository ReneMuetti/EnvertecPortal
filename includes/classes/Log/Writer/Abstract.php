<?php
abstract class Log_Writer_Abstract
{
    /**
     * @var array of Log_Filter_Interface
     */
    protected $_filters = array();

    /**
     * Formats the log message before writing.
     *
     * @var Log_Formatter_Interface
     */
    protected $_formatter;

    /**
     * Add a filter specific to this writer.
     *
     * @param  Log_Filter_Interface|int $filter Filter class or filter priority
     * @return Log_Writer_Abstract
     * @throws Exception
     */
    public function addFilter($filter)
    {
        if (is_int($filter)) {
            $filter = new Log_Filter_Priority($filter);
        }

        if (!$filter instanceof Log_Filter_Interface) {
             trigger_error('Invalid filter provided', E_USER_ERROR);
        }

        $this->_filters[] = $filter;
        return $this;
    }

    /**
     * Log a message to this writer.
     *
     * @param  array $event log data event
     * @return void
     */
    public function write($event)
    {
        /** @var Log_Filter_Interface $filter */
        foreach ($this->_filters as $filter) {
            if (!$filter->accept($event)) {
                return;
            }
        }

        // exception occurs on error
        $this->_write($event);
    }

    /**
     * Set a new formatter for this writer
     *
     * @param  Log_Formatter $formatter
     * @return Log_Writer_Abstract
     */
    public function setFormatter(Log_Formatter $formatter)
    {
        $this->_formatter = $formatter;
        return $this;
    }

    /**
     * Perform shutdown activites such as closing open resources
     *
     * @return void
     */
    public function shutdown()
    {}

    /**
     * Write a message to the log.
     *
     * @param  array $event log data event
     * @return void
     */
    abstract protected function _write($event);

    /**
     * Validate and optionally convert the config to array
     *
     * @param  array $config
     * @return array
     * @throws Exception
     */
    static protected function _parseConfig($config)
    {
        if (!is_array($config)) {
            trigger_error('Configuration must be an array', E_USER_ERROR);
        }

        return $config;
    }
}