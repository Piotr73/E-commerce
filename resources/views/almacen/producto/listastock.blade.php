
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="">Marca</th>
            <th width="">Artículo</th>
            <th width="">Stock Actual</th>
        </tr>
    </thead>
    <tbody>
    @if(count($stocks)>0)
        @foreach($stocks as $stock)
            <tr class="id{{$stock->ID_Producto}}">
                <td class="text-left">{{$stock->Marca}}</td>
                <td class="text-left">{{$stock->Articulo}}</td>
                <td class="text-left">{{$stock->Stock}}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3">No se encontraron resultados</td>
        </tr>
    @endif
    </tbody>
</table>
{!! $stocks->links() !!}