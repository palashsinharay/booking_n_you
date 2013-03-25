<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * CodeIgniter Text Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Rick Ellis
 * @link		http://www.codeigniter.com/user_guide/helpers/text_helper.html
 */

// ------------------------------------------------------------------------

function nl2p($str)
{
  return str_replace('<p></p>', '', '<p>'
        . nl2br(preg_replace('#([\r\n]\s*?[\r\n]){2,}#', '</p>$0<p>', $str))
        . '</p>');
}

/**
 * Returns a string with all spaces converted to underscores (by default), accented
 * characters converted to non-accented characters, and non word characters removed.
 *
 * @param string $string the string you want to slug
 * @param string $replacement will replace keys in map
 * @return string
 * @access public
 */
function convert_accented_characters($string, $replacement = '-')
{
  $string = strtolower($string);
  
  $foreign_characters = array(
  '/Ã¤|Ã¦|Ç½/' => 'ae',
  '/Ã¶|Å/' => 'oe',
  '/Ã¼/' => 'ue',
  '/Ã/' => 'Ae',
  '/Ã/' => 'Ue',
  '/Ã/' => 'Oe',
  '/Ã|Ã|Ã|Ã|Ã|Ã|Çº|Ä|Ä|Ä|Ç/' => 'A',
  '/Ã |Ã¡|Ã¢|Ã£|Ã¥|Ç»|Ä|Ä|Ä|Ç|Âª/' => 'a',
  '/Ã|Ä|Ä|Ä|Ä/' => 'C',
  '/Ã§|Ä|Ä|Ä|Ä/' => 'c',
  '/Ã|Ä|Ä/' => 'D',
  '/Ã°|Ä|Ä/' => 'd',
  '/Ã|Ã|Ã|Ã|Ä|Ä|Ä|Ä|Ä/' => 'E',
  '/Ã¨|Ã©|Ãª|Ã«|Ä|Ä|Ä|Ä|Ä/' => 'e',
  '/Ä|Ä|Ä |Ä¢/' => 'G',
  '/Ä|Ä|Ä¡|Ä£/' => 'g',
  '/Ä¤|Ä¦/' => 'H',
  '/Ä¥|Ä§/' => 'h',
  '/Ã|Ã|Ã|Ã|Ä¨|Äª|Ä¬|Ç|Ä®|Ä°/' => 'I',
  '/Ã¬|Ã­|Ã®|Ã¯|Ä©|Ä«|Ä­|Ç|Ä¯|Ä±/' => 'i',
  '/Ä´/' => 'J',
  '/Äµ/' => 'j',
  '/Ä¶/' => 'K',
  '/Ä·/' => 'k',
  '/Ä¹|Ä»|Ä½|Ä¿|Å/' => 'L',
  '/Äº|Ä¼|Ä¾|Å|Å/' => 'l',
  '/Ã|Å|Å|Å/' => 'N',
  '/Ã±|Å|Å|Å|Å/' => 'n',
  '/Ã|Ã|Ã|Ã|Å|Å|Ç|Å|Æ |Ã|Ç¾/' => 'O',
  '/Ã²|Ã³|Ã´|Ãµ|Å|Å|Ç|Å|Æ¡|Ã¸|Ç¿|Âº/' => 'o',
  '/Å|Å|Å/' => 'R',
  '/Å|Å|Å/' => 'r',
  '/Å|Å|Å|Å /' => 'S',
  '/Å|Å|Å|Å¡|Å¿/' => 's',
  '/Å¢|Å¤|Å¦/' => 'T',
  '/Å£|Å¥|Å§/' => 't',
  '/Ã|Ã|Ã|Å¨|Åª|Å¬|Å®|Å°|Å²|Æ¯|Ç|Ç|Ç|Ç|Ç/' => 'U',
  '/Ã¹|Ãº|Ã»|Å©|Å«|Å­|Å¯|Å±|Å³|Æ°|Ç|Ç|Ç|Ç|Ç/' => 'u',
  '/Ã|Å¸|Å¶/' => 'Y',
  '/Ã½|Ã¿|Å·/' => 'y',
  '/Å´/' => 'W',
  '/Åµ/' => 'w',
  '/Å¹|Å»|Å½/' => 'Z',
  '/Åº|Å¼|Å¾/' => 'z',
  '/Ã|Ç¼/' => 'AE',
  '/Ã/'=> 'ss',
  '/Ä²/' => 'IJ',
  '/Ä³/' => 'ij',
  '/Å/' => 'OE',
  '/Æ/' => 'f'
  );
  
  if (is_array($replacement))
  {
    $map = $replacement;
    $replacement = '_';
  }
  
  $quotedReplacement = preg_quote($replacement, '/');
  
  $merge = array(
                '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
                '/\\s+/' => $replacement,
                sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
                );
  
  $map = $foreign_characters + $merge;
  return preg_replace(array_keys($map), array_values($map), $string);
}
?>