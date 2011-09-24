#!/usr/bin/php
<?php

/**
 * Hipster Latin
 *
 * Retrieves text from the HipsterJesus API (http://hipsterjesus.com/).
 *
 * STDIN should be an int between 1 and 99. This determines the number of paragraphs returned to Coda.
 * STDIN is specified as a selection in the document.
 *
 * @author     Seth Lilly <seth@sethlilly.com>
 * @copyright  2011 Seth Lilly
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL v3
 * @version    0.1
 * @link       http://sethlilly.com
 */

$handle = fopen("php://stdin","r");

$in = fgets($handle);

fclose($handle);

if (is_numeric($in) && $in > 0 && $in < 100) {
	$count = $in;
} else {
	$count = 1;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://hipsterjesus.com/api/?type=hipster-latin&paras=".$count);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($ch);
error_log($res,0);
curl_close($ch);

$ret = json_decode($res);

echo $ret->{'text'};

?>