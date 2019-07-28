<?php
session_start();
//require 'password_compat-master/lib/password.php'; //forward compatibility fix for php 5.3
//function authenticateperson($key, $user_Name, $user_Password)
function authenticateperson($user_Name, $user_Password)
{
global $link;
$query = "select user_ID, user_Name, user_Password, user_Email, user_Level from userRecord where user_Name='$user_Name'";
$result = mysqli_query($link, $query) or die(mysqli_error());
	if(mysqli_num_rows($result) > 0)
	{
	$row = mysqli_fetch_row($result);
	list($user_ID, $user_Name, $hashedPwd, $user_Email, $user_Level) = $row;
		if((password_verify($user_Password, $hashedPwd)))
		{
		//set up session cookies for login and username
		
			$_SESSION['authenticateMnssT22nV57P'] = "validuserQy7r567v3ZHP";	//<-- MUST NOT JUST USE AUTHENTICATE AND VALIDUSER
			$_SESSION['user_ID'] = $user_ID;
			$_SESSION['user_Name'] = $user_Name;
			$_SESSION['user_Level'] = $user_Level;
							
			//get var's for login entry
			$datetime = date('m/d/Y h:i:s a');
			$userip = $_SERVER['REMOTE_ADDR'];
			
			//get the user's ip address and enter it into the login table
			$querylogin = "insert into userLogin values('', '$user_ID', now(), '$userip')";
			mysqli_query($link, $querylogin); // has no return value because not calling for a value, just adding
		}
			
	}
	else
	{
	$_SESSION['authenticateMnssT22nV57P'] = "Incorrect Login";
	$_SESSION['user_Name'] = "Not Logged In";
	$_SESSION['user_ID'] = "";
	$_SESSION['user_Level'] = "";
	}
}

function easyauth($user_Name, $user_Password)
{
global $link;
$query = "select user_Password, user_ID from userRecord where user_Name='$user_Name'";
$result = mysqli_query($link, $query) or die(mysqli_error());
	if(mysqli_num_rows($result) > 0)
	{
	$row = mysqli_fetch_row($result);
	list($hashedPwd, $user_ID) = $row;
		if((password_verify($user_Password, $hashedPwd)))
		{
		//set up session cookies for login and username
		
			$_SESSION['authenticate2xuP4s2Vbs'] = "validuser3Q3z5Kn4e3rj";
							
			//get var's for login entry
			$datetime = date('m/d/Y h:i:s a');
			$userip = $_SERVER['REMOTE_ADDR'];
			
			//get the user's ip address and enter it into the login table
			$querylogin = "insert into userLogin values('', '$user_ID', now(), '$userip')";
			mysqli_query($link, $querylogin); // has no return value because not calling for a value, just adding
		}
			
	}
	else
	{
	$_SESSION['authenticate2xuP4s2Vbs'] = "Incorrect Login";
	}
}

function fixstring($string)
{
$string = htmlentities($string, ENT_QUOTES);
return $string;
}

function unfixstring($string)
{
$string = html_entity_decode($string, ENT_QUOTES);
return $string;
}

function cleanUserInput($link, $input) {
	$input = mysqli_real_escape_string($link, $input);
	$input = htmlentities($input, ENT_QUOTES);
	return $input;
}

