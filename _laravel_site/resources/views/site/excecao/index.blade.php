        <div class="container col-md-6 col-md-offset-3">
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-12 col-sm-12">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
                            Toggle nav
                        </button>
                    </p>
                </div><!--/span-->
            </div><!--/row-->

            {{ $mensagem }}

            @include('block.footer')

        </div><!--/.container-->

        @include($scriptName)

    </body>
</html>