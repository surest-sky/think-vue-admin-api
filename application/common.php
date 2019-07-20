<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Config;

use think\Cache;
//导入Excel文件
function uploadFile($file, $filetempname)
{
    //自己设置的上传文件存放路径
    $filePath = 'Uploads/';
    //注意设置时区
    $time = date("Y-m-d-H-i-s");//去当前上传的时间
    //获取上传文件的扩展名
    $extend = strrchr($file, '.');
    //上传后的文件名
    $name = $time . $extend;
    $uploadfile = $filePath . $name;//上传后的文件名地址
    //move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
    $result = move_uploaded_file($filetempname, $uploadfile);//假如上传到当前目录下
//     echo $result;
    return $result;
    if ($result) //如果上传文件成功，就执行导入excel操作
    {
        if ($extend == '.xls') {
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        } elseif ($extend == '.xlsx') {
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format
        }
        $objReader->setReadDataOnly(true);//只读取数据，忽略里面各种格式,速度快
        $objPHPExcel = $objReader->load($uploadfile);

        //格式化导入数据
        $loadedSheetNames = $objPHPExcel->getSheetNames();
//        var_dump($loadedSheetNames);die;
//        $objWorksheet = $objPHPExcel->getActiveSheet();
        $objWorksheet = $objPHPExcel->setActiveSheetIndexByName($loadedSheetNames[1]);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        $i = 0;
        for ($row = 2; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$i][] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            $i++;
        }
        return $excelData;
        if ($excelData) {
//          效果：array(1) { [0] => string(18029183333) }
            return $excelData;
        } else {
            $msg = "导入失败";
        }

//        $excelArray = $objPHPExcel->getSheet(0)->toArray();
//        if ($excelArray) {
////          效果：array(1) {[0] => array(1) {[0] => float(13802370032) }
////         array_shift($excelArray);//去除第一行
//            return $excelArray;
//        } else {
//            $msg = "导入失败";
//        }
        return $msg;
    }
}

/**
 * 解析Excel表格数据
 * @param $file   文件绝对地址
 * @return array|bool|string
 */
function parseExcel($file)
{
    if (is_file($file)) {
        //获取上传文件的扩展名
        $extend = strrchr($file, '.');
        if ($extend == '.xls') {
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        } elseif ($extend == '.xlsx') {
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format
        }
//        var_dump($objReader);die;
        //只读取数据，忽略里面各种格式,速度快
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        //获取所有工作表,返回格式['AD','ASH','CV']
        $loadedSheetNames = $objPHPExcel->getSheetNames();
        //var_dump($loadedSheetNames);die;
//        $objWorksheet = $objPHPExcel->getActiveSheet();
        //激活工作表
        $objWorksheet = $objPHPExcel->setActiveSheetIndexByName($loadedSheetNames[0]);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        $i = 0;
        //按照每一行读取数据
//        for ($row = 2; $row <= $highestRow; $row++) {
//            for ($col = 0; $col < $highestColumnIndex; $col++) {
//                $excelData[$i][] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
//            }
//            $i++;
//        }
        for ($row = 2; $row <= $highestRow; $row++) {
            $excelData[$i]['brand'] = trim($objWorksheet->getCellByColumnAndRow(0, $row)->getValue());
            $excelData[$i]['goodsno'] = trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
            $excelData[$i]['spec'] = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
            $excelData[$i]['price'] = trim($objWorksheet->getCellByColumnAndRow(3, $row)->getValue());
            $excelData[$i]['sex'] = trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue());
            $excelData[$i]['class'] = trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
            $excelData[$i]['year'] = trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue());
            $excelData[$i]['season'] = trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue());
            $excelData[$i]['markettime'] = strtotime(trim($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()));
            $excelData[$i]['series'] = trim($objWorksheet->getCellByColumnAndRow(9, $row)->getValue());
            $excelData[$i]['barcode'] = trim($objWorksheet->getCellByColumnAndRow(10, $row)->getValue());
            $i++;
        }
        return $excelData;
        //dump($excelData);
    }
}


/**
 * 解析Excel表格数据
 * @param $file   文件绝对地址
 * @return array|bool|string
 */