function uploadimage() //uploads image and creates thumbnail
{
	// this file requires very little modification... just change absolute path and image folder and should be good to go!
		
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path = $path . "/BDR-r03/uploads/";
	
	$userfile = $_FILES['userfile']['tmp_name'];
	$userfile_name = $_FILES['userfile']['name'];
	$userfile_size = $_FILES['userfile']['size'];
	$userfile_type = $_FILES['userfile']['type'];
	$userfile_error = $_FILES['userfile']['error']; 

	// If a unique name is required, you need to append the time to the file name.*/
	$userfile_name = "UID-1-" . time(). $userfile_name;

	if(isset($_POST['uploadfile']))
	{
	  if ($userfile_error > 0)
	  {
	  print " Problem: ";
		switch ($userfile_error)
		{
		  case 1:  print 'File exceeded upload_max_filesize';  break;
		  case 2:  print 'File exceeded max_file_size';  break;
		  case 3:  print 'File only partially uploaded';  break;
		  case 4:  print 'No file uploaded';  break;
		}
		exit;
	  } 
  
	if($userfile_type != "image/jpeg" && $userfile_type != "image/gif" && $userfile_type != "image/png")
	{
	print "File must be a JPEG, GIF, or PNG";
	}
	else 
		{
		$upfile = $path . $userfile_name; //<<- 
		if (is_uploaded_file($userfile))
		{
		$check = move_uploaded_file($userfile, $upfile);
			if(!$check)
			{
			print 'Problem: Could not move file to destination directory';
			exit;
			}  
		}
		else
		{
		print 'Problem: Possible file upload attack. Filename:'. $userfile_name;
		exit;
		} 
		//print 'File uploaded successfully ' . $userfile_name . '<br><br>';
		//print "<img src='user_images/$userfile_name' alt='file'><br>"; 
		
		//return $userfile_name; //return was here before create thumbnail
		
			if ($userfile_type == "image/jpeg")
			{
			$tempbig = imagecreatefromjpeg($path . $userfile_name);
			}
			elseif ($userfile_type == "image/gif")
			{
			$tempbig = imagecreatefromgif($path . $userfile_name);
			}
			elseif ($userfile_type == "image/png")
			{
			$tempbig = imagecreatefrompng($path . $userfile_name);
			imageAlphaBlending($tempbig, true);
			imageSaveAlpha($tempbig, true);
			}
		
		$bigsize = getimagesize($path . $userfile_name);

		$bigwidth = $bigsize[0];
		$bigheight = $bigsize[1];
		
		//print "The original file is $bigwidth by $bigheight<br>";
		if($bigwidth > 1140)
		{
		$thumbname0 = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 1140, 'full', 'regular');
		//print "<img src='uploads/$thumbname0'><br>";
		}
		
		/*if($bigwidth > 240)
		{
		$thumbname1 = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 240, 'th', 'regular');
		//print "<img src='user_images/$thumbname1'><br>";
		}*/

		//$thumbname2 = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 100, 'mini-th', 'regular');
		//print "<img src='user_images/$thumbname2'><br>";
		
		//$thumbname3 = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 50, 'micro-th', 'regular');
		//print "<img src='user_images/$thumbname3'><br>";
		
		//$thumbsettall = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 200, 'set-200', 'set_tall');
		//print "<img src='user_images/$thumbsettall'><br>";
		
		//$thumbsettall100 = createthumb($tempbig, $userfile_name, $bigwidth, $bigheight, $path, 100, 'set-100', 'set_tall');
		//print "<img src='user_images/$thumbsettall'><br>";
		
		$setaspectthumb = createThumbAlt ($tempbig, $userfile_name, $bigwidth, $bigheight, $path);
		//print "<img src='uploads/$setaspectthumb'><br>";
		
		ImageDestroy($tempbig);// moved this here from funx 'cause can't destroy before function is finished using it
		//----return must be last action of function
		return $userfile_name; 

		}
	}
}

function createthumb ($tempbig, $userfile_name, $bigwidth, $bigheight, $path, $thumb_size, $thumb_prefix, $thumb_type)
{
		// set the paramaters for the thumbnail size.. modified by code below to correct aspect ratio
		$thumb_width = $thumb_size;
		$thumb_height = $thumb_size;
		
		if ($thumb_type == 'regular')
		{
			if($bigwidth == $bigheight) //original is square
			{
			//do nothing - keep same values from above
			}
			elseif($bigwidth > $bigheight) // wider than taller
			{
			$aspect_calx = $bigheight / $bigwidth;
			$thumb_height = ceil($aspect_calx * $thumb_width);
			}
			else //taller than wider
			{
			$aspect_calx = $bigwidth / $bigheight;
			$thumb_width = ceil($aspect_calx * $thumb_height);
			}
		}
		elseif ($thumb_type == 'set_tall')
			{
			if($bigwidth == $bigheight) //original is square
			{
			//do nothing - keep same values from above
			//print "square";
			}
			else //*** for set height makes no diff on calx
			{
			$aspect_calx = $bigwidth / $bigheight;
			
			$thumb_width = ceil($aspect_calx * $thumb_size);
			}
		}
		

		//print "Thumb Width: $thumb_width<br>";
		//print "Thumb Height: $thumb_height<br>";
		
				
		//$tempsmall = imagecreatetruecolor(200, 200); // original basic
		$tempsmall = imagecreatetruecolor($thumb_width, $thumb_height);

		//imagecopyresampled($tempsmall, $tempbig, 0, 0, 0, 0, 200, 200, $bigwidth, $bigheight); // original basic
		imagecopyresampled($tempsmall, $tempbig, 0, 0, 0, 0, $thumb_width, $thumb_height, $bigwidth, $bigheight);
		
		$thumbname = $thumb_prefix . $userfile_name;
		imagejpeg($tempsmall, "$path" . "$thumbname", 95); //concatination works here in funx - may work above

		ImageDestroy($tempsmall); 
		
		return $thumbname;
}

