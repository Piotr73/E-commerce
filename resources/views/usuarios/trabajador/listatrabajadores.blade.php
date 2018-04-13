
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
    @if(count($trabajadores)>0)
        @foreach($trabajadores as $trabajador)
            <tr class="id{{$trabajador->ID_Persona}}">
                <td width="31%" class="text-left">{{$trabajador->Datos}}</td>
                <td width="15%" class="text-left">{{$trabajador->DNI}}</td>
                <td width="15%" class="text-left">{{$trabajador->desc}}</td>
                <td width="20%" class="text-left">
                    <a title="Editar Trabajador" alt="Editar Personal" href="javascript:EditarPersonal({{$trabajador->ID_Persona}})" class="btn  btn-default btn-sm"><i class="fa fa-fw fa-edit"></i></a>
                    <a title="Eliminar Trabajador" alt="Eliminar Personal" href="javascript:EliminarPersonal('{{$trabajador->ID_Persona}}','{{$trabajador->Datos}}')" class="btn  btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>
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
{!! $trabajadores->links() !!}