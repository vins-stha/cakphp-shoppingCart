<?php
$a =
array(

  'languages' =>

  array (

  76 =>

 array (       'id' => '76',       'tag' => 'Deutsch',     ),   ),    'targets' =>
 array (     81 =>
 array (       'id' => '81',       'tag' => 'Deutschland',     ),   ),    'tags' =>
 array (     7866 =>
 array (       'id' => '7866',       'tag' => 'automobile',     ),     17800 =>
 array (       'id' => '17800',       'tag' => 'seat leon',     ),     17801 =>
 array (       'id' => '17801',       'tag' => 'seat leon cupra',     ),   ),
'inactiveTags' =>
 array (     195 =>
 array (       'id' => '195',       'tag' => 'auto',     ),     17804 =>
 array (       'id' => '17804',       'tag' => 'coupès',     ),     17805 =>
 array (       'id' => '17805',       'tag' => 'fahrdynamik',     ),     901 =>
 array (       'id' => '901',       'tag' => 'fahrzeuge',     ),     17802 =>
 array (       'id' => '17802',       'tag' => 'günstige neuwagen',     ),     1991 =>
 array (       'id' => '1991',       'tag' => 'motorsport',     ),     2154 =>
 array (       'id' => '2154',       'tag' => 'neuwagen',     ),     10660 =>
 array (       'id' => '10660',       'tag' => 'seat',     ),     17803 =>
 array (       'id' => '17803',       'tag' => 'sportliche ausstrahlung',     ),     74 =>
 array (       'id' => '74',       'tag' => 'web 2.0',     ),   ),    'categories' =>
 array (     16082 =>
 array (       'id' => '16082',       'tag' => 'Auto & Motorrad',     ),     51 =>
 array (       'id' => '51',       'tag' => 'Blogosphäre',     ),     66 =>
 array (       'id' => '66',       'tag' => 'Neues & Trends',     ),     68 =>
 array (       'id' => '68',       'tag' => 'Privat',     ),   ), );

 printarr($a);
 printarr($a['languages'][76]['tag']);
 printarr($a['targets'][81]['id']);
 function printarr($in){
 echo "\n";
 print_r($in);
 echo "\n";
 }