function createThumbAlt ($tempbig, $userfile_name, $bigwidth, $bigheight, $path)
{
		// set the paramaters for the thumbnail size.. modified by code below to correct aspect ratio
		$thumb_width = 300;
		$thumb_height = 225;
		
		//225/300 = .75
		//print "Height/Width" . $bigheight / $bigwidth;
		
		if (($bigheight / $bigwidth) < .74)
		{
			//print "This image is wider than 4x3 aspect ratio<br>";
			$capture_width = $bigheight * 1.3333;
			//print "capture_width $capture_width<br>";
			$capture_width_trim = $bigwidth - $capture_width;
			//print "capture_width_trim $capture_width_trim<br>";
			$capture_width_trim_half = $capture_width_trim / 2;
			//print "capture_width_trim_half $capture_width_trim_half<br>";
			$capture_width_trim_half_int = intval($capture_width_trim_half);
			//print "capture_width_trim_half_int $capture_width_trim_half_int<br>";
			
			$trim_orig_left = $capture_width_trim_half_int; 
			$trim_orig_top = 0;
			$orig_use_width = $capture_width;
			$orig_use_height = $bigheight;
		}
		elseif ((($bigheight / $bigwidth) > .74) && (($bigheight / $bigwidth) < .76)) // little cushion here
		{
			//print "Image is exactly 4x3 aspect ratio";
			$trim_orig_left = 0;
			$trim_orig_top = 0;
			$orig_use_width = $bigwidth;
			$orig_use_height = $bigheight;
		}
		else
		{
			//print "Image must be taller than it is wide";
			$capture_height = $bigwidth * .75;
			
			//print "capture_height $capture_height<br>";
			$capture_height_trim = $bigheight - $capture_height;
			//print "capture_height_trim $capture_height_trim<br>";
			$capture_height_trim_half = $capture_height_trim / 2;
			//print "capture_height_trim_half $capture_height_trim_half<br>";
			$capture_height_trim_half_int = intval($capture_height_trim_half);
			//print "capture_height_trim_half_int $capture_height_trim_half_int<br>";
			
			$trim_orig_left = 0; 
			$trim_orig_top = $capture_height_trim_half_int;
			$orig_use_width = $bigwidth;
			$orig_use_height = $capture_height;
		}
		
		$tempsmall = imagecreatetruecolor(300, 225); // <<-- NEW THUMB SIZE HERE AND BELOW
		imagecopyresampled($tempsmall, $tempbig, 0, 0, $trim_orig_left, $trim_orig_top, 300, 225, $orig_use_width, $orig_use_height); // original basic
		//-->NOTES(image, image, dest_x, dest_y, source_x, source_y, dest_width, dest_height, source_width, source_height)
		
		//this works.. the orig is 800x400 trims 100 off each end and makes a thumb 150,100
		//--$tempsmall = imagecreatetruecolor(150, 100); // original basic
		//--imagecopyresampled($tempsmall, $tempbig, 0, 0, 100, 0, 150, 100, 600, 400); // original basic

		//++++$tempsmall = imagecreatetruecolor($thumb_width, $thumb_height);
		//-->NOTES(image, image, dest_x, dest_y, source_x, source_y, dest_width, dest_height, source_width, source_height)
		//++++imagecopyresampled($tempsmall, $tempbig, 0, 0, 0, 0, $thumb_width, $thumb_height, $bigwidth, $bigheight);
		
		$thumbname = "300x225" . $userfile_name;
		imagejpeg($tempsmall, "$path" . "$thumbname", 95); //concatination works here in funx - may work above

		ImageDestroy($tempsmall); 
		
		return $thumbname;
}
/*
//this works.. the orig is 800x400 trims 100 off each end and makes a thumb 150,100
$tempsmall = imagecreatetruecolor(150, 100); // original basic
imagecopyresampled($tempsmall, $tempbig, 0, 0, 100, 0, 150, 100, 600, 400); // original basic

//++++$tempsmall = imagecreatetruecolor($thumb_width, $thumb_height);
//-->NOTES(image, image, dest_x, dest_y, source_x, source_y, dest_width, dest_height, source_width, source_height)
//++++imagecopyresampled($tempsmall, $tempbig, 0, 0, 0, 0, $thumb_width, $thumb_height, $bigwidth, $bigheight);
*/

