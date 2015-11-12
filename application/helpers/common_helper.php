<?php

function get_first_char($str = '') {
	return substr($str, 0, 1);
}

function get_three_char($str = '') {
	return substr($str, 0, 3);
}

function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
	if ($code == 'UTF-8') {
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all ( $pa, $string, $t_string );
		if (count ( $t_string [0] ) - $start > $sublen)
			return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) . "...";
		return join ( '', array_slice ( $t_string [0], $start, $sublen ) );
	} else {
		$start = $start * 2;
		$sublen = $sublen * 2;
		$strlen = strlen ( $string );
		$tmpstr = '';
		for($i = 0; $i < $strlen; $i ++) {
			if ($i >= $start && $i < ($start + $sublen)) {
				if (ord ( substr ( $string, $i, 1 ) ) > 129) {
					$tmpstr .= substr ( $string, $i, 2 );
				} else {
					$tmpstr .= substr ( $string, $i, 1 );
				}
			}
			if (ord ( substr ( $string, $i, 1 ) ) > 129)
				$i ++;
		}
		if (strlen ( $tmpstr ) < $strlen)
			$tmpstr .= "...";
		return $tmpstr;
	}
}

// 返回图片缩图
function get_thumb_pic($pic_id, $thumb = 's') {
	$pic_id_new = '';
	if ($pic_id) {
		$pic_id_1 = explode ( ".", $pic_id );
		$pic_id_new = $pic_id_1 [0] . '_' . $thumb . '.' . $pic_id_1 [1];
	}
	
	return $pic_id_new;
}

function get_chengyu_pinyin_index() {
	return array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'W', 'X', 'Y', 'Z');
}

function get_ttf() {
	return array(
				0	=> '北师大说文小篆.ttf',
				1	=> '博洋草书.ttf',
				2	=> '博洋行书.ttf',
				3	=> '陈继世怪怪体.ttf',
				4	=> '简平和体.ttf',
				5	=> '金文大篆体.ttf',
				6	=> '经典繁毛楷.ttf',
				7	=> '黎凡草书繁体.ttf',
				8	=> '李旭科毛笔行书.ttf',
				9	=> '毛泽东字体.ttf',
				10	=> '米芾体.ttf',
				11	=> '腾祥孔淼卡通字体.ttf',
				12	=> '叶根友新篆简体.ttf',
				13	=> '叶根友行书.ttf',
				14	=> '中國龍海行書.ttf',
				15	=> '中國龍豪行書.ttf',
				16	=> '钟齐蔡云汉毛笔行书.ttf',
				17	=> '钟齐段宁行书.ttf',
				18	=> '钟齐李洤标准草书.ttf',
				19	=> '钟齐志莽行书.ttf'
			);
}

// 取合法SQL字符串
// 如：输入字符串1,,2,3,  返回 1,2,3
function get_legitimate_str($str = '', $is_numeric = TRUE) {
	if(empty($str) && (int)$str != 0) return '';
	
	$str = str_replace('，', ',', $str); 
	$arr = split(',', $str);
	$new_str = '';
	
	foreach ($arr as $key=>$val) {
		if( ! is_numeric($val) && $is_numeric === TRUE)
			continue;
			
		if(empty($new_str) AND $new_str != '0') {
			$new_str = trim($val);
		}else {
			$new_str .= ','.trim($val);
		}
	}
	
	return $new_str;
}