function parseExcel1($file)
{
    if (is_file($file)) {
        //获取上传文件的扩展名
        $extend = strrchr($file, '.');
        if ($extend == '.xls') {
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        } elseif ($extend == '.xlsx') {
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format
        }
//        var_dump($objReader);die;
        //只读取数据，忽略里面各种格式,速度快
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        //获取所有工作表,返回格式['AD','ASH','CV']
        $loadedSheetNames = $objPHPExcel->getSheetNames();
        //var_dump($loadedSheetNames);die;
//        $objWorksheet = $objPHPExcel->getActiveSheet();
        //激活工作表
        $objWorksheet = $objPHPExcel->setActiveSheetIndexByName($loadedSheetNames[0]);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        $i = 0;
        //按照每一行读取数据
        for ($row = 2; $row <= $highestRow; $row++) {
            $excelData[] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            $i++;
        }
        return $excelData;
        //dump($excelData);
    }
}



/**
 * 解析Excel表格数据
 * @param $file   文件绝对地址
 * @return array|bool|string
 */
use tools\Random;
function parseExcel2($file)
{
    if (is_file($file)) {
        //获取上传文件的扩展名
        $extend = strrchr($file, '.');
        if ($extend == '.xls') {
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        } elseif ($extend == '.xlsx') {
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format
        }
//        var_dump($objReader);die;
        //只读取数据，忽略里面各种格式,速度快
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        //获取所有工作表,返回格式['AD','ASH','CV']
//        $loadedSheetNames = $objPHPExcel->getSheetNames();
        //var_dump($loadedSheetNames);die;
        $objWorksheet = $objPHPExcel->getActiveSheet();
        //激活工作表
        //$objWorksheet = $objPHPExcel->setActiveSheetIndexByName($loadedSheetNames[0]);
        $highestRow = $objWorksheet->getHighestRow();
        $excelData = array();
        $i = 0;
        //按照每一行读取数据
        $time=time();
        for ($row = 2; $row <= $highestRow; $row++) {
            $excelData[$i]['realname'] = trim($objWorksheet->getCellByColumnAndRow(0, $row)->getValue());
            $excelData[$i]['mobile'] = trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
            $excelData[$i]['wechat'] = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
            $excelData[$i]['amount'] = trim($objWorksheet->getCellByColumnAndRow(3, $row)->getValue());
            $excelData[$i]['amount1'] = trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue());
            $excelData[$i]['createtime'] = strtotime(trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue()));
            $excelData[$i]['username'] = date('Ymd', $excelData[$i]['createtime']) . Random::numeric(4).$i;
            $excelData[$i]['updatetime'] = $time;
            $i++;
        }
        return $excelData;
        //dump($excelData);
    }
}

/**
 * 两日期之间的所间隔天数
 * @param $time1   时间戳
 * @param $time2   时间戳
 * @return float
 */
function countDay($time1, $time2)
{
    $d1 = $time1;
    $d2 = $time2;
    $Days = ceil(($d2 - $d1) / 3600 / 24);
    return $Days;
}

/**
 * 根据日期，获取传入日期N天前的日期
 * @param $day 时间戳 1926-8-17 00:00:00的时间戳
 * @param $num 天数
 * @return 日期
 */
function getNDay($day, $num)
{
    $dt_start = $day;
    //$dt_end = strtotime(date('Y-m-d', ($dt_start - (86400 * $num))));
    $dt_end = $dt_start - (86400 * $num);
    return $dt_end;
}

/**
 * 求两个日期之间的开始与结束
 * @param $day1   时间戳
 * @param $day2   时间戳
 * @return array
 */
function diffDays($start, $end)
{
    $dt_start = strtotime(date("Y-m-d", $start));
    $dt_end = strtotime(date("Y-m-d", $end));
    $date = array();
    do {
//        $date[] = strtotime(date('Y-m-d', $dt_start));
        $date[] = $dt_start;
    } while (($dt_start += 86400) <= $dt_end);
    return $date;
}

/**
 * 获取两个日期之间的小时数
 * @param $time1 时间戳
 * @param $time2 时间戳
 * @return array
 */
function diffTime($time1, $time2)
{
//    $dt_start = strtotime($time1);
//    $dt_end = strtotime($time2);
    $dt_start = $time1;
    $dt_end = $time2;
    $date = array();
    do {
//        $date[] = date('Y-m-d H:i:s', $dt_start);
        $date[] = $dt_start;
    } while (($dt_start += 3600) <= $dt_end);
    return $date;
}

/**
 * 返回小时的开始与结束
 */
function getTimeSaE($time1)
{
    $start = $time1;
    $end = $time1 + 3599;
    return array($start, $end);
}

/**
 * 返回小时的开始与结束,精确到秒
 */
function getTimeSaE1($time1)
{
    $start = date('Y-m-d H:00:00', strtotime($time1));
    $end = $time1;
    return array($start, $end);
}

/**
 * 返回日期的开始与结束
 */