/**
 * Text handling methods.
 */
class Text
{
	/**
     * Get string length.
     *
     * ### Options:
     *
     * - `html` If true, HTML entities will be handled as decoded characters.
     * - `trimWidth` If true, the width will return.
     *
     * @param string $text The string being checked for length
     * @param array $options An array of options.
     * @return int
     */
    protected static function _strlen($text, array $options)
    {
        if (empty($options['trimWidth'])) {
            $strlen = 'mb_strlen';
        } else {
            $strlen = 'mb_strwidth';
        }

        if (empty($options['html'])) {
            return $strlen($text);
        }

        $pattern = '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i';
        $replace = preg_replace_callback(
            $pattern,
            function ($match) use ($strlen) {
                $utf8 = html_entity_decode($match[0], ENT_HTML5 | ENT_QUOTES, 'UTF-8');

                return str_repeat(' ', $strlen($utf8, 'UTF-8'));
            },
            $text
        );

        return $strlen($replace);
    }
	
	/**
     * Return part of a string.
     *
     * ### Options:
     *
     * - `html` If true, HTML entities will be handled as decoded characters.
     * - `trimWidth` If true, will be truncated with specified width.
     *
     * @param string $text The input string.
     * @param int $start The position to begin extracting.
     * @param int $length The desired length.
     * @param array $options An array of options.
     * @return string
     */
    protected static function _substr($text, $start, $length, array $options)
    {
        if (empty($options['trimWidth'])) {
            $substr = 'mb_substr';
        } else {
            $substr = 'mb_strimwidth';
        }

        $maxPosition = self::_strlen($text, ['trimWidth' => false] + $options);
        if ($start < 0) {
            $start += $maxPosition;
            if ($start < 0) {
                $start = 0;
            }
        }
        if ($start >= $maxPosition) {
            return '';
        }

        if ($length === null) {
            $length = self::_strlen($text, $options);
        }

        if ($length < 0) {
            $text = self::_substr($text, $start, null, $options);
            $start = 0;
            $length += self::_strlen($text, $options);
        }

        if ($length <= 0) {
            return '';
        }

        if (empty($options['html'])) {
            return (string)$substr($text, $start, $length);
        }

        $totalOffset = 0;
        $totalLength = 0;
        $result = '';

        $pattern = '/(&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};)/i';
        $parts = preg_split($pattern, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        foreach ($parts as $part) {
            $offset = 0;

            if ($totalOffset < $start) {
                $len = self::_strlen($part, ['trimWidth' => false] + $options);
                if ($totalOffset + $len <= $start) {
                    $totalOffset += $len;
                    continue;
                }

                $offset = $start - $totalOffset;
                $totalOffset = $start;
            }

            $len = self::_strlen($part, $options);
            if ($offset !== 0 || $totalLength + $len > $length) {
                if (strpos($part, '&') === 0 && preg_match($pattern, $part)
                    && $part !== html_entity_decode($part, ENT_HTML5 | ENT_QUOTES, 'UTF-8')
                ) {
                    // Entities cannot be passed substr.
                    continue;
                }

                $part = $substr($part, $offset, $length - $totalLength);
                $len = self::_strlen($part, $options);
            }

            $result .= $part;
            $totalLength += $len;
            if ($totalLength >= $length) {
                break;
            }
        }

        return $result;
    }
	
	/**
     * Removes the last word from the input text.
     *
     * @param string $text The input text
     * @return string
     */
    protected static function _removeLastWord($text)
    {
        $spacepos = mb_strrpos($text, ' ');

        if ($spacepos !== false) {
            $lastWord = mb_strrpos($text, $spacepos);

            // Some languages are written without word separation.
            // We recognize a string as a word if it doesn't contain any full-width characters.
            if (mb_strwidth($lastWord) === mb_strlen($lastWord)) {
                $text = mb_substr($text, 0, $spacepos);
            }

            return $text;
        }

        return '';
    }

	/**
     * Truncates text.
     *
     * Cuts a string to the length of $length and replaces the last characters
     * with the ellipsis if the text is longer than length.
     *
     * ### Options:
     *
     * - `ellipsis` Will be used as ending and appended to the trimmed string
     * - `exact` If false, $text will not be cut mid-word
     * - `html` If true, HTML tags would be handled correctly
     * - `trimWidth` If true, $text will be truncated with the width
     *
     * @param string $text String to truncate.
     * @param int $length Length of returned string, including ellipsis.
     * @param array $options An array of HTML attributes and options.
     * @return string Trimmed string.
     * @link http://book.cakephp.org/3.0/en/core-libraries/string.html#truncating-text
     */
	public static function truncate($type, $postID, $text, $length = 460, array $options = [])
    {
        $default = [
            'ellipsis' => "<a href='blog.php?post=$postID' class='readMore' id='readMore$postID'>... Read More</a>", 'exact' => false, 'html' => true, 'trimWidth' => false,
        ];
		//these are the same but in theory could be different for different options
		$search = [
            'ellipsis' => "<a href='blog.php?post=$postID' class='readMore' id='readMore$postID'>... Read More</a>", 'exact' => false, 'html' => true, 'trimWidth' => false,
        ];
        if (!empty($options['html']) && strtolower(mb_internal_encoding()) === 'utf-8') {
            $default['ellipsis'] = "\xe2\x80\xa6";
			$search['ellipsis'] = "\xe2\x80\xa6";
        }
        if($type == "blog")
		{
		$options += $default;
		}
		elseif($type == "search")
		{
		$options += $search;
		}
		else
		{
		$options += $default;
		}

        $prefix = '';
        $suffix = $options['ellipsis'];

        if ($options['html']) {
            $ellipsisLength = self::_strlen(strip_tags($options['ellipsis']), $options);

            $truncateLength = 0;
            $totalLength = 0;
            $openTags = [];
            $truncate = '';

            preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
            foreach ($tags as $tag) {
                $contentLength = self::_strlen($tag[3], $options);

                if ($truncate === '') {
                    if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/i', $tag[2])) {
                        if (preg_match('/<[\w]+[^>]*>/', $tag[0])) {
                            array_unshift($openTags, $tag[2]);
                        } elseif (preg_match('/<\/([\w]+)[^>]*>/', $tag[0], $closeTag)) {
                            $pos = array_search($closeTag[1], $openTags);
                            if ($pos !== false) {
                                array_splice($openTags, $pos, 1);
                            }
                        }
                    }

                    $prefix .= $tag[1];

                    if ($totalLength + $contentLength + $ellipsisLength > $length) {
                        $truncate = $tag[3];
                        $truncateLength = $length - $totalLength;
                    } else {
                        $prefix .= $tag[3];
                    }
                }

                $totalLength += $contentLength;
                if ($totalLength > $length) {
                    break;
                }
            }

            if ($totalLength <= $length) {
                return $text;
            }

            $text = $truncate;
            $length = $truncateLength;

            foreach ($openTags as $tag) {
                $suffix .= '</' . $tag . '>';
            }
        } else {
            if (self::_strlen($text, $options) <= $length) {
                return $text;
            }
            $ellipsisLength = self::_strlen($options['ellipsis'], $options);
        }

        $result = self::_substr($text, 0, $length - $ellipsisLength, $options);

        if (!$options['exact']) {
            if (self::_substr($text, $length - $ellipsisLength, 1, $options) !== ' ') {
                $result = self::_removeLastWord($result);
            }

            // If result is empty, then we don't need to count ellipsis in the cut.
            if (!strlen($result)) {
                $result = self::_substr($text, 0, $length, $options);
            }
        }

        return $prefix . $result . $suffix;
    }
	
