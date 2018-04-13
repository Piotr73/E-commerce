<table  class="table table-hover table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="text-left">Código</th>
        <th class="text-left">Rol</th>
        <th class="text-left">Nombre</th>
        <th class="text-left">Email</th>
        <th class="text-left">Acción</th>
    </tr>
    </thead>
    <tbody>
    @if(count($usuarios)>0)
        @foreach($usuarios as $usuario)
        <tr role="row" class="odd">
            <td class="text-left">{{ $usuario->id }}</td>
            <td class="text-left"><span class="label label-default">
             @foreach($usuario->getRoles() as $roles)
                        {{  $roles.","  }}
                    @endforeach
                    -</span>
            </td>
            <td class="mailbox-messages mailbox-name text-left"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $usuario->name  }}</a></td>
            <td class="text-left">{{ $usuario->email }}</td>
            <td class="text-left">
                <a class="btn  btn-default btn-sm" href="javascript:EditarUsuario({{$usuario->id}})"><i class="fa fa-fw fa-edit"></i></a>
                <a class="btn  btn-danger btn-sm"  href="javascript:EliminarUsuario({{$usuario->id }},{{Auth::user()->id}});"><i class="fa fa-fw fa-remove"></i></a>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-left">No se encontraron resultados</td>
        </tr>
    @endif
    </tbody>
</table>
{!! $usuarios->links() !!}
