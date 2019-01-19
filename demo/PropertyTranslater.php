<?php

class A
{

	use \Peak\Plugin\Translater;

	protected static $translation = [
		'style' => [
			0 => '普通',
			1 => '中型',
			2 => '大型',
		],

		'status' => [
			0 => '停用',
			1 => '启用'
		],
	];

}

class B extends A
{
	protected static $translation = [
		'status' => [
			0 => '待审核',
			1 => '已审核'
		],
	];

}

$obj = new B;
$obj->status = 1;
$obj->style = 1;
$obj->translateProperties();

return [
	'all-origin' => $obj->translation(),
	'all-format' => $obj->translation(null, \Peak\Plugin\Translater::class.'::format'),
	'b-style-origin' => $obj->translation('style'),
	'b-status-format' => $obj->translation('status', \Peak\Plugin\Translater::class.'::format'),
	'b-status' => $obj->translateProperty('status'),
	'b-style' => $obj->translateProperty('style'),
	'b-style_' => $obj->_style,
	'b-style:大型' => $obj->translateProperty('style'),
	'class-a-status:停用' => A::translationBack('status', '启用'),
];