	/**
     * Highlights a given phrase in a text. You can specify any expression in highlighter that
     * may include the \1 expression to include the $phrase found.
     *
     * ### Options:
     *
     * - `format` The piece of HTML with that the phrase will be highlighted
     * - `html` If true, will ignore any HTML tags, ensuring that only the correct text is highlighted
     * - `regex` A custom regex rule that is used to match words, default is '|$tag|iu'
     * - `limit` A limit, optional, defaults to -1 (none)
     *
     * @param string $text Text to search the phrase in.
     * @param string|array $phrase The phrase or phrases that will be searched.
     * @param array $options An array of HTML attributes and options.
     * @return string The highlighted text
     * @link http://book.cakephp.org/3.0/en/core-libraries/string.html#highlighting-substrings
     */
    public static function highlight($text, $phrase, array $options = [])
    {
        if (empty($phrase)) {
            return $text;
        }

        $defaults = [
            'format' => '<span class="highlight">\1</span>',
            'html' => true,
            'regex' => '|%s|iu',
            'limit' => -1,
        ];
        $options += $defaults;
        $html = $format = $ellipsis = $exact = $limit = null;
        extract($options);

        if (is_array($phrase)) {
            $replace = [];
            $with = [];

            foreach ($phrase as $key => $segment) {
                $segment = '(' . preg_quote($segment, '|') . ')';
                if ($html) {
                    $segment = "(?![^<]+>)$segment(?![^<]+>)";
                }

                $with[] = (is_array($format)) ? $format[$key] : $format;
                $replace[] = sprintf($options['regex'], $segment);
            }

            return preg_replace($replace, $with, $text, $limit);
        }

        $phrase = '(' . preg_quote($phrase, '|') . ')';
        if ($html) {
            $phrase = "(?![^<]+>)$phrase(?![^<]+>)";
        }

        return preg_replace(sprintf($options['regex'], $phrase), $format, $text, $limit);
    }
	
