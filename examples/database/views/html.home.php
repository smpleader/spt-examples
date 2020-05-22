<?php
/**
 * SPT software - Layout html
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Display a layout
 * 
 */

?>
<?php
/**
 * SPT software - Layout html
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Display a layout
 * 
 */

?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <title>SPT - Database Demo</title>
</head>
<body>
<h1>Database Demo</h1>
<p>Database info:</p>
<p><em><?php if(isset($msg)) echo $msg ?></em></p>

<form id="dbForm"  method="POST" action="<?php echo Router::url('update-dbinfo')?>">
    <table>
        <tr>
            <td><input name="database" placeholder="Database" value="<?php echo $db['database'] ?>" /></td>
            <td><input name="username" placeholder="Username" value="<?php echo $db['username'] ?>"/></td>
            <td><input name="passwd" placeholder="Password" type="password" value="<?php echo $db['passwd'] ?>"/></td>
            <td><input name="host" placeholder="Host" value="<?php echo $db['host'] ?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Update Connection" /></td>
            <td><?php if($ready){ ?>
                <input type="button" id="btnPrepare" value="Set sample data" />
                <?php } ?></td>
            <td><?php if($ready > 1){ ?>
                <input type="button" id="btnAdd" value="Insert a new record" />
                <?php } ?></td>
            <td><?php if($ready > 1){ ?>
                <input type="button" id="btnRemove" value="Delete the oldest record" />
                <?php } ?></td>
            <td> </td>
        </tr>
    </table>
</form>

<div>
    <?php if(count($list)){ ?>
    <table>
    <tr><th>ID</th><th>Title</th><th>Description</th></tr>
    <?php foreach($list as $row) { ?>
    <tr><td><?php echo $row['id']?></td><td><?php echo $row['title']?></td><td><?php echo $row['desc']?></td></tr>
    <?php } ?>
    </table>
    <?php } ?>
</div>

<script>
jQuery(document).ready(function($){
    $("#btnPrepare").click(function(){
        document.location.href = '<?php echo Router::url('prepare-db')?>';
    });
    $("#btnAdd").click(function(){
        document.location.href = '<?php echo Router::url('add-db')?>';
    });
    $("#btnRemove").click(function(){
        document.location.href = '<?php echo Router::url('remove-db')?>';
    });
})
</script>
</body>
<html>