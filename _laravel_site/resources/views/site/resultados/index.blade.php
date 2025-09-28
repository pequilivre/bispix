<div class="panel panel-primary">

    <div class="panel-heading">
        Resultados para <mark>{{ $query }}</mark>
    </div>

    <table class="table table-hover">

        @foreach ($postings as $id)
            <tr>
                <td>
                    <a href="" data-title="Documento {{ $id }}" data-route="{{ url('colecao/'.$enderecoColecao.'/'.$id) }}"
                    class="openModal" data-toggle="modal" data-target="#modalDocument">
                        Documento {{ $id }}
                    </a>    <br/>
                    <p>{{ substr( file_get_contents(base_path().'/data/colecoes/'.$enderecoColecao.'/'.$id.'.txt'), 0, 100 ) }}</p>
                </td>
            </tr>
        @endforeach

    </table>

    <div class="panel-footer text-center">
        <ul class="pagination" style="background-color: #003366;">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li style="font-color: black;"><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
</div>

@include('site.resultados.documento-modal')
