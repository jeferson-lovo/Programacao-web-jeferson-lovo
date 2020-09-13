<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Cadastro.php');
require_once(__DIR__ . '/../../dao/DaoCadastro.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoCadastro = new DaoCadastro($conn);
$cadastros= $daoCadastro->porId( $_GET['id'] );
    
if (! $cadastro)
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de produtos genericos</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" class="card p-2 my-4" method="POST">
                  <div class="input-group">
                      <input type="hidden" name="id" 
                          value="<?php echo $cadastros->getId(); ?>">                      

                          <input type="text" placeholder="Nome generico " 
                          value="<?php echo $cadastros->getNome(); ?>"
                          class="form-control" name="nome" >

                        <input type="text" placeholder="Descricao" 
                        value="<?php echo $cadastros->getDescricao(); ?>"
                            class="form-control" name="descricao" >
                
                        <input type="text" placeholder="Cidade_fab" 
                        value="<?php echo $cadastros->getCidade_fab(); ?>"
                            class="form-control" name="cidade_fab" >
                
                        <input type="number" placeholder="Valor" 
                        value="<?php echo $cadastros->getValor(); ?>"
                            class="form-control" name="valor" >
                    
                        <input type="number" placeholder="Quantidade" 
                        value="<?php echo $cadastros->getQuantidade(); ?>"
                            class="form-control" name="quantidade" >


                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary">
                              Salvar
                          </button>
                      </div>
                  </div>
              </form>
              <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

            </div>
        </div>
    </div>
<?php

    $content = ob_get_clean();
    echo html( $content );
} // else-if

?>