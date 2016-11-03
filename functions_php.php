<?php
function foo($arg_1, $arg_2, /* ..., */ $arg_n)
{
    echo "Example function.\n";
    return $retval;
}

function safe_read($text)
{
	return mysql_real_escape_string(htmlspecialchars($text));
}

function safe_write_textarea($text)
{
	$text=str_replace("\\r\\n","\n",$text);
	$text=str_replace('\\\\',"\\",$text);
	$text=str_replace('\\\\',"\\",$text);
	$text=str_replace("\\'","'",$text);
	$text= htmlspecialchars_decode($text);
	return $text;
}

function safe_write_html($text)
{
	$text=str_replace("\\r\\n","<br>",$text);
	$text=str_replace("\\\\","\\",$text);
	$text=str_replace("\\\\","\\",$text);
	$text=str_replace("\\'","'",$text);
	$text=str_replace("&amp;lt;br&amp;gt;","<br>",$text); # allow <br>
	$text=str_replace("&amp;lt;s&amp;gt;","<sub>",$text);  # allow <s>=<sub>
	$text=str_replace("&amp;lt;/s&amp;gt;","</sub>",$text); # allow </s>=</sub>
	$text=str_replace("&amp;lt;b&amp;gt;","<b>",$text); # allow <b>
	$text=str_replace("&amp;lt;/b&amp;gt;","</b>",$text); # allow </b>
	$text=str_replace("{|-","<Table border=0.1> <TR><TD style='background-color:#FFF29D'>",$text);
	$text=str_replace("|}","</TR></Table>",$text);	
	$text=str_replace("|-","</TD></TR><TR><TD style='background-color:#FFF29D'>",$text);	
	$text=str_replace("|","</TD><TD style='background-color:#EEEEEE'>",$text);
	
	
	$text= htmlspecialchars_decode($text);
	htmlspecialchars_decode($text);
	return $text;
}
# enlever les caracteres speciaux pour la recherche... Pas facile!


if ( !function_exists('htmlspecialchars_decode') )
{
    function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
}



?>

	