function getStartAend($day)
{
    $start = strtotime(date('Y-m-d 00:00:00', $day));
    $end = strtotime(date('Y-m-d 23:59:59', $day));
    return array($start, $end);
}


/**
 * 3  * 递归重组节点信息多维数组
 * 4  * @param  [array] $node [要处理的节点数组:二维数组]
 * 5  * @param  [int]   $pid  [父级ID]
 * 6  * @return [array]       [树状结构的节点体系:多维数组]
 * 7  */
function node_merge($node,$access=null,$pid=0){
    $arr=array();
    foreach($node as $v){
        if(is_array($access)){
            if($access[0]=='*'){
                $v['access']=1;
            }else{
                $v['access']=in_array($v['id'],$access)?1:0;
            }
        }
        if($v['pid']==$pid){
            $v['child']=node_merge($node,$access,$v['id']);
            $arr[]=$v;
        }
    }
    return $arr;
}

/**
 * Excel导出
 * @param $tableheader array 标头数组
 * @param $data array 二维数据集
 * @param string $filename 导出文件名
 */
function excelOutput($tableheader, $data, $filename = 'data')
{
    //创建对象
    $excel = new \PHPExcel();

    //Excel表格式,这里简略写了8列
    $letter = idxListA(); //可以写多列，但不能写少

    //填充表头信息
    for ($i = 0; $i < count($tableheader); $i++) {
        $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
    }

    //填充表格信息
    for ($i = 2; $i <= count($data) + 1; $i++) {
        $j = 0;
        foreach ($data[$i - 2] as $key => $value) {
            $excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
            $j++;
        }
    }
    $ua = $_SERVER["HTTP_USER_AGENT"];
    $encoded_filename = urlencode($filename);
    $encoded_filename = str_replace("+", "%20", $encoded_filename);
    //创建Excel输入对象
    $write = new \PHPExcel_Writer_Excel5($excel);
    ob_end_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");;
//    header('Content-Disposition:attachment;filename="' . $filename . '.xls"');   //默认文件名
    if (preg_match("/MSIE/", $ua)) {
        header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
    } else if (preg_match("/Firefox/", $ua)) {
        header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '.xls"');
    } else {
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
    }
    header("Content-Transfer-Encoding:binary");
    $write->save('php://output');
}

//endregion


//region Excel Related
/**
 * Generate alphabet index.
 * @return array
 */
function idxListA($doubleChar = true)
{
    $a4idx = range('A', 'Z');

    // 1-char
    $idxListA = $a4idx;

    // 2-char
    if ($doubleChar) {
        foreach ($a4idx as $v1) {
            foreach ($a4idx as $v2) {
                $idxListA[] = $v1 . $v2;
            }
        }
    }

    return $idxListA;
}

function getseting($name)
{
    return db('dict')->where('name',$name)->value('value');
}

/**
 * 取得执行结果
 * @return  array   $rs_row             是否成功
 */
function is_ok(&$rs_row = array())
{
    $rs = true;

    if (in_array('0', $rs_row) || in_array(false, $rs_row) || in_array('', $rs_row) || empty($rs_row))
    {
        $rs = false;
    }

    return $rs;
}

/**
 * 获取七牛云拼接图片
 * @param $key
 * @param string $bucket
 * @param bool $is_compress
 * @param int $width
 * @param int $height
 * @return string|array
 */
function getQiNiuImgUrl($key,$bucket='test',$is_compress=false,$width=400,$height=400)
{
    $qiniuInfo = \config('qiniu.');

    $domain = 'https://'.$qiniuInfo[$bucket]['domain'];

    if (empty($qiniuInfo[$bucket]))return '';

    if (is_array($key)){
        foreach ($key as &$value){

            if ($is_compress&&!strpos($value,'imageView2')){
                $value = $value."?imageView2/0/w/{$width}/h/{$height}";
            }

            if(!(strpos($value,"http")===0)){
                $value = $domain.'/'.$value;
            }
        }
    }else{

        if ($is_compress&&!strpos($key,'imageView2')){
            $key = $key."?imageView2/0/w/{$width}/h/{$height}";
        }

        if(!(strpos($key,"http")===0||empty($key))){
            $key = $domain.'/'.$key;
        }
    }

    return $key;

}

function make_password( $length = 8 )
{
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y','z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    // 在 $chars 中随机取 $length 个数组元素键名
    $keys = array_rand($chars, $length);
    $password = '';
    for($i = 0; $i < $length; $i++)
    {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }
    return $password;
}

