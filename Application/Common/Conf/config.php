<?php


return array(
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 数据库连接地址
	'DB_NAME'   => 'qiye', // 数据库名
	'DB_USER'   => 'root', // 数据库用户名
	'DB_PWD'    => '', // 数据库密码
	'DB_PORT'   => 3306, // 数据库端口
	'DB_PREFIX' => 'otcms_', // 数据库前缀
	'DB_CHARSET'=> 'utf8', // 数据库编码	    
	'MODULE_ALLOW_LIST'    =>    array('Home','Otcms'),
	'DB_DEBUG'  =>  TRUE, // 是否开启调试模式
	'DEFAULT_MODULE'     =>  'Home',
	'DEFAULT_Controller' =>  'index',
	'TAGLIB_PRE_LOAD' => 'Article',
	'DEFAULT_Action'     =>  'index', 
	'URL_MODEL' => 3, //URL模式
	'URL_CASE_INSENSITIVE'  =>  true,
	'DB_LIKE_FIELDS'=>'admin_name|user_name',//自动模糊查询字段
	'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',//error错误提示页面

	'URL_ROUTER_ON'  	=> true,
	'URL_ROUTE_RULES'	=>array(
	    'con/:n_id'		=> 'Home/Index/news_content',//路由文章页
	    'list/:c_id'	=> 'Home/Index/news_list',//路由列表页
	),

	// 极验验证,请到官网申请ID和KEY，http://www.geetest.com/
	'GEE_ID'  => 'ca1219b1ba907a733eaadfc3f6595fad',
    'GEE_KEY' => '9977de876b194d227b2209df142c92a0',

);
