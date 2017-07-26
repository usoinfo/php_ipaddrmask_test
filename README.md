# php_ipaddrmask_test
PHPでIPv4/v6アドレスが、指定のアドレス＋ネットマスクにマッチするかテストする

# 動作環境など

PHP5以上

## 関数

function ipaddr_compare($srcaddr, $netaddr, $netmask)

$srcaddr テストされるIPアドレス ドット区切り/コロン区切り表記
$netaddr テストするネットワークアドレス ドット区切り/コロン区切り表記
$netmask テストするネットマスク長

 $netaddr に "netaddr/mask" 表記を渡し、$netmask に false を渡すことも可能。

## サンプル

    $srcaddr    = "192.168.1.12";
    $netaddr    = "192.168.1.0";
    $netmask    = 24;
    $r    = ipaddr_compare($srcaddr, $netaddr, $netmask);
    echo $srcaddr." compare ".$netaddr."/".$netmask." => ".($r ? "match" : "unmatch")."\n";
    
    $srcaddr    = "172.16.1.5";
    $netaddr    = "192.168.1.0/16";
    $netmask    = false;
    $r    = ipaddr_compare($srcaddr, $netaddr, $netmask);
    echo $srcaddr." compare ".$netaddr." => ".($r ? "match" : "unmatch")."\n";
    
    $srcaddr    = "25ef:91:c540:1:a00:27fa:fce1:28c";
    $netaddr    = "25ef:91:c540:1::0";
    $netmask    = 64;
    $r    = ipaddr_compare($srcaddr, $netaddr, $netmask);
    echo $srcaddr." compare ".$netaddr."/".$netmask." => ".($r ? "match" : "unmatch")."\n";
    
    $srcaddr    = "25ef:91:c540:1:a00:27fa:fce1:28c";
    $netaddr    = "25ef:91:c540:2::0";
    $netmask    = 64;
    $r    = ipaddr_compare($srcaddr, $netaddr, $netmask);
    echo $srcaddr." compare ".$netaddr."/".$netmask." => ".($r ? "match" : "unmatch")."\n";
    
    
    実行結果
    192.168.1.12 compare 192.168.1.0/24 => match
    172.16.1.5 compare 192.168.1.0/16 => unmatch
    25ef:91:c540:1:a00:27fa:fce1:28c compare 25ef:91:c540:1::0/64 => match
    25ef:91:c540:1:a00:27fa:fce1:28c compare 25ef:91:c540:2::0/64 => unmatch
