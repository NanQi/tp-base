<?php
/**
 * Created by PhpStorm.
 * User: NanQi
 * Date: 2019/4/4
 * Time: 16:22
 */
namespace app\framework;

use BadFunctionCallException;
use Redis;

class NRedis extends Redis {

    protected $options = [
        'host'       => '127.0.0.1',
        'port'       => 6379,
        'password'   => '',
        'select'     => 0,
        'timeout'    => 0,
        'expire'     => 0,
        'persistent' => false,
        'prefix'     => '',
        'serialize'  => true,
    ];

    protected $default_expire;

    /**
     * 架构函数
     * @access public
     * @param  array $options 缓存参数
     */
    public function __construct($options = [])
    {
        if (empty($options)) {
            $options = config('redis.');
        }

        parent::__construct();

        $this->options = array_merge($this->options, $options);

        if (!extension_loaded('redis')) {
            throw new BadFunctionCallException('not support: redis');
        }

        $this->handler = new Redis;

        if ($this->options['persistent']) {
            $this->pconnect($this->options['host'], $this->options['port'], $this->options['timeout']);
        } else {
            $this->connect($this->options['host'], $this->options['port'], $this->options['timeout']);
        }

        if ('' != $this->options['password']) {
            $this->auth($this->options['password']);
        }

        if (0 != $this->options['select']) {
            $this->select($this->options['select']);
        }

        $this->default_expire = 3600;
    }

    public function test()
    {
        return 'test';
    }
}