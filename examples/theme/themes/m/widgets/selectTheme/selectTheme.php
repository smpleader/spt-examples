<?php
/**
 * SPT software - Widget select theme
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to show a selectbox
 * 
 */

defined( 'SPT_PATH' ) or die('');


Theme::addInline('js', '
$("#chooseTheme").change(function(){
    document.location.href="?theme="+$(this).val();
})');

$arr = [
    'b4' => 'Bootstrap4',
    'm' => 'Materialize',
    'f6' => 'Foundation6',
    'w3' => 'W3.css',
];

?>
<div class="input-field">
    <select id="chooseTheme" class="browser-default ">
    <?php foreach($arr as $k => $v) {
        echo '<option value="'.$k.'" ' ;
        echo $data == $k ? 'selected="selected"' : '';
        echo ' >'. $v. '</option>';
    } ?>
    </select>
</div>