function createUserToken()
{
    $token = make_password(16);

    $userModel = new \app\index\model\User();

    $is = $userModel->where(['token'=>$token])->value('id');

    if (!empty($is))
    {
        $token = createUserToken();
    }

    return $token;
}

/**
 * 发送短信
 */
function sendSms($mobile,$code,$type) {

//    if( \config('app.app_debug')){
//        return false;
//    }
    $params = array ();

    // *** 需用户填写部分 ***
    // fixme 必填：是否启用https
    $security = false;

    // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
    $accessKeyId = \config('sms.AK');
    $accessKeySecret = \config('sms.AKS');;

    // fixme 必填: 短信接收号码
    $params["PhoneNumbers"] = $mobile;

    if ($type==1)
    {
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "D88";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_159620275";

    }else if ($type==2 ){

        // fixme 必填: 短信签名，应严格按"签名名称"填写， 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "D88";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_159625277";

    }else if ($type==3)
    {
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "D88";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_159625279";

    }



    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
    $params['TemplateParam'] = Array (
        "code" => $code,
        "product" => "Dysmsapi"
    );

    // fixme 可选: 设置发送短信流水号
    $params['OutId'] = "12345";

    // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
    $params['SmsUpExtendCode'] = "1234567";


    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
    }

    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
    $helper = new \tools\SignatureHelper();

    // 此处可能会抛出异常，注意catch
    $content = $helper->request(
        $accessKeyId,
        $accessKeySecret,
        "dysmsapi.aliyuncs.com",
        array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        )),
        $security
    );


    return $content;
}

function hideStar($str) {
    if (strpos($str, '@')) {
        $email_array = explode("@", $str);
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀
        $count = 0;

        if ($email_array[0]<>""){
            $str_l="";
            if (strlen($email_array[0])>3){
                for ($x=1; $x<=strlen($email_array[0])-3; $x++) {
                    $str_l.='*';
                }
            }else{
                $str_l='***';
            }
        }




        $str = preg_replace('/([\d\w+_-]{0,100})@/', $str_l.'@', $str, -1, $count);
        $rs = $prevfix . $str;
    } else {
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i';
        if (preg_match($pattern, $str)) {
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4);
        } else {
            $rs = substr($str, 0, 3) . "***" . substr($str, -1);
        }
    }
    return $rs;
}

function getDateTime($time = null) {
    if(!$time) {
        return date('Y-m-d H:i:s', time());
    }else{
        return date('Y-m-d H:i:s',time());
    }
}


/**
 * php时间转换
 */
function tran24Time($time)
{
    date_default_timezone_set('Asia/Shanghai');
    $time=strtotime($time);
    $rtime = date("Y-m-d",$time);
    $htime = date("H:i",$time);
    $time = time() - $time;
    if ($time < 60)
    {
        $str = '刚刚';
    }
    elseif ($time < 60 * 60)
    {
        $min = floor($time/60);
        $str = $min.'分钟前';
    }
    elseif ($time < 60 * 60 * 24)
    {
        $h = floor($time/(60*60));
        $str = $h.'小时前 '; //$htime
    }
    else
    {
        $str = $rtime;
    }
    return $str;
}

if( !function_exists('array_pluck') ){
    /*
     * $data 数组
     * $key 要获取的值
     */
    function array_pluck($data, $key, $o = false) : array {
        if( !$data || empty($data) ) {
            return [];
        }
        $new_data = [];
        foreach ($data as $value) {
            if( isset($value[$key]) ) {

                if( $temp = $value[$key] ) {
                    $new_data[] = $temp;
                }
            }
        }
        return $new_data;
    }
}

function array_val_chunk($array){

    $result = array();

    foreach ($array as $key => $value) {

        $result[$value[1].$value[2]][] = $value;

    }

    $ret = array();

    //这里把简直转成了数字的，方便同意处理

    foreach ($result as $key => $value) {

        array_push($ret, $value);

    }

    return $ret;

}

function buildLimit($page,$pagesize)
{
    $limit = 'limit '.($page-1)*$pagesize.','.$pagesize;

    return $limit;
}

function utf_substr($str,$len){
    for($i=0;$i<$len;$i++){
        $temp_str=substr($str,0,1);
        if(ord($temp_str) > 127){
            if($i<$len){
                $new_str[]=substr($str,0,3);
                $str=substr($str,3);
            }
        }else{
            $new_str[]=substr($str,0,1);
            $str=substr($str,1);
        }
    }
    return join($new_str);
}

function checkIsExir($discounts)
{
    foreach ($discounts as &$discount){
        $discount['pastDue'] = strtotime($discount['expiration_time']) > time() ? 0 : 1;
    }
    return $discounts;
}

