<?php
/**
 * Object Encoder 对象属性编译器
` * FIELD_ENUM 常量以二维数组的形式配置对象的属性，一维key为属性名，二维数组的key为属性值，val为属性名称
 */
namespace Peak\Plugin\Eloquent\Model\FieldEnum;

trait Core
{


	/**
	 * 属性列表
	 * @param string $key 制定的属性列表，默认空字符表示获取所有属性
	 * @return array 如果未设置FIELD_ENUM常量则返回空数组。
	 */
	protected static function fieldEnum ($key=''):array
	{
		$enum = defined('static::FIELD_ENUM') ? static::FIELD_ENUM : [];
		return $key ? (array)@$enum[$key] : $enum;
	}



	/**
	 * 解析属性
	 * @param $key string 需要解析的参数名
	 * @return string|null
	 * */
	public function decodeField ($key)
	{
		$enum = self::fieldEnum($key);
		return @$enum[$this->$key];
	}



	/**
	 * 将指定的或所有的属性解析创建至新的对象属性
	 * @param $key mixed string|array|null 指定需要翻译的属性，string，多个属性用','分割；array，属性集合；如果为空，则翻译所有属性
	 * @param $pref string 新属性名的前缀
	 * @param $ext string 新属性名的后缀
	 * */
	public function decodeFieldToProperty ($key=null, $pref='_', $ext='')
	{

		if ( $key ) {
			$key = is_array($key) ? $key : explode(',', $key);
			$key = array_intersect_key(array_flip($key), self::fieldEnum());
		} else {
			$key = self::fieldEnum();
		}
		$key = array_keys($key);

		foreach ( $key as $k ) {
			isset($this->$k) && $this->{$pref.$k.$ext}=$this->decodeField($k);
		}
	}


}
