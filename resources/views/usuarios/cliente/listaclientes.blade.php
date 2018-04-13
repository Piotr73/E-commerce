
<table class="table table-striped">
    <thead>
    <tr>
        <th width="31%">Datos Personales</th>
        <th width="15%">DNI</th>
        <th width="15%">Tipo</th>
        <th width="15%">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @if(count($clientes)>0)
        @foreach($clientes as $cliente)
            <tr class="id{{$cliente->ID_Persona}}">
                <td width="31%" class="text-left">{{$cliente->Datos}}</td>
                <td width="15%" class="text-left">{{$cliente->DNI}}</td>
                <td width="15%" class="text-left">{{$cliente->desc}}</td>
                <td width="20%" class="text-left">
                    <a title="Desactivar Cliente" alt="Desactivar Cliente" href="javascript:EliminarCliente('{{$cliente->ID_Persona}}','{{$cliente->Datos}}')" class="btn  btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4" class="text-left">No se encontraron resultados</td>
        </tr>
    @endif
    </tbody>
</table>
{!! $clientes->links() !!}