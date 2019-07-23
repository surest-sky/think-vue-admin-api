/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50725
Source Host           : localhost:3306
Source Database       : permission

Target Server Type    : MYSQL
Target Server Version : 50725
File Encoding         : 65001

Date: 2019-07-23 15:52:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 NOT NULL COMMENT '密码',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `login_ip` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆ip',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:正常,2:锁定',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `nickname` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户昵称',
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户头像,七牛云的key',
  `description` varchar(255) CHARACTER SET utf8 DEFAULT '优秀的管理员' COMMENT '个人简介',
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`) USING BTREE,
  UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('5', 'admin', '83b2f027abe3b60eadee76ab39fbdc5a', '1563862664', '127.0.0.1', '1', '0', '1563862664', 'admin', 'http://cdn.surest.cn/19.967929173999956', '', '');
INSERT INTO `admin_user` VALUES ('7', '测试', '83b2f027abe3b60eadee76ab39fbdc5a', '1563790637', '0.0.0.0', '1', '0', '1563790637', '测试', 'http://cdn.surest.cn/19.967929173999956', '', '15621352@qq.com');

-- ----------------------------
-- Table structure for circle
-- ----------------------------
DROP TABLE IF EXISTS `circle`;
CREATE TABLE `circle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content` text COMMENT '内容',
  `imgs` text,
  `create_time` int(16) DEFAULT NULL,
  `update_time` int(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1：已上线 2：已屏蔽 3:已删除 4：待审核 ',
  `longitude` double(12,6) DEFAULT NULL COMMENT '经度',
  `latitude` double(12,6) DEFAULT NULL COMMENT '纬度',
  `page_view` int(12) DEFAULT '0',
  `like_count` int(12) DEFAULT '0' COMMENT '点赞数量',
  `beautiful_count` int(12) DEFAULT '0' COMMENT '美数量',
  `handsome_count` int(12) DEFAULT '0' COMMENT '帅数量',
  `howe_count` int(12) DEFAULT '0' COMMENT '豪数量',
  `is_show` tinyint(1) DEFAULT '0' COMMENT '是否显示 0：否 1:是',
  `imgs_info` text COMMENT '图片信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6626 DEFAULT CHARSET=utf8mb4 COMMENT='圈子表';

-- ----------------------------
-- Records of circle
-- ----------------------------
INSERT INTO `circle` VALUES ('1', '6', 'test', '[\"https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1562148607&di=cad4e8fd9938b4af8cdf83682268cd41&src=http://p0.ifengimg.com/pmop/2017/1001/2DB7420552DB01E62DCDBDFB88CA0C74396561FC_size101_w640_h463.jpeg\",\"https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1562148607&di=cad4e8fd9938b4af8cdf83682268cd41&src=http://p0.ifengimg.com/pmop/2017/1001/2DB7420552DB01E62DCDBDFB88CA0C74396561FC_size101_w640_h463.jpeg\",\"https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1562148607&di=cad4e8fd9938b4af8cdf83682268cd41&src=http://p0.ifengimg.com/pmop/2017/1001/2DB7420552DB01E62DCDBDFB88CA0C74396561FC_size101_w640_h463.jpeg\",\"https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1562148607&di=cad4e8fd9938b4af8cdf83682268cd41&src=http://p0.ifengimg.com/pmop/2017/1001/2DB7420552DB01E62DCDBDFB88CA0C74396561FC_size101_w640_h463.jpeg\"]', '1562229089', '1563852822', '深圳龙岗', '1', '114.129122', '22.650259', '79', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('6', '4', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292210', '1562292210', '华熠大厦', '1', '114.125930', '22.649967', '1', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('7', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292264', '1562292264', '华熠大厦', '1', '114.125930', '22.649967', '4', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('8', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292265', '1562292265', '华熠大厦', '1', '114.125930', '22.649967', '0', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('9', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292266', '1562292266', '华熠大厦', '1', '114.125930', '22.649967', '0', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('10', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292271', '1562292271', '华熠大厦', '1', '114.125930', '22.649967', '7', '0', '0', '0', '1', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('11', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292318', '1562292318', '华熠大厦', '1', '114.125930', '22.649967', '9', '1', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('12', '16', '对的', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562292639', '1562292639', '华熠大厦', '1', '114.125930', '22.649967', '0', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('13', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562296496', '1562296496', '华熠大厦', '1', '114.125930', '22.649967', '7', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('14', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562566804', '1562566804', null, '1', null, null, '1', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('15', '16', '呵呵哒', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562566824', '1562566824', '华熠大厦', '1', '114.125930', '22.649967', '7', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('16', '16', 'test', '[\"https:\\/\\/offline-photo.d88.tech\\/FuAliOPYJ3K2WSUCFn-Ggv2N2m_p\",\"https:\\/\\/offline-photo.d88.tech\\/FuAliOPYJ3K2WSUCFn-Ggv2N2m_p\",\"https:\\/\\/offline-photo.d88.tech\\/FuAliOPYJ3K2WSUCFn-Ggv2N2m_p\",\"https:\\/\\/offline-photo.d88.tech\\/FuAliOPYJ3K2WSUCFn-Ggv2N2m_p\",]', '1562568611', '1562568611', '东莞总站', '1', '113.716866', '23.031196', '31', '0', '0', '1', '0', '0', '[\"800,558\"]');
INSERT INTO `circle` VALUES ('17', '4', '图片压缩', '[\"https:\\/\\/offline-photo.d88.tech\\/lg3qIT8672-flT8UVSRJDxV9ElkQ\"]', '1562569168', '1562569168', '华熠大厦B座', '1', '114.125646', '22.649928', '9', '0', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('18', '4', '图片压缩上传', '[\"https:\\/\\/offline-photo.d88.tech\\/FlLeqs2Bq3WioWDXH6F_HMu9QFw9\"]', '1562569811', '1562569811', null, '1', null, null, '17', '1', '0', '0', '0', '0', '[\"800,600\"]');
INSERT INTO `circle` VALUES ('19', '9', 'dddd', '[\"https:\\/\\/offline-photo.d88.tech\\/FhvpjWfbXRoBBywVDddOYdtHhC6c\"]', '1562573919', '1562573919', null, '1', null, null, '30', '0', '0', '1', '0', '0', null);
INSERT INTO `circle` VALUES ('20', '1', '把它', '[\"https:\\/\\/offline-photo.d88.tech\\/FkVHuQTNWlmGQnQ8KmrtnR6XMlBr\"]', '1562574987', '1562574987', null, '1', null, null, '28', '1', '1', '1', '0', '0', '[\"450,800\"]');
INSERT INTO `circle` VALUES ('21', '9', '而成色', '[\"https:\\/\\/offline-photo.d88.tech\\/FhvpjWfbXRoBBywVDddOYdtHhC6c\",\"https:\\/\\/offline-photo.d88.tech\\/Fseitiz6txZ1mj26vyXnxmbTuRoq\"]', '1562575599', '1562575599', '深圳北站', '1', '114.029397', '22.609756', '38', '0', '0', '0', '1', '0', null);
INSERT INTO `circle` VALUES ('125', '5', '哦吼', '[\"https:\\/\\/offline-photo.d88.tech\\/FlpACRhkSnP632SlVhtpKErhOcTH\",\"https:\\/\\/offline-photo.d88.tech\\/FlpACRhkSnP632SlVhtpKErhOcTH\",\"https:\\/\\/offline-photo.d88.tech\\/FlpACRhkSnP632SlVhtpKErhOcTH\",\"https:\\/\\/offline-photo.d88.tech\\/FlpACRhkSnP632SlVhtpKErhOcTH\"]', '1562576962', '1562576962', '东莞会馆', '1', '113.920289', '22.543306', '15', '0', '0', '0', '0', '0', '[\"800,774\"]');
INSERT INTO `circle` VALUES ('127', '144', '深圳新店 | 酥心SUSUM·新晋网红拍照地‼️民宿下午茶聚会首选✨\n#深圳[地点]##酥心[地点]#\n✨前几天发现了一家新晋拍照打卡地，超大面积三层楼的别墅新店?这里不仅是下午茶，也有民宿、韩式插花、尤克里里课、烘培课、摄影课、茶道、KTV等，非常适合聚会?\n✨一楼露天区域有个超大的圆形卡座，旁边还有小吊床，非常适合拍照?室内适合下午茶，装修风格特别的异国风情；还有两层楼高的书架，空间超大‼️除此之外插花课、KTV也是在一楼?\n✨二楼是民宿区，有希腊房、纪念碑谷房和日式茶道屋。每间房间都设计的非常好看，最喜欢希腊房的小浴缸和吊椅了?\n✨三楼是超大空间的烧烤区域，蓝天配上白色的桌椅，超级有度假风⛱️\n✨出品特别多，饮品每一杯都颜值在线，并且有甜品和小吃?\n▫️小确幸 ?38rmb\n▫️日落 ?38rmb\n这两杯都是招牌，颜色小清新又好喝?\n✨这次和闺蜜小聚还特地带了三瓶起泡酒，非常适合女生喝，度数不高味道香甜，是女生爱喝的果酒?而且颜值特别高，在这放松小酌一杯非常惬意。\n▫️蓝海之鲸-意大利??度数5%\n喝起来是浓郁的青苹果味，之后有淡淡的梨子香气，甜甜的不会感到腻\n▫️爱格尼-西班牙??度数5.5%\n这瓶超浪漫，是少女感十足充满玫瑰香味的起泡酒。喝完后嘴里会环绕着淡淡的香气。\n▫️天使之手-意大利?? 度数5%\n这瓶是淡淡的桃子和荔枝香，味道小清新，很适合不怎么会喝酒的女生～\n✨这家店新开的目前人还不多，大家快去打卡吧‼️\n——————————————————\n?起泡酒??【某宝】一杯的店\n?店名：酥心SUSUM#酥心[地点]#\n?地址：深圳市龙华新区民治梅花山庄欣梅园C5栋（导航可直接搜酥心）\n?地铁：民治D口步行10分钟\n⏰营业时间：14:00-21:30\n?人均：下午茶70rmb\n@薯队长  @吃货薯  @生活薯', '[\"https:\\/\\/ci.xiaohongshu.com\\/b7be0ca7-d8ca-51e1-b013-dcf1c040ee28?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/ac0248c4-3bba-5543-91ff-7dadc4697803?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/21133c55-3e47-53d4-8c97-ac77010a2a7c?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/8f2976d5-daf8-5328-b0c0-e53b9497e116?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/055d84c3-6131-5004-ac54-e7d36f348262?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/ad210d35-e85f-5787-95ad-b7c2fcbb2182?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/b11acbfb-5db2-555c-b584-94884f1faafa?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/815ff755-ad6b-590c-b7c6-c0f9705be021?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/a4b4bda6-039a-50d0-a32e-e87b5fc30213?imageView2\\/2\\/w\\/1080\\/format\\/jpg\"]', '1562577341', '1562577341', null, '1', null, null, '13', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('128', '145', '新买的dr.wu水乳\n深圳研丽买的\n刚好两件八折\n200＋240\n总共440\n折后352\n还不错\n不油腻\n下次想买dr.wu角鲨烷水乳了。', '[\"https:\\/\\/ci.xiaohongshu.com\\/eea62f02-d359-50b7-98eb-3e5071a59c05?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/297c8948-b1a3-52c2-8c9f-9cfad9de5cdf?imageView2\\/2\\/w\\/1080\\/format\\/jpg\"]', '1562577366', '1562577366', null, '1', null, null, '29', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('129', '5', 'he呵呵呵', '[\"https:\\/\\/offline-photo.d88.tech\\/FuAliOPYJ3K2WSUCFn-Ggv2N2m_p\",\"https:\\/\\/offline-photo.d88.tech\\/FhV6lf4DYmNvPCgWyf8VtFrpU0a9\"]', '1562579184', '1562579184', null, '1', null, null, '30', '0', '0', '0', '0', '0', '[\"800,558\"]');
INSERT INTO `circle` VALUES ('130', '2', '的88', '[\"https:\\/\\/offline-photo.d88.tech\\/FoY6u4RQFXZPKQEEWroVOJju5AMa\"]', '1562580035', '1562580035', null, '1', null, null, '22', '0', '0', '0', '0', '0', null);
INSERT INTO `circle` VALUES ('2215', '1708', '深圳美食 深圳旅游带你一次吃遍蛇口老字号\n吐血整理 深圳美食真的很多，但是特别喜欢蛇口这里的美食，而且超平价，这些店都是我的珍藏 求你们快去吃吧！\n✨百草堂凉茶铺 人均 25\n一家非常之无敌老字号的广式糖水铺 拍照片场\n我是怕甜的人但他家甜品甜度都觉得刚好\n(超爱杨枝甘露，椰子芋圆黑糯米，芝麻汤圆)\n蛇口人民感冒上火最爱他家的下火茶\n地理位置：东角头d出口步行200米左右\n⚠️晚上8至11点人多，需要排队\n✨胖子牛蹄 人均40\n满满满满满的胶原蛋白一点不腻，辅菜搭配千叶豆腐，娃娃菜，吸满汤汁，味道很足，出色！\n⚠️饭点需要排队，上菜速度慢，但吃到那口牛蹄也就原谅上菜速度\n地理位置：东角头a出口，步行100米\n✨牛家庄牛肉面 人均25\n每座城市都有一碗面，深圳的那碗面就是它了\n食客们口口相传的必吃的小店，超大碗，料非常足，牛杂牛腩软烂有味道，沾上附赠的酱碟简(一半辣一半沙茶)复合的味道口齿留香，河粉配上浓郁的汤汁让人十分惊艳\n地理位置：蛇口老街88号\n✨冬阴功 泰国料理店 人均80\n平价 正宗 超好吃\n必点的冬阴功汤 其他的可以参照推荐品都好吃不会踩雷\n猪颈肉外焦里嫩 趁热吃 最爱\n咖喱虾 虾简直不要太大只，咖喱简直太好次，搭配米饭不小心吃一整碗\n柠檬鱼肉很嫩 配上柠檬的香味及他家秘制的汤底根本停不下来\n牛肉金不换 完美 地理位置：水湾地铁站\n✨B仔牛杂 人均25\n之前是个小摊在湾厦摆了好多年，现在换地方了不过也在蛇口\n她家的酱汁很特别 很入味搭配牛杂特别好吃 虽然环境很一般 但是美食足已忽略这种小节\n很推荐她家的腐竹卷 外面一层腐竹里面包着菜\n地理位置：东角头b出口\n✨嘉华小吃 人均25\n他家的粽子在蛇口可是出了名的有两种：一种9元，一种7元，想要吃到9元的必须早上很早去才有还有一些潮汕小吃小米，菜粿都是得早上去才有\n粽子馅料：咸蛋黄 肉 板栗 蘑菇 /9元的有虾干呗\n还有他家的牛肉煲仔饭真的太TM香哭\n✨蛇口康乐快餐 人均60\n蛇口20多年大排档 来深圳就一直听说\n这里除了鱼还是鱼 鱼跟新鲜，不得不感概这边?️码头吃海鲜的感觉\n吹筒 ：小只鱿鱼，特别q\n多春鱼 ：鱼仔超多 脆脆香香的，鱼肉被剪炸的很香\n马友：这鱼，贼嫩，口感贼好强推\n圈内蒸：开胃，味道跟独特\n炒米粉，独特的爆香味\n东角头d出口步行400米\n✨张妈台式烧锅\n字数超了…886\n@吃货薯  @薯队长 深圳美食 网红美食我来推 ', '[\"https:\\/\\/ci.xiaohongshu.com\\/68de5db6-57d5-48ee-b8a1-0fda1683b34d?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/b1f384eb-1ab4-49d0-be84-628113ebd81d?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/8a23d944-b863-43c8-9507-04002db5fa65?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/6324f2dc-d9d8-49ea-8bb0-c1017456c19a?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/92d9bbbb-476f-435d-8661-7bea59fbbd72?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/cf85279f-1f2f-4841-930c-aed4e79b920f?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/07c4608d-1be5-4f44-abda-a7f7a9b4b4aa?imageView2\\/2\\/w\\/1080\\/format\\/jpg\",\"https:\\/\\/ci.xiaohongshu.com\\/a2dffde1-09e1-44e8-aac8-cef339e75908?imageView2\\/2\\/w\\/1080\\/format\\/jpg\"]', '1562653596', '1562653596', null, '1', null, null, '0', '0', '0', '0', '0', '1', null);

-- ----------------------------
-- Table structure for model_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permission`;
CREATE TABLE `model_has_permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL COMMENT '用户id',
  `permission_id` int(16) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_model_unique` (`user_id`,`permission_id`),
  KEY `delete_permission` (`permission_id`),
  CONSTRAINT `delete_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permission
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_role
-- ----------------------------
DROP TABLE IF EXISTS `model_has_role`;
CREATE TABLE `model_has_role` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(16) unsigned NOT NULL COMMENT '角色id',
  `user_id` int(16) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_model_unique` (`role_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_role
-- ----------------------------
INSERT INTO `model_has_role` VALUES ('27', '9', '7');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限节点名称(根据它来进行)',
  `rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路由地址',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '节点备注信息',
  `p_id` int(2) NOT NULL DEFAULT '0' COMMENT '用于菜单渲染的节点',
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 禁用 1 启用',
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求方法 array 格式',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由',
  `hidden` int(2) NOT NULL DEFAULT '1' COMMENT 'true',
  `icon` varchar(165) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2090 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('2048', ' 权限管理', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\Permission', '1', null);
INSERT INTO `permission` VALUES ('2049', ' 角色管理', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\Role', '1', null);
INSERT INTO `permission` VALUES ('2050', ' 登录相关', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\Auth', '1', null);
INSERT INTO `permission` VALUES ('2051', '\\app\\admin\\controller\\Qiniu', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\Qiniu', '1', null);
INSERT INTO `permission` VALUES ('2052', ' 管理员管理', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\AdminUser', '1', null);
INSERT INTO `permission` VALUES ('2053', ' 圈子管理', '#', '', '0', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"*\"]', '\\app\\admin\\controller\\Circle', '1', null);
INSERT INTO `permission` VALUES ('2054', ' 获取所有的权限', 'admin/permission/all', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Permission/all', '0', null);
INSERT INTO `permission` VALUES ('2055', ' 初始化权限节点', 'admin/permission/init_permission', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/Permission/init_permission', '1', null);
INSERT INTO `permission` VALUES ('2056', ' 获取所有的角色', 'admin/role/all', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/all', '0', null);
INSERT INTO `permission` VALUES ('2057', ' 获取我的信息', 'admin/me', '', '2050', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Auth/me', '0', null);
INSERT INTO `permission` VALUES ('2058', ' 显示指定的资源', 'admin/qiniu/photo', '', '2051', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Qiniu/photo', '0', null);
INSERT INTO `permission` VALUES ('2059', ' 退出登录', 'admin/logout', '', '2050', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"delete\"]', 'admin/Auth/logout', '1', null);
INSERT INTO `permission` VALUES ('2060', ' 获取角色信息', 'admin/role/permissions/<id>', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/permissions', '0', null);
INSERT INTO `permission` VALUES ('2061', ' 登录', 'admin/login', '', '2050', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/Auth/login', '1', null);
INSERT INTO `permission` VALUES ('2062', ' 权限管理', 'admin/permission', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Permission/index', '0', null);
INSERT INTO `permission` VALUES ('2063', ' 创建权限节点', 'admin/permission', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/Permission/save', '1', null);
INSERT INTO `permission` VALUES ('2064', '\\app\\admin\\controller\\Permission\\create', 'admin/permission/create', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Permission/create', '0', null);
INSERT INTO `permission` VALUES ('2065', '\\app\\admin\\controller\\Permission\\edit', 'admin/permission/<id>/edit', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Permission/edit', '0', null);
INSERT INTO `permission` VALUES ('2066', ' 获取权限信息', 'admin/permission/<id>', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Permission/read', '0', null);
INSERT INTO `permission` VALUES ('2067', ' 更新权限', 'admin/permission/<id>', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"put\"]', 'admin/Permission/update', '1', null);
INSERT INTO `permission` VALUES ('2068', ' 删除权限', 'admin/permission/<id>', '', '2048', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"delete\"]', 'admin/Permission/delete', '1', null);
INSERT INTO `permission` VALUES ('2069', ' 管理员管理', 'admin/admin-user', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/AdminUser/index', '0', null);
INSERT INTO `permission` VALUES ('2070', ' 添加管理员', 'admin/admin-user', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/AdminUser/save', '1', null);
INSERT INTO `permission` VALUES ('2071', '\\app\\admin\\controller\\AdminUser\\create', 'admin/admin-user/create', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/AdminUser/create', '0', null);
INSERT INTO `permission` VALUES ('2072', '\\app\\admin\\controller\\AdminUser\\edit', 'admin/admin-user/<id>/edit', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/AdminUser/edit', '0', null);
INSERT INTO `permission` VALUES ('2073', ' 获取管理员信息', 'admin/admin-user/<id>', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/AdminUser/read', '0', null);
INSERT INTO `permission` VALUES ('2074', ' 更新管理员', 'admin/admin-user/<id>', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"put\"]', 'admin/AdminUser/update', '1', null);
INSERT INTO `permission` VALUES ('2075', ' 删除管理员', 'admin/admin-user/<id>', '', '2052', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"delete\"]', 'admin/AdminUser/delete', '1', null);
INSERT INTO `permission` VALUES ('2076', ' 角色管理', 'admin/role', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/index', '0', null);
INSERT INTO `permission` VALUES ('2077', ' 创建角色', 'admin/role', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/Role/save', '1', null);
INSERT INTO `permission` VALUES ('2078', '\\app\\admin\\controller\\Role\\create', 'admin/role/create', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/create', '0', null);
INSERT INTO `permission` VALUES ('2079', '\\app\\admin\\controller\\Role\\edit', 'admin/role/<id>/edit', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/edit', '0', null);
INSERT INTO `permission` VALUES ('2080', '\\app\\admin\\controller\\Role\\read', 'admin/role/<id>', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Role/read', '0', null);
INSERT INTO `permission` VALUES ('2081', ' 修改角色', 'admin/role/<id>', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"put\"]', 'admin/Role/update', '1', null);
INSERT INTO `permission` VALUES ('2082', ' 删除角色', 'admin/role/<id>', '', '2049', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"delete\"]', 'admin/Role/delete', '1', null);
INSERT INTO `permission` VALUES ('2083', ' 圈子管理', 'admin/circle', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Circle/index', '0', null);
INSERT INTO `permission` VALUES ('2084', '\\app\\admin\\controller\\Circle\\save', 'admin/circle', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"post\"]', 'admin/Circle/save', '1', null);
INSERT INTO `permission` VALUES ('2085', '\\app\\admin\\controller\\Circle\\create', 'admin/circle/create', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Circle/create', '0', null);
INSERT INTO `permission` VALUES ('2086', '\\app\\admin\\controller\\Circle\\edit', 'admin/circle/<id>/edit', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Circle/edit', '0', null);
INSERT INTO `permission` VALUES ('2087', '\\app\\admin\\controller\\Circle\\read', 'admin/circle/<id>', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"get\"]', 'admin/Circle/read', '0', null);
INSERT INTO `permission` VALUES ('2088', '\\app\\admin\\controller\\Circle\\update', 'admin/circle/<id>', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"put\"]', 'admin/Circle/update', '1', null);
INSERT INTO `permission` VALUES ('2089', ' 删除圈子', 'admin/circle/<id>', '', '2053', '1', '2019-07-23 14:17:47', '2019-07-23 14:17:47', '[\"delete\"]', 'admin/Circle/delete', '1', null);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_role_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('9', '超级管理员', '', '2019-07-22 18:17:39', '2019-07-22 18:17:39');
INSERT INTO `role` VALUES ('10', '测试', '', '2019-07-22 17:05:53', '2019-07-22 17:05:54');

-- ----------------------------
-- Table structure for role_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permission`;
CREATE TABLE `role_has_permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(16) unsigned NOT NULL COMMENT '关联的权限id',
  `role_id` int(16) unsigned NOT NULL COMMENT '关联的角色id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_permission_role` (`permission_id`,`role_id`),
  KEY `deleted_to_role` (`role_id`),
  CONSTRAINT `deleted_to_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deleted_to_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1743 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色 - 权限的中间表';

-- ----------------------------
-- Records of role_has_permission
-- ----------------------------
