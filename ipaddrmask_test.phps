<?php

/**
 * IPv4/v6アドレスマッチテスト
 *
 * IPv4/v6アドレスが、指定のアドレス＋ネットマスクにマッチするかテストする
 *
 * @author usoinfo http://blog.usoinfo.info/
 * @version 1.0
 *
 */

	function ipaddr_mask($src, $mask)
	{
		$iarr	= str_split($src);
		$marr	= str_split($mask);
		$ret	= false;
		for($i=0;$i<count($iarr);$i++){
			$ret	.= $iarr[$i] & $marr[$i];
		}
		return $ret;
	}

	function ipaddr_compare($srcaddr, $netaddr, $netmask)
	{
		if( !$netmask && ($pos = strpos($netaddr,"/")) !== FALSE ){
			$netmask	= intval( substr($netaddr, $pos+1) );
			$netaddr	= substr($netaddr, 0, $pos);
		}
		
		$addr	= inet_pton($srcaddr);
		$comp	= inet_pton($netaddr);

		$len	= strlen($addr)*8;
		if($netmask > $len) $netmask = $len;

		$mask  = str_repeat('f', $netmask>>2);
		switch($netmask & 3){
		case 3: $mask .= 'e'; break;
		case 2: $mask .= 'c'; break;
		case 1: $mask .= '8'; break;
		}
		$mask = pack('H*', str_pad($mask, $len>>2, '0') );
		
		return ipaddr_mask($addr, $mask) == ipaddr_mask($comp, $mask);
	}


?>