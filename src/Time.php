<?php

/**
 * 返回当前时间 Date格式
 * @param $timestamp null|int 时间戳，默认null表示当前时间
 * @return string
 */
function time_date ($timestamp=null)
{
	return date('Y-m-d', $timestamp);
}


/**
 * 返回当前时间 Datetime格式
 * @param $timestamp null|int 时间戳，默认null表示当前时间
 * @return string
 */
function time_datetime ($timestamp=null)
{
	return date('Y-m-d H:i:s', $timestamp);
}


/**
 * 返回当前年月 Ym格式
 * @param $timestamp null|int 时间戳，默认null表示当前时间
 * @return int
 */
function time_Ym ($timestamp=null)
{
	return (int)date('Ym', $timestamp);
}


