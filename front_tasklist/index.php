<?php 
$url  = 'http://slim.com.br/tasklist/list';
$ch   = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$result = curl_exec($ch);

curl_close($ch);

$tasklist = json_decode($result);

?>
<html>
	<header>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</header>
	
	<body>
		<div class="row col-md-5">
    		<table class="table table-hover">
    			<thead>
    				<tr>
    					<th>Código</th>
    					<th>Nome</th>
    					<th>Status</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			
    			<tbody>
    				<?php foreach ($tasklist as $task): ?>
    				<tr>
    					<td><?php echo $task->tsk_id; ?></td>
    					<td><?php echo $task->tsk_title; ?></td>
    					<td><?php echo $task->tks_name; ?></td>
    					<td><a class="btn btn-success" href="edit.php?id=<?php echo $task->tsk_id; ?>" role="button">Editar</a></td>
    				</tr>
    				<?php endforeach; ?>
    			</tbody>
      
            </table>
        </div>
	</body>
</html>