<?php

class Application_Profiler
{
    /**
     * Timers for code profiling
     *
     * @var array
     */
    static private $_timers = array();
    static private $_enabled = false;
    static private $_memory_get_usage = false;

    public static function enable()
    {
        self::$_enabled = true;
        self::$_memory_get_usage = function_exists('memory_get_usage');
    }

    public static function disable()
    {
        self::$_enabled = false;
    }

    public static function reset($timerName)
    {
        self::$_timers[$timerName] = array(
        	'start'=>false,
        	'count'=>0,
        	'sum'=>0,
        	'realmem'=>0,
        	'emalloc'=>0,
        );
    }

    public static function resume($timerName)
    {
        if (!self::$_enabled) {
            return;
        }

        if (empty(self::$_timers[$timerName])) {
            self::reset($timerName);
        }
        if (self::$_memory_get_usage) {
        	self::$_timers[$timerName]['realmem_start'] = memory_get_usage(true);
        	self::$_timers[$timerName]['emalloc_start'] = memory_get_usage();
        }
        self::$_timers[$timerName]['start'] = microtime(true);
        self::$_timers[$timerName]['count'] ++;
    }

    public static function start($timerName)
    {
        self::resume($timerName);
    }

    public static function pause($timerName)
    {
        if (!self::$_enabled) {
            return;
        }

        if (empty(self::$_timers[$timerName])) {
            self::reset($timerName);
        }
        if (false!==self::$_timers[$timerName]['start']) {
            self::$_timers[$timerName]['sum'] += microtime(true)-self::$_timers[$timerName]['start'];
            self::$_timers[$timerName]['start'] = false;
            if (self::$_memory_get_usage) {
	            self::$_timers[$timerName]['realmem'] += memory_get_usage(true)-self::$_timers[$timerName]['realmem_start'];
    	        self::$_timers[$timerName]['emalloc'] += memory_get_usage()-self::$_timers[$timerName]['emalloc_start'];
            }
        }
    }

    public static function stop($timerName)
    {
        self::pause($timerName);
    }

    public static function fetch($timerName, $key='sum')
    {
        if (empty(self::$_timers[$timerName])) {
            return false;
        } elseif (empty($key)) {
            return self::$_timers[$timerName];
        }
        switch ($key) {
            case 'sum':
                $sum = self::$_timers[$timerName]['sum'];
                if (self::$_timers[$timerName]['start']!==false) {
                    $sum += microtime(true)-self::$_timers[$timerName]['start'];
                }
                return $sum;

            case 'count':
                $count = self::$_timers[$timerName]['count'];
                return $count;

            case 'realmem':
            	if (!isset(self::$_timers[$timerName]['realmem'])) {
            		self::$_timers[$timerName]['realmem'] = -1;
            	}
            	return self::$_timers[$timerName]['realmem'];

            case 'emalloc':
            	if (!isset(self::$_timers[$timerName]['emalloc'])) {
            		self::$_timers[$timerName]['emalloc'] = -1;
            	}
            	return self::$_timers[$timerName]['emalloc'];

            default:
                if (!empty(self::$_timers[$timerName][$key])) {
                    return self::$_timers[$timerName][$key];
                }
        }
        return false;
    }

    public static function getTimers()
    {
        return self::$_timers;
    }

}