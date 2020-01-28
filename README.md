# Plugin


### Object Encoder 对象属性编译器
```php
class Model
{
    use \Peak\Plugin\Eloquent\Model\Config\Core;

    const CONFIG = [
		'status' => [
			0 => '未完成',
			1 => '已完成',
		],

		'error' => [
			'1.1' => '账号密码错误',
			'1.2' => '登录未授权',
			'1.3' => '账号权限不足',
		],
	];

}

$obj = new Model();
$obj->status = 1;

// 解析对象属性
$obj->configEncode ('status'); // 返回'已完成'
// 解析对象属性并存储于新属性，例如 $obj->status属性将被解析至$obj->_status
$obj->configToProperty (null, '_', '');
```

<b><2.0 继承声明Config</b>
<li>好处： 代码简洁且几乎所有参数仅需要设置一次，更改一次全局更改。
<li>坏处： 维护较为麻烦，查找更变参数涉及多级继承。</li>
<b> >=2.0 独立声明Config：</b>
<li>好处： 内在分装逻辑简单（无继承逻辑），配置一目了然、维护便捷。
<li>坏处： 存在代码冗余。


### Debug 组件
可独立使用也可置于其他类中使用，如控制器、中间件等。
```php
class Controller
{
    use \Peak\Plugin\Debuger;

    public function login ($usr, $pwd)
    {
        // to do with $usr and $pwd,
        return self::debug('账号密码不正确。'); // 设置Debug
    }


    public function loginError ()
    {
        return self::debug() ?: null; // 获取Debug
    }

}
```


### Cache 缓存组件
该组件的核心特征在于，由Class的名称（包含Namespace）和自定义主键组合成缓存key，全局化地解决了缓存命名难的痛点，甚至在多数情况下不必考虑缓存命名。
```php
namespace Peak\Plugin\Cache;

trait Common
{

	protected static function cacheKey ($id)
	{
		return static::class.':'.(string)$id;
	}

}
```


