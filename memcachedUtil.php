<html>
<body>
<?php

$keys = $memcached->getAllKeys();

if( isset($_REQUEST['key']))  {
    echo 'Chave => ' .$_REQUEST['key'];
    $array = $memcached->get($_REQUEST['key']);
    echo '<table>';
    foreach ($array as $key => $value) {
        if( is_array($value) ) {
            foreach ($value as $kk => $vv) {
                echo '<tr><td>'.$kk .'</td><td>' .$vv.'</td></tr>';
            }
        } else {
            echo '<tr><td>'.$key .'</td><td>'.$value.'</td></tr>';
        }
    }
    echo '</table>';
} else if( isset($_REQUEST['stat'])) {
    $array = $memcached->getStats();
    echo '<strong>Estatísticas</strong>';
    foreach ($array as $key => $value) {
        if( is_array($value) ) {
            foreach ($value as $kk => $vv) {
                echo '<br>'.$kk .' - ' .$vv;
            }
        } else {
            echo $key .' - ' .$value;
        }
    }
} else if( isset($_REQUEST['exc'])) {
    $memcached->delete($_REQUEST['exc']);
}

?>

<hr>
<a href="memcachedUtil.php?stat=S">Estatísticas</a>
<hr>
        
<table border=1 width="100%">
<tr><td width="5%">#</td><td width="20%">Chave</td><td width="70%">Valor</td><td width="5%">Ação</td></tr>
<?php
$keys = $memcached->getAllKeys();
$i = 0;
foreach ($keys as $key => $value) {
    echo '<tr><td>'.++$i.'</td><td><a href="memcachedUtil.php?key='.$value.'">'.$value.'</a></td>';
    $a = $memcached->get($value);
    echo '<td>';
    foreach ($a as $k => $v) {
        if( is_array($v) ) {
            $valor = '';
            foreach ($v as $vv => $vvv) {
                $valor .= $vvv.'; ';
            }
            echo wordwrap($valor,60,"<br />\n");
        } else {
            echo '***'.$v;
        }
    }
    echo '</td><td><a href="memcachedUtil.php?exc='.$value.'">[Excluir]</a></td></tr>';
}
?>

</table>

</body>
</html>