function getWriteCountTime()
{
    $request = \think\Request::instance();

    $timeType = $request->param('timeType','all');

    $start_time = $request->param('start_time');

    $end_time = $request->param('end_time');

    if ($start_time&&$end_time)
    {
        return $start_time.'至'.$end_time;
    }else{

        switch ($timeType){

            case 'all':return '全部';break;
            case 'today':return date('Y-m-d');break;
            case 'yesterday':return date('Y-m-d',strtotime("-1 day"));break;
            case 'week':return date('Y-m-d',(time()-((date('w',time())==0?7:date('w',time()))-1)*24*3600)).'至'.date("Y-m-d");break;
            case 'last week':return  date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1-7,date("Y"))).'至'.date("Y-m-d",strtotime("-1 Sunday"));break;
            case 'month':return date('Y-m');break;
            case 'last month':return  date('Y-m',strtotime("-1 month"));break;
        }
    }
}

function dd($data = "") {
    halt($data);
}

/**
 * 根据经纬度获取距离 比较距离
 * @param $lon1 float 经度
 * @param $lat1 float 维度
 * @param $lon2 float 经度
 * @param $lat2 float 维度
 * @param float $radius  星球半径
 * @return float
 */
function getDistanceByLngAndLat($lon1,$lat1,$lon2,$lat2,$radius = 6378.137)
{
    $rad = floatval(M_PI / 180.0);

    $lat1 = floatval($lat1) * $rad;
    $lon1 = floatval($lon1) * $rad;
    $lat2 = floatval($lat2) * $rad;
    $lon2 = floatval($lon2) * $rad;

    $theta = $lon2 - $lon1;

    $dist = acos(sin($lat1) * sin($lat2) +
        cos($lat1) * cos($lat2) * cos($theta)
    );

    if ($dist < 0 ) {
        $dist += M_PI;
    }

    return $dist = $dist * $radius;
}

/**
 * 传递配置文件
 * @param $select integer 选择的库
 */
function redis_connect(int $select = 3) {
    $config = config('cache.redis');
    $client = new \Redis();
    $client->connect($config['host'], $config['port'], $config['timeout']);
    $client->auth($config['password']);
    $client->select($select);
    return $client;
}

function getCurrentStrtotime($time = null)
{
    $time = (($time == null) ? time() : $time);

    return strtotime(date('Y-m-d', $time));
}

function filterEmoji($str)
{
    $str = preg_replace_callback(
        '/./u',
        function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },
        $str);

    return trim($str);
}

/**
 * 发起http - get请求
 * @param $uri
 * @return string
 * @throws Exception
 */
function httpClient($uri) {
    $client = new GuzzleHttp\Client();
    $response = $client->get($uri);
    if( $response->getStatusCode() !== 200) {
        throw new Exception($response->getReasonPhrase());
    }
    $body = $response->getBody();
    return $body->getContents();
}

/**
 * 数据进行加密
 * @param $data string 密钥内容
 * @param $data string 对应的配置内容
 *  DES-ECB
DES-CBC
DES-CTR
DES-OFB
DES-CFB
 */
function encrypt(string $data, string $secret_key) {
    $secrets = \config('secret.' . $secret_key);
    $result = openssl_encrypt($data, $secrets['method'], $secrets['password'], $secrets['options'], $secrets['iv']);
    $result = base64_encode($result);
    return $result;
}

/**
 * 解密
 * @param string $data
 * @param string $secret_key
 * @return string
 */
function decrypt(string $data, string $secret_key) {
    $data = base64_decode($data);
    $secrets = \config('secret.' . $secret_key);

    $result = openssl_decrypt($data, $secrets['method'], $secrets['password'], $secrets['options'], $secrets['iv']);
    return $result;
}

/**
 * 返回一个pdo实例
 * @return PDO
 */
function connect_pdo() {
    $host = \config('database.hostname');
    $dbname = \config('database.database');
    $username = \config('database.username');
    $password = \config('database.password');
    $dns = "mysql:host={$host};dbname={$dbname}";
    return new \PDO($dns, $username, $password);
}

function getImgsInfo(array $imgs)
{
    $data = array();

    foreach ($imgs as $key => $value){

        try{
            $getImgsinfo = getimagesize($value);

            $data[] = $getImgsinfo[0].','.$getImgsinfo[1];
        }catch (\Exception $e){

            $data[] = '800,800';
        }
    }

    return $data;
}

//function workerMysql() {
//    return new \Workerman\MySQL\Connection(config('database.hostname'), config('database.hostport'), config('database.username'), config('database.password'), config('database.database'));
//}

