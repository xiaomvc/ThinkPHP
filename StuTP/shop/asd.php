<?php
//打开图片，获取图片信息
$src = "1.jpg";
$info = getimagesize($src);
//格式化输出

//获取图片的格式,false参数可以去掉小数点.jpg(jpg)
$type=image_type_to_extension($info[2],false);
//在内存中保存图片
$fun="imagecreatefrom{$type}";
$image=$fun($src);//iamgecreateformjpg($src)/imagecreateformpng($src)

//操作图片
$size=30;
$angle=10;
$font_file="msyh.ttf";
$context="我爱美女";
//参数有（原图片，红，绿，蓝（rgb）,透明度）
$color=  imagecolorallocatealpha($image, 250, 250, 250, 50);
//参数有（原图片，字体大小，倾斜度，位置x轴，y轴，图片颜色，字体类型（简体，宋体等），文字内容）
imagettftext($image, $size, $angle,$info[0]-250,$info[1]-150, $color, $font_file, $context);

//输出图片（先确定输出的类型）
header("Content-type:".$info["mime"]);//Content-type:image/jpeg
$func="image{$type}";//iamgejpg/imagepng等，格式不同，方法不同
$func($image);//输出图片如:imagejpg($image);

//保存图片,若保存的位置存在，则会覆盖
//参数（要保存的图片源，要保存的位置（这里为同一级目录））
$func($image,"image1.".$type);

//销毁内存中的图片
imagedestroy($image);
