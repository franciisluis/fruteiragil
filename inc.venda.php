<form action="acao.venda.php" method="POST">

	<div class="container">
		<table class="table table-condensed table-striped table-bordered table-hover">
		<input type="hidden" name="acao" value="insert">

		<?php
				if(isset($_GET['id_venda']) and !empty($_GET['id_venda'])){
					$id_venda = $_GET['id_venda'];
					$query = 'SELECT * FROM venda WHERE id_venda='.$id_venda;
					$retorno = mysql_query($query,$link);
					if(mysql_num_rows($retorno)>0){
						$linha=mysql_fetch_assoc($retorno);
						$id_cliente=$linha['id_cliente'];
						$data=$linha['data'];
						$acao="update";
					}else{
						$id_cliente="";
						$data="";
						$acao="insert";
					}
				}else{
					$id_cliente="";
					$data="";
					$acao="insert";
				}
		?>

		<?php
			if ($acao == 'update') {
				echo '<input type="hidden" name="id_venda" value="'.$id_venda.'">';
				echo '<input type="hidden" name="acao" value="update">';
			} else {
				echo '<input type="hidden" name="acao" value="insert">';	
			}
		?>
			<tr>
				<td colspan="2" align="center">CADASTRAR VENDA</td>
			</tr>
			<tr>
				<td align="center">CLIENTE</td>
				<td align="center">
				<select name="id_cliente">
				<?php

					$query = 'SELECT id_cliente, nome_cliente FROM cliente ORDER BY nome_cliente';

					$res = mysql_query($query,$link);

					$qtd=mysql_num_rows($res); //numero de linhas

					if($qtd>0){
						while($linha=mysql_fetch_assoc($res)){
							if($linha['id_cliente']==$id_cliente){
								echo '<option selected="'.$id_cliente.'" value= "'.$id_cliente.'">'.$linha['nome_cliente'].'</option>';
							}else{
								echo '<option value= "'.$linha['id_cliente'].'">'.$linha['nome_cliente'].'</option>';
							}
						}
					}
				?>
				
				</select>
				</td>
			</tr>
				
			<tr>
				<td align="center">DATA</td>
				<?php
					echo '<td align="center"><input type="text" name="data_venda" value=" '.$data.'"</td>';
				?>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="botao" value="ENVIAR"></td>
			</tr>
		</table>
</form>

<div class="container">
	<h2> Lista Vendas</h2>
		<table class="table table-condensed table-striped table-bordered table-hover">

		<tr>

			<td align="center"> ID </td>
			<td align="center"> Cliente </td>
			<td align="center"> Data</td>
			<td align="center"> Acao </td>
		</tr>

		<?php
			$query = 'SELECT id_venda,data,nome_cliente FROM venda INNER JOIN cliente ON venda.id_cliente= cliente.id_cliente ORDER BY id_venda' ;

			$res = mysql_query($query,$link);
			//echo $res;

			$qtd=mysql_num_rows($res); //numero de linhas
			//echo $qtd;

			if($qtd>0){
				while($linha=mysql_fetch_assoc($res)){
					echo '<tr>';
					echo '<td align="center">'. $linha['id_venda'].'</td>';
					echo '<td align="center">'. $linha['nome_cliente'].'</td>';
					echo '<td align="center">'. $linha['data'].'</td>';

					echo '<td align="center">
							<a href="index.php?pg=venda&id_venda='.$linha['id_venda'].'"> Editar </a> ||
							<a href="acao.venda.php?acao=delete&id_venda='.$linha['id_venda'].'"> Excluir </a>
							</td>';
				}
			}else{

				echo '<tr>
						<td collspan="3" > Nenhum registro para listrar </td>
					</tr>';

			}	
	?>

	</table> 