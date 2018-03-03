<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;
class Article extends TagLib {
    protected $tags = array(
        'list' => array('attr' => 'type,order,limit,where','close' => 1),
    );
    public function _list($attr,$content) {
        $type = $attr['type']; //要查询的数据表
        $order = $attr['order'];    //排序
        $limit = $attr['limit']; //多少条数据
        $where = $attr['where']; //查询条件
        $str = '<?php ';
        $str .= '$result = M("' . $type . '")->where("' . $where . '")->order("' . $order . '")->limit(' . $limit . ')->select();';
        $str .= 'foreach ($result as $v):';
        $str .= '?>';
        $str .= $content;
        $str .= '<?php endforeach ?>';
        return $str;
    }
}