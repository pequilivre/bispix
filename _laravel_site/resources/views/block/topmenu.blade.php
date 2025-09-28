 <body OnLoad="document.search.input.focus();">
      <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
          <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}">Bispix</a>
              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                      <li>
                          <a style="background-color: #99CCFF; color: black;"> 
                              Coleção: <b>{{ App\Colecao::getNomeColecaoAtual() }}</b>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="{{ URL::to('/gerar-indice/passo-1') }}">Usar outra coleção</a></li>
                  </ul>
              </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </div><!-- /.navbar -->

