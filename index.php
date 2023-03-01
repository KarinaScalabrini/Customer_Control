<?php
//session
session_start();
if(isset($_SESSION['mensagem'])):?>

<script>
    window.onload = function(){
        M.toast({html:  '<?php echo $_SESSION['mensagem']; ?>'});
    };
</script>
    <?php
endif;    
session_unset();
// conexao
include_once 'php-action/db_connect.php';

//header 
include_once 'includes/header.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class=light>Clientes</h3>
        <table class="striped">
            <thead>
                <tr>
                    <th>NOME:</th>
                    <th>SOBRENOME:</th>
                    <th>EMAIL:</th>
                    <th>IDADE:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM clientes";
                $resultado = mysqli_query($connect, $sql);
                while($dados = mysqli_fetch_array($resultado)):
                ?>
                <tr>
                    <td><?php echo $dados['nome']; ?></td>
                    <td><?php echo $dados['sobrenome']; ?></td>
                    <td><?php echo $dados['email']; ?></td>
                    <td><?php echo $dados['idade']; ?></td>
                    <td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
                    <td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

                    <div id="modal<?php echo $dados['id']; ?>" class="modal">
                        <div class="modal-content">
                            <h5>Tem certeza que deseja excluir?</h5>
                        </div>
                        <div class="modalfooter">
                            <form action="php-action/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                <button type="submit" name="btn-deletar" class="btn red">Sim</button>
                            </form>
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
                        </div>
                    </div>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="adicionar.php" class="btn">Adicionar Cliente</a>
    </div>
</div>

<?php
//fotter
include_once 'includes/footer.php';
?>