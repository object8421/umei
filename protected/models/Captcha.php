<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/20
 * Time: 下午6:05
 */

class Captcha {
    /**
     * 背景图片所在目录
     *
     * @var string  $folder
     */
    public $folder     = '/captcha';

    /**
     * 图片的文件类型
     *
     * @var string  $img_type
     */
    private $img_type   = 'png';

    /* 存在session中的名称  */
    public $session_word = 'captcha_word';

    private function get_capt()
    {
        return $this->session_word;
    }
    /**
     * 背景图片以及背景颜色
     *
     * 0 => 背景图片的文件名
     * 1 => Red, 2 => Green, 3 => Blue
     * @var array   $themes
     */
    private $themes_jpg = array(
        1 => array('captcha_bg1.jpg', 0, 0, 0),
        2 => array('captcha_bg2.jpg', 0, 0, 0),
        3 => array('captcha_bg3.jpg', 0, 0, 0),
        4 => array('captcha_bg4.jpg', 0, 0, 0),
        5 => array('captcha_bg5.jpg', 0, 0, 0),
    );

    /**
     * 图片的宽度
     *
     * @var integer $width
     */
    private $width      = 50;

    /**
     * 图片的高度
     *
     * @var integer $height
     */
    private $height     = 20;

    /**
     * 构造函数
     *
     * @access  public
     * @param   string  $folder     背景图片所在目录
     * @param   integer $width      图片宽度
     * @param   integer $height     图片高度
     * @return  bool
     */
    public function __construct($folder = '', $width = 145, $height = 20)
    {
        if (!empty($folder))
        {
            $this->folder = $folder.'/';
        }

        $this->width    = $width;
        $this->height   = $height;

        /* 检查是否支持 GD */
        if (PHP_VERSION >= '4.3')
        {

            return (function_exists('imagecreatetruecolor') || function_exists('imagecreate'));
        }
        else
        {

            return (((imagetypes() & IMG_GIF) > 0) || ((imagetypes() & IMG_JPG)) > 0 );
        }
    }

    /**
     * 检查给出的验证码是否和session中的一致
     *
     * @access  public
     * @param   string  $word   验证码
     * @return  bool
     */
    public function check_word($word)
    {
        $recorded = isset(Yii::app()->request->cookies[$this->session_word]->value) ? base64_decode(Yii::app()->request->cookies[$this->session_word]->value) : '';
        $given    = $this->encrypts_word(strtoupper($word));
        return (preg_match("/$given/", $recorded));
    }

    /**
     * 生成图片并输出到浏览器
     *
     * @access  public
     * @param   string  $word   验证码
     * @return  mix
     */
    public function generate_image($word = false)
    {
        if (!$word)
        {
            $word = $this->generate_word();
        }

        // 记录验证码到session
        $this->record_word($word);

        // 验证码长度
        $letters = strlen($word);

        // 选择一个随机的方案
        mt_srand((double) microtime() * 1000000);
        if (function_exists('imagecreatefromjpeg') && ((imagetypes() & IMG_JPG) > 0))
        {
            $theme  = $this->themes_jpg[mt_rand(1, count($this->themes_jpg))];
        }
        else
        {
            return false;
        }

        if (!file_exists($this->folder . $theme[0]))
        {
            return false;
        }
        else
        {
            $img_bg    = (function_exists('imagecreatefromjpeg') && ((imagetypes() & IMG_JPG) > 0)) ?
                imagecreatefromjpeg($this->folder . $theme[0]) : imagecreatefromgif($this->folder . $theme[0]);
            $bg_width  = imagesx($img_bg);
            $bg_height = imagesy($img_bg);

            $img_org   = ((function_exists('imagecreatetruecolor')) && PHP_VERSION >= '4.3') ?
                imagecreatetruecolor($this->width, $this->height) : imagecreate($this->width, $this->height);

            // 将背景图象复制原始图象并调整大小
            if (function_exists('imagecopyresampled') && PHP_VERSION >= '4.3') // GD 2.x
            {
                imagecopyresampled($img_org, $img_bg, 0, 0, 0, 0, $this->width, $this->height, $bg_width, $bg_height);
            }
            else // GD 1.x
            {
                imagecopyresized($img_org, $img_bg, 0, 0, 0, 0, $this->width, $this->height, $bg_width, $bg_height);
            }
            imagedestroy($img_bg);

            // 绘制文字
            $x = ($this->width - (imagefontwidth(5) * $letters)) / 2;
            $y = ($this->height - imagefontheight(5)) / 2;
            for($i=0; $i<4; $i++)
            {
                $clr_rand = imagecolorallocate($img_org, mt_rand(0,200), mt_rand(0,200), mt_rand(0,200));
                imagestring($img_org, 5, $x+imagefontwidth(5)*$i, $y, $word{$i}, $clr_rand);
            }

            // 绘制边框
            $clr = imagecolorallocate($img_org, $theme[1], $theme[2], $theme[3]);
            //imagerectangle($img_org, 0, 0, $this->width - 1, $this->height - 1, $clr);

            // 画干扰线
            for($i=0; $i<5; $i++)
            {
                $linecolor = imagecolorallocate($img_org, mt_rand(100,255), mt_rand(100,255), mt_rand(100,255));
                $line_x1 = mt_rand(1,48);$line_y1 = mt_rand(1,48);
                $line_x2 = mt_rand(1,48);$line_y2 = mt_rand(1,48);
                imageline($img_org, $line_x1, $line_y1, $line_x2, $line_y2, $linecolor);
            }

            header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
            // HTTP/1.1
            header('Cache-Control: private, no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0, max-age=0', false);

            // HTTP/1.0
            header('Pragma: no-cache');
            if ($this->img_type == 'jpeg' && function_exists('imagecreatefromjpeg'))
            {
                header('Content-type: image/jpeg');
                imageinterlace($img_org, 1);
                imagejpeg($img_org, false, 95);
            }
            else
            {
                header('Content-type: image/png');
                imagepng($img_org);
            }
            imagedestroy($img_org);
            return true;
        }
    }

    /**
     * 对需要记录的串进行加密
     *
     * @access  private
     * @param   string  $word   原始字符串
     * @return  string
     */
    private function encrypts_word($word)
    {
        return substr(md5($word), 1, 10);
    }

    /**
     * 将验证码保存到session
     *
     * @access  private
     * @param   string  $word   原始字符串
     * @return  void
     */
    private function record_word($word)
    {
        Yii::app()->request->cookies[$this->session_word] = new CHttpCookie($this->session_word, base64_encode($this->encrypts_word($word)));
    }

    /**
     * 生成随机的验证码
     *
     * @access  private
     * @param   integer $length     验证码长度
     * @return  string
     */
    private function generate_word($length = 4)
    {
        $chars = '2345689ABCDEFGHJKLMNPQRSTUVWXY';

        for ($i = 0, $count = strlen($chars); $i < $count; $i++)
        {
            $arr[$i] = $chars[$i];
        }

        mt_srand((double) microtime() * 1000000);
        shuffle($arr);

        return substr(implode('', $arr), 5, $length);
    }
}
