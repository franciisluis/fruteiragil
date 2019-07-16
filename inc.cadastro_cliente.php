<form action = "acao.cliente.php" method="POST" enctype="multipart/form-data">
	<div class="container">
		<table class="table table-condensed table-striped table-bordered table-hover">
			<input type="hidden" name="acao" value="insert">
				<?php
					if((isset($_GET['id_cliente'])) and !empty($_GET['id_cliente'])){
						$id_cliente =  $_GET['id_cliente'];
						$query = 'SELECT * FROM cliente WHERE id_cliente='.$id_cliente;
						$retorno = mysql_query($query,$link);
						if(mysql_num_rows($retorno)>0){
							$linha=mysql_fetch_assoc($retorno);
							$nome=$linha['nome_cliente'];
							$telefone=$linha['telefone'];
							$endereco=$linha['endereco'];
							$email=$linha['email'];
							$cpf=$linha['cpf'];
							$imagem_cliente = $linha['imagem_cliente'];
							$acao="update";
						}else{
							$nome="";
							$telefone="";
							$endereco="";
							$email="";
							$cpf="";
							$acao="insert";
						}
					}else{
						$nome="";
						$telefone="";
						$endereco="";
						$email="";
						$cpf="";
						$acao="insert";
					}
				?>


				<?php
					if ($acao == 'update') {
						echo '<input type="hidden" name="id_cliente" value="'.$id_cliente.'">';
						echo '<input type="hidden" name="acao" value="update">';
					} else {
						echo '<input type="hidden" name="acao" value="insert">';	
					}
				?>
			<tr>
				<td align="center"> NOME: </td>
				<?php
					echo '<td align="center"><input type="text" name="nome_cliente" value=" '.$nome.'"</td>';
				?>
			</tr>
			<tr>
				<td align="center"> TELEFONE: </td>
				<?php
					echo '<td align="center"><input type="text" name="telefone" value=" '.$telefone.'"</td>';
				?>
			</tr>
			<td align="center"> ENDEREÇO: </td>
			<?php
				echo '<td align="center"><input type="text" name="endereco" value=" '.$endereco.'"</td>';
			?>
			<tr>
				<td align="center"> E-MAIL: </td>
				<?php
					echo '<td align="center"><input type="text" name="email" value=" '.$email.'"</td>';
				?>
			</tr>
			<tr>
				<td align="center"> CPF: </td>
				<?php
					echo '<td align="center"><input type="text" name="cpf" value=" '.$cpf.'"</td>';
				?>
			</tr>
			<tr>
			<td align="center"> Imagem </td>
			<td align="center"><input type="file" name="imagem_cliente"></td>
			<?php
				if($acao == 'update') {
				echo '<img src="img/'.$imagem_cliente.'" width="60" height="80">';
				}
			?>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="botao" value="Enviar"></td>
			</tr>
		</table>
	</div>
</form>

<div class="container">
	<h2> Lista Cliente</h2>
		<table class="table table-condensed table-striped table-bordered table-hover">

		<tr>

			<td align="center"> ID </td>
			<td align="center"> Nome </td>
			<td align="center"> Email </td>
			<td align="center"> Cpf </td>
			<td align="center"> Telefone </td>
			<td align="center"> Endereco </td>
			<td align="center"> Imagem </td>
			<td align="center"> Acao </td>
		</tr>

		<?php
			$query = 'SELECT id_cliente, nome_cliente,email,cpf,telefone,endereco,imagem_cliente FROM cliente ORDER BY nome_cliente';

			$res = mysql_query($query,$link);
			//echo $res;

			$qtd=mysql_num_rows($res); //numero de linhas
			//echo $qtd;

			if($qtd>0){
				while($linha=mysql_fetch_assoc($res)){
					echo '<tr>';
					echo '<td align="center">'. $linha['id_cliente'].'</td>';
					echo '<td align="center">'. $linha['nome_cliente'].'</td>';
					echo '<td align="center">'. $linha['email'].'</td>';
					echo '<td align="center">'. $linha['cpf'].'</td>';
					echo '<td align="center">'. $linha['telefone'].'</td>';
					echo '<td align="center">'. $linha['endereco'].'</td>';
					echo '<td align="center"><img src="img/'.$linha['imagem_cliente'].'" width="60" height="60"></td>';


					echo '<td>
							<a href="index.php?pg=cadastro_cliente&id_cliente='.$linha['id_cliente'].'"> Editar </a> ||
							<a href="acao.cliente.php?acao=delete&id_cliente='.$linha['id_cliente'].'"> Excluir </a>
							</td>';
				}

			}else{

				echo '<tr>
						<td collspan="3" > Nenhum registro para listrar </td>
					</tr>';

			}	
		?>
	</table>
</div>
