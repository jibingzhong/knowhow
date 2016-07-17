<?php
namespace Home\Service;
use Think\Model\RelationModel;

class UserService extends RelationModel {


	/**
	 * 作者 dyc
	 * 函数的描述： 用户登录
	 * 参数列表$arr=>array(
	 *			username=>用户名
	 *			password=>密码
	 * )
	 * 返回值      
	 * 函数被访问的接口列表
	 *
	 * */
	function login($arr){
		
	}

	/**
	 * 作者 dyc
	 * 函数的描述： 用户注册
	 * 参数列表$arr=>array(
	 *			username=>用户名
	 *			password=>密码
	 * )
	 * 返回值      使用ADD方法,返回新创建用户ID
	 * 函数被访问的接口列表
	 *
	 * */
	function reg($arr){
		
	}
	
	/**
	 * 作者 dyc
	 * 函数的描述： 编辑用户信息
	 * 参数列表$arr=>array
	 *			name		=>'姓名',
	 *			website		=>'主页'(可为空)
	 *			location	=>'地区',
	 *			age			=>'年龄'
	 *			url			=>'头像地址'
	 *			des			=>'个人简介'
	 * 	 )
	 * 返回值      Boolean
	 * 函数被访问的接口列表
	 *
	 * */
	function createUserInfo($arr){
		
	}
	
	/**
	 * 作者 dyc
	 * 函数的描述：  查询所有用户
	 * 参数列表		null
	 * 返回值          Array
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	function showAllUser(){
	
	}

	/**
	 * 作者 dyc
	 * 函数的描述：  查询单个用户的信息(包括:包括勋章，个人信息，)
	 * 参数列表		$id=>用户ID
	 * 返回值          Array
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	function showOneUser($id){
	
	}
	
	/**
	 * 作者		dyc
	 * 函数的描述：  注销登录
	 * 参数列表		$id=>用户ID
	 * 返回值          Array
	 * 函数被访问的接口列表
	 *		UserController
	 * */
	function layout(){
		
	}
	
}

?>