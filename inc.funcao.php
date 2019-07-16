<?php
	//categoria
	function insere($link,$nome){
		echo 'Inserir registro';
		$query = 'INSERT INTO categoria(nome_categoria) VALUES("'.$nome.'")';
			
		mysql_query($query,$link) or die(mysql_error());
	}


	function atualiza($link,$nome){
		(isset($_POST['id_categoria']) and !empty($_POST['id_categoria'])) ? $id_categoria = $_POST['id_categoria'] : $erro = TRUE;

		$query = 'UPDATE categoria SET nome_categoria = "'.$nome.'" WHERE id_categoria = '.$id_categoria;

		mysql_query($query, $link) or die(mysql_error());

	}

	function delete($link,$nome){
		(isset($_GET['id_categoria'])) and !empty($_GET['id_categoria']) ? $id_categoria= $_GET['id_categoria'] : $erro = TRUE; 
		$query= 'DELETE FROM categoria WHERE id_categoria = '.$id_categoria;

		mysql_query($query,$link) or die (mysql_error());
	}


	function busca($link){
		$query = 'SELECT id_categoria, nome_categoria FROM categoria ORDER BY nome_categoria';
		$res = mysql_query($query,$link);
			
		$qtd=mysql_num_rows($res); //numero de linhas
		if($qtd>0){
			while($linha=mysql_fetch_assoc($res)){
				$coisas[] =$linha;
			}
		}else{
			return -1;
		}
		return $coisas;
	}

	function imprime($coisas){
		
			foreach ($coisas as $linha) {
				echo '<tr>';
				echo '<td align="center">'. $linha['id_categoria'].'</td>';
				echo '<td align="center">'. $linha['nome_categoria'].'</td>';
				echo '<td align="center">
						<a href="index.php?pg=cadastro_categoria&id_categoria='.$linha['id_categoria'].'"> Editar </a> ||
						<a href="acao.categoria.php?acao=delete&id_categoria='.$linha['id_categoria'].'"> Excluir </a>
						</td>';
			}
		}

?>