<?php
/**
 * author: NanQi
 * datetime: 2019/4/23 17:00
 */
namespace app\api\middleware;

use app\framework\ApiHelper;
use app\framework\NRedis;
use Closure;
use RuntimeException;
use think\facade\Cache;
use think\Request;
use think\Response;

class ThrottleMiddleware
{
    use ApiHelper;

    /**
     * 签名
     * @var string
     */
    protected $key;

    /**
     * 限制次数
     * @var int
     */
    protected $limit = 60;

    /**
     * 多长时间内
     * @var int
     */
    protected $time = 60;

    /**
     * 当前请求多少次
     * @var int
     */
    protected $number;

    protected $redis;

    public function __construct()
    {
        $this->redis = new NRedis();
    }

    /**
     * 生成签名
     * @param Request $request
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        if ($route = $request->routeInfo()) {
            $token = $request->header(config('setting.token_header_name'));
            return sha1($token . '|' . $route['rule'] . '|' . $request->ip());
        }

        throw new RuntimeException("无法生成限流签名");
    }

    /**
     * 调用限制次数
     * @return bool
     */
    public function attempt()
    {
        $flg = $this->check();

        $this->hit();

        return $flg;
    }

    /**
     * 触发限制次数
     * @return $this
     */
    public function hit()
    {
        $lua = 'local v = redis.call(\'incr\', KEYS[1]) '.
            'if v>1 then return v '.
            'else redis.call(\'setex\', KEYS[1], ARGV[1], 1) return 1 end';


        $this->number = $this->redis->eval($lua, [$this->computeRedisKey(), $this->time], 1);

        return $this;
    }

    /**
     * 清除当前次数
     * @return $this
     */
    public function clear()
    {
        $this->number = 0;

        $this->redis->setex($this->computeRedisKey(), $this->number, $this->time);

        return $this;
    }

    /**
     * 获取当前次数
     * @return int
     */
    public function count()
    {
        if ($this->number !== null) {
            return $this->number;
        }

        $this->number = (int)$this->redis->get($this->computeRedisKey());

        if (!$this->number) {
            $this->number = 0;
        }

        return $this->number;
    }

    /**
     * 检查限流
     * @return bool
     */
    public function check()
    {
        return $this->count() < $this->limit;
    }

    /**
     * 计算Redis新的key值
     * @return string
     */
    protected function computeRedisKey()
    {
        return "throttle:".$this->key;
    }

    public function handle(Request $request, Closure $next)
    {
        $this->key = $this->resolveRequestSignature($request);

        $flg = $this->attempt();
        if (!$flg) {
            $ttl = $this->redis->ttl($this->computeRedisKey());
            $response = $this->getResponse(1004, false, [$ttl]);
            $response->header('Retry-After: ' . $ttl);
        } else {
            $response = $next($request);
        }

        if ($response instanceof Response) {
            $response->header('X-RateLimit-Limit: ' . $this->limit);
            $response->header('X-RateLimit-Remaining: ' . $this->number);
        }

        return $response;


    }
}
