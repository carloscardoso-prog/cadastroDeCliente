<?php 
	include "scriptbody/headbody.php";
 ?>

<div class="container bodyBorder">
    <div class="col-md-12 bodyAlign">
        <h1>Registro de Endereço</h1>
    </div>
    <div class="backgroundBlackTransparency">
        <div class="col-md-12 rowAlign">
            <br>
            <form id="endereco">
                <div class="row">
                    <div class="col-md-6">
                        <p>País:</p>
                        <input type="text" id="pais">
                    </div>
                    <div class="col-md-6">
                        <p>Estado:</p>
                        <input type="text" id="estado">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <p>Cidade:</p>
                        <input type="text" id="cidade">
                    </div>
                    <div class="col-md-6">
                        <p>Rua:</p>
                        <input type="text" id="rua">
                    </div>
                </div>       
                <br>     
                <div class="row">
                    <div class="col-md-6">
                        <p>Número:</p>
                        <input type="text" id="numero">
                    </div>
                    <div class="col-md-6">
                        <p>Bairro:</p>
                        <input type="text" id="bairro">
                    </div>
                </div>
                <br>
                <div class="row submitEndereco">
                    <div class="col-md-12">
                        <input type="submit" value="Cadastrar Endereço" form="endereco">
                    </div>
                </div>
           </form>
        </div>
    </div>
</div>

<?php 
	include "scriptbody/endbody.php";
 ?>