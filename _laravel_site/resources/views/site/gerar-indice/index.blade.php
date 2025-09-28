<?php
	$nav = array(  
		'passo-1' => 'disabled',
		'passo-2' => 'disabled',
		'passo-3' => 'disabled',
		'passo-4' => 'disabled',
		'fim' => 'disabled'
	);

	$nav[$navAtivo] = "active";
  ?>

<div class="page-header">
  <h1>Geração do Índice</h1>
</div>

<div class="container-fluid">
	<ul class="nav nav-pills">
		<li id="aba-passo-1" class="{{ $nav['passo-1'] }}">
			<a>Passo <span class="badge">1</span></a>
		</li>
	  	<li id="aba-passo-2" class="{{ $nav['passo-2'] }}">
	  		<a>Passo <span class="badge">2</span></a>
	  	</li>
	  	<li id="aba-passo-3" class="{{ $nav['passo-3'] }}">
	  		<a>Passo <span class="badge">3</span></a>
	  	</li>
	  	<li id="aba-passo-4" class="{{ $nav['passo-4'] }}">
	  		<a>Passo <span class="badge">4</span></a>
	  	</li>
	  	<li id="aba-fim" class="{{ $nav['fim'] }}">
	  		<a>Fim</a>
	  	</li>
	</ul>

	<div class="panel panel-default">
	
		<form class="form-horizontal" id="{{ $panelId }}" method="post" action="{{ $panelUrl }}">
	    	<div class="panel-body" style="height: 14em">

				@include($panelName)

			</div>
			<div class="panel-footer text-right">
				<button type="submit" class="btn btn-primary">
					{{ $panelNext }} &nbsp; <span class="glyphicon glyphicon-{{ $panelIcon }}"></span>
				</button>
			</div>

			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		</form>
	
	</div>
	
	

</div>