	/**
     * Extracts an excerpt from the text surrounding the phrase with a number of characters on each side
     * determined by radius.
     *
     * @param string $text String to search the phrase in
     * @param string $phrase Phrase that will be searched for
     * @param int $radius The amount of characters that will be returned on each side of the founded phrase
     * @param string $ellipsis Ending that will be appended
     * @return string Modified string
     * @link http://book.cakephp.org/3.0/en/core-libraries/string.html#extracting-an-excerpt
     */
    public static function excerpt($text, $phrase, $radius = 500, $ellipsis = '...')
    {
        if (empty($text) || empty($phrase)) {
            return static::truncate($text, $radius * 2, ['ellipsis' => $ellipsis]);
        }

        $append = $prepend = $ellipsis;

        $phraseLen = mb_strlen($phrase);
        $textLen = mb_strlen($text);

        $pos = mb_strpos(mb_strtolower($text), mb_strtolower($phrase));
        if ($pos === false) {
            return mb_substr($text, 0, $radius) . $ellipsis;
        }

        $startPos = $pos - $radius;
        if ($startPos <= 0) {
            $startPos = 0;
            $prepend = '';
        }

        $endPos = $pos + $phraseLen + $radius;
        if ($endPos >= $textLen) {
            $endPos = $textLen;
            $append = '';
        }

        $excerpt = mb_substr($text, $startPos, $endPos - $startPos);
        $excerpt = $prepend . $excerpt . $append;

        return $excerpt;
    }
	
	public static function truncateHTML($html, $length)
	{
		$truncatedText = substr($html, $length);
		$pos = strpos($truncatedText, ">");
		if($pos !== false)
		{
			$html = substr($html, 0,$length + $pos + 1);
		}
		else
		{
			$html = substr($html, 0,$length);
		}

		preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		$openedtags = $result[1];

		preg_match_all('#</([a-z]+)>#iU', $html, $result);
		$closedtags = $result[1];

		$len_opened = count($openedtags);

		if (count($closedtags) == $len_opened)
		{
			return $html;
		}

		$openedtags = array_reverse($openedtags);
		for ($i=0; $i < $len_opened; $i++)
		{
			if (!in_array($openedtags[$i], $closedtags))
			{
				$html .= '</'.$openedtags[$i].'>';
			}
			else
			{
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}


		return $html;
	}
	
	
}

?>