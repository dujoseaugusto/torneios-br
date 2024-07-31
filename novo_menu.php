        <nav class="navbar navbar-default">
            <div class="container">
                    
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Inicial <span class="sr-only">(current)</span></a></li>
                            <li><a href="diretoria.php">Quem somos</a></li>
                            <!--<li><a href="agenda.php">Agenda</a></li>-->
                             <?php
                                if(insc_aberta()){
                                    echo "<li><a href='inscritos.php'>Ver Inscritos</a></li>"; 
                                }
                            ?>
                            <li><a href="resultados.php">Resultados</a></li>                            
                            <li><a href="resultados_ranking.php">Ranking</a></li>
                            <li><a href="calendario.php">Calendário</a></li>
                            <li><a href="fotos.php">Fotos</a></li>
                            <!--<li><a href="farmacia.php">Farmácia</a></li>-->
                            <li><a href="videos.php">Vídeos</a></li>
                            <li><a href="contato.php">Contato</a></li>
                            <!--<form name="pesq" class="navbar-form navbar-right" action="pesquisa.php" method="post">
                                <div class="form-group">
                                    <input type="text" name="pesquisa" class="form-control" style="font-size: 0.9em!important;" placeholder="Digite sua busca...">

                                </div>

                                <input type="submit" class="btn btn-default" style="font-size: 0.8em!important;">


                            </form>-->
                        </ul>
                    </div>
                </div>
                
        </nav>
