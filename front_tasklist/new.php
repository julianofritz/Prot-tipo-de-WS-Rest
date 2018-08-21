<?php 
$action ='http://slim.com.br/tasklist/new';
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
            <h3 class="panel-title">Adicionar Task</h3>
          </div>
          <div class="panel-body">
        	<form action="<?php echo $action; ?>" method="post">
        	 	<div class="form-group">
                    <label for="tsk_title">Titulo:</label>
                    <input type="text"name="tsk_title" class="form-control" id="tsk_title" placeholder="Titulo Task" />
              	</div>
        		
        		<div class="form-group">
        			<label for="tks_id">Status:</label>
            		<select id="tks_id" name='tks_id'>
            			<option value='1' selected>Ativo</option>
            			<option value='2'>Inativo</option>
            		</select>
        		</div>
        	
    			<button type="submit" class="btn btn-default">Add</button>
        	</form>
        	
            <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Adicionar Descrição
            </a>
            <div class="collapse" id="collapseExample">
              <div class="well">
            	<p>Opção não disponível</p>
              </div>
            </div>
          </div>
        </div>
	</body>

</html>