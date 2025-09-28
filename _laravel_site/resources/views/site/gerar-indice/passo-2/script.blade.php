    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ url('assets/bs/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/offcanvas.js') }}"></script>
    
    <script>
    	$(document).ready(function () {
			setInterval(function(){
                $('.toklog').load( '{{ url('/toklog') }}' );
                var x = $('.toklog').text();
                var valores = x.split('-');
                var atual = valores[0];
                var total = valores[1];
                var nomeDocumento = valores[2];
                var y = '\
                    <div class="progress"> \
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' + 
                        atual + '" aria-valuemin="0" aria-valuemax="' + (total - 1) + '" style="width: ' + ((atual-1)/total)*100 + '%"> \
                        <span class="sr-only">40% Complete (success)</span> \
                      </div> \
                    </div>';
                if(x != ""){
                    $('.tokenizer-loader-msg').text('Quebrando o texto do documento ' + nomeDocumento + '...');
                    $('.tokenizer-loader').html(y);
                }
    		},1000);
		});
    </script>  