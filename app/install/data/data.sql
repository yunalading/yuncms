INSERT INTO `yc_model` (`model_id`, `model_name`, `del_lock`, `delete_time`, `update_time`, `create_time`) VALUES
(2, '模板中心', 0, NULL, 1493795807, 1493795807),
(3, '成功案例', 0, NULL, 1493943633, 1493943633);
INSERT INTO `yc_category` (`category_id`, `model_id`, `seo_title`, `seo_url`, `seo_key`, `seo_desc`, `category_name`, `list_template`, `info_template`, `category_sort`, `parent_category_id`, `delete_time`, `update_time`, `create_time`, `del_lock`) VALUES
(2, 2, '模板 定制 中心', 'templates', '模板 定制', '模板展示', '模板中心', 'templet', 'caseshow', 1, 0, NULL, 1493796202, 1493717020, 0),
(3, 1, '定制服务', 'service', '定制 服务', '定制服务', '定制服务', 'service', 'service', 2, 0, NULL, 1493772542, 1493772542, 0),
(4, 3, '成功 案例', 'case', '成功 案例', '成功案例', '成功案例', 'case', 'caseshow', 3, 0, NULL, 1493943785, 1493772623, 0),
(5, 1, '关于我们', 'about us', '关于我们', '关于我们', '关于我们', 'about', 'about', 4, 0, NULL, 1493772673, 1493772673, 0),
(6, 1, '合作伙伴', 'partner', '合作伙伴 合作 伙伴', '合作伙伴', '合作伙伴', 'case', 'case', 10, 0, NULL, 1493787719, 1493787719, 0);
INSERT INTO `yc_contents` (`content_id`, `category_id`, `user_id`, `title`, `cover`, `intro`, `content`, `read_number`, `comment_number`, `seo_title`, `seo_url`, `seo_key`, `seo_desc`, `content_sort`, `tag_id`, `content_state`, `push_time`, `delete_time`, `update_time`, `create_time`) VALUES
(1, 6, 1, '冠海造桥', 'data/upload/images/server/20170503/59c59e4a43d3be2282af9f51d05e5115.jpg', '', '', 0, 0, NULL, 'zaoqiao', NULL, NULL, 0, 1, 0, 1493788372, NULL, 1493788372, 1493788372),
(2, 6, 1, '融侨集团', 'data/upload/images/server/20170503/e45fe7275ddc4a5ce72429b73db63af0.jpg', '', '', 0, 0, NULL, 'rongqiao', NULL, NULL, 0, 1, 0, 1493788416, NULL, 1493788416, 1493788416),
(3, 6, 1, '泰禾集团', 'data/upload/images/server/20170503/aa140912a21ac1db103faca8a252807e.jpg', '', '', 0, 0, NULL, 'taihe', NULL, NULL, 0, 1, 0, 1493788457, NULL, 1493788457, 1493788457),
(4, 6, 1, '万达集团', 'data/upload/images/server/20170503/150164151df6d5b1008d9e1bbb445dc8.jpg', '', '', 0, 0, NULL, 'wanda', NULL, NULL, 0, 1, 0, 1493788482, NULL, 1493788482, 1493788482),
(5, 2, 1, '测试测试', 'data/upload/images/server/20170503/de7eb555603fef3acfc56d6fdcede1f0.jpg', '   aaaaa', '   bbb', 0, 0, 'cccc', 'demo', '测试', NULL, 0, 1, 0, 1493805460, NULL, 1493884240, 1493805460);
INSERT INTO `yc_links` (`link_id`, `link_name`, `link_logo`, `link_href`, `link_target`, `link_is_home`, `link_sort`, `create_time`) VALUES
(1, '云阿拉丁', 'data/upload/images/server/20170502/15ae803368fd4e854544c5490005ee3e.jpg', 'http://www.yunalading.com', '_blank', 0, 1, 1493708359);
INSERT INTO `yc_article_properties` (`id`, `article_id`, `type`, `model_properties_id`, `value`, `delete_time`, `update_time`, `create_time`) VALUES
(1, 5, 1, 1, '1', NULL, 1493884240, 1493805460),
(2, 5, 1, 2, 'f_bc1', NULL, 1493884240, 1493805460),
(3, 5, 1, 3, '0001', NULL, 1493884240, 1493805768),
(4, 5, 1, 4, '1000', NULL, 1493884240, 1493880898);
INSERT INTO `yc_model_properties` (`model_properties_id`, `model_id`, `pro_name`, `pro_key`, `pro_cate`, `pro_desc`, `pro_value`, `create_time`, `update_time`) VALUES
(1, 2, '模板类型', 'styles', 4, NULL, '通用网站|1,财务管理|2,保洁公司|3,广告设计|4,送水公司|5,汽车4S店|6,礼品设计|7,科技公司|8', 1493796158, 1493796158),
(2, 2, '色调', 'tone', 4, NULL, '七彩色调|m_color,粉色调|f_bc1,红色调|f_bc2', 1493797812, 1493797812),
(3, 2, '编号', 'number', 1, NULL, NULL, 1493805641, 1493805641),
(4, 2, '报价', 'price', 1, NULL, NULL, 1493880875, 1493880875),
(5, 3, '案例分类', 'anli', 4, NULL, '品牌创意|a,企业官方|b,电子商务|c,集团商务|d', 1493943759, 1493943759);
