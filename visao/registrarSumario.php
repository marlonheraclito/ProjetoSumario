<?php
	session_start();
    include('../controle/conexao.php');
    $id = $_SESSION['id'];
    $emailProf = $_SESSION['email'];
    $tipo = $_SESSION['tipo'];

    $id_prof = "";
    $email_prof = "";
    $nome_prof = "";
    
    if($tipo == 'prof') {
    $consulta = "SELECT * FROM professor WHERE email = '$emailProf'";
    $res = mysqli_query($conexao, $consulta);
    $dadosP = $res -> fetch_array();
    $id_prof = $dadosP['id'];
    $nome_prof = $dadosP['nomeProf'];

    }


    $consulta2 = "SELECT s.conteudo, s.data, s.aula, d.nome, s.path, s.nome_ficheiro FROM sumario s, disciplina d 
    WHERE s.disciplina = d.id AND s.professor='$id_prof'";

    $res2 = mysqli_query($conexao, $consulta2);
      
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
 	<title>Registrar Sumario</title>
 </head>
 <body>
    <header>
        <h1 class="center" style="color:white";>UNIVERSIDADE</h1>
        <h2 class="center" style="color:white";>Sumário Online</h2>
    </header>
 
 	<div class="menu-lateral box-shadow">
     <nav>
			<ul>
				  <li><a href="telaPrincipal.php">HOME</a></li>

				  <li <?php if($tipo == 'aluno') { ?>
				  style="display: none;" 

					<?php } ?>><a href="registrarSumario.php">Registrar Sumario</a></li>
				
				  <li <?php if($tipo == 'aluno' || $tipo == 'prof') { ?>
				  style="display: none;" 
					<?php } ?>><a href="selecionarSumario.php">Gestão Sumario</a></li>
				
					<li <?php if($tipo !== 'admin') { ?>
				style="display:none;"
				<?php } ?>><a href="gerirUser.php">Gestão Utilizador</a></li>
			</ul>
		</nav>
    </div>

    <main>
    </br>
        
    
        <h2>Registar Sumario</h2>
                    </br>
     	<form class="form-sumario box-shadow" enctype="multipart/form-data" action="../controle/processa_inserirSumario.php" method="POST">

            <label class="center">Professor <?php echo $nome_prof;?></label>
            <input type="text"  style="display: none;" readonly name="professor" 
            value="<?php echo $id_prof; ?>">

         
            <input type="text" readonly name="data" value="<?php echo date('d/m/y')?>">

          
            <select name="nome_curso" id="nome_curso">
                <option>Curso</option>
                <?php
                    $query = "SELECT * from curso";
                    $num = mysqli_query($conexao, $query);

                    while ($n = $num -> fetch_array()) { ?>
                        <option value=<?php echo $n['id']; ?>>
                            <?php echo $n['nomeCurso']; ?>
                        </option>
                    <?php } ?>
            </select>

           <select name='nome_disciplina' id='nome_disciplina'>
               <option>Disciplina</option>
               <?php 
                    $query = "SELECT * from disciplina where professor = $id_prof";
                    $num = mysqli_query($conexao, $query);

                    while ($n = $num -> fetch_array()) { ?>
                    <option value=<?php echo $n['id'];?>>
                        <?php echo utf8_encode($n['nome']); ?>
                    </option>
                    <?php } ?> 
           </select>
        
           <select name="turma" id="turma">
                <option>Turma</option>
                    <?php
                        $query = "Select * from turma";
                        $num = mysqli_query($conexao, $query);

                        while($n = $num -> fetch_array()) { ?>
                        <option value=<?php echo $n['id']; ?>>
                            <?php echo $n['nomeTurma']; ?>
                        </option>
                        <?php } ?>
            </select>
        
        
            <select name="aula" id="aula">
                <option>Aula</option>
                <option>Aula 1</option>
                <option>Aula 2</option>
                <option>Aula 3</option>
            </select>


     		<input id="inputSumario" type="text" name="conteudo" placeholder="conteudo">	

             <label style="font-size:12px;" for="arquivos">Selecione o arquivo</label>
             <input name="arquivos" type="file">


     		<input class="btn" type="submit" name="enviar" value="Enviar">
     	</form>

            <?php
                if(isset($_SESSION['msg'])) 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>

      
         <table class="box-shadow">
				<tr>
					<th class="cor" colspan="5">SUMARIOS</th>
				</tr>
				<tr>
					<th>CONTEUDO</th>
					<th>DATA</th>
					<th>DISCIPLINA</th>
                    <th>AULA</th>
                    <th>FICHEIRO</th>
		
				</tr>
				<tr>
					<?php while ($dado = $res2 -> fetch_array()) { ?>
						<tr>	
							<td><?php echo $dado['conteudo']?></td>	
							<td><?php echo $dado['data']?></td>
                            <td><?php echo utf8_encode($dado['nome'])?></td>
                            <td><?php echo $dado['aula']?></td>
                            <td><a class='botao1' target="_black" href="<?php echo $dado['path']?>"><?php echo $dado['nome_ficheiro']?></a></td>
						</tr>
					<?php } ?>
				</tr>
			</table>
    </main>
    <footer>
		<p>Desenvolvedor Marlon Almeida</p>
	</footer>
 </body>
 </html>