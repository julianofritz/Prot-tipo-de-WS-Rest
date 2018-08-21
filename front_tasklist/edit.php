<?php 

$id = $_GET['id'];
$url ='http://slim.com.br/tasklist/edit/'.$id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$result = curl_exec($ch);

curl_close($ch);

$task = json_decode($result);

$action ='http://slim.com.br/tasklist/edit/'.$id;

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
        <div class="panel panel-default col-md-6">
          <div class="panel-heading">
            <h3 class="panel-title">Editar Task</h3>
          </div>
          <div class="panel-body">
        	<form action="<?php echo $action; ?>" method="post">
        	 	<div class="form-group">
                    <label for="tsk_title">Titulo:</label>
                    <input type="text" class="form-control" id="tsk_title" name="tsk_title" placeholder="Titulo Task" value="<?php echo $task->tsk_title?>">
              	</div>
        		
        		<div class="form-group">
        			<label for="tks_id">Status:</label>
            		<select id="tks_id" name='tks_id'>
            			<option value='1' <?php $task->tks_id == 1 ?'select="selected"': '' ?>>Ativo</option>
            			<option value='2' <?php $task->tks_id == 2 ?'select="selected"': '' ?>>Inativo</option>
            		</select>
        		</div>
        	
    			<button type="submit" class="btn btn-default">Editar</button>
        	</form>
        	
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Adicionar Descrição
            </a>
            <div class="collapse" id="collapseExample">
              <div class="well">
                <input type="text" name="tkd_description" id="tkd_description" />
                <button type="button" class="btn btn-success">Add Descrição</button>
              </div>
            </div>
          </div>
        </div>
    </body>

</html>