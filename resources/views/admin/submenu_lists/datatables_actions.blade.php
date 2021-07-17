{!! Form::open(['route' => ['admin.submenu-lists.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @ability('super-admin' ,'submenu-lists.show')
    <a href="{{ route('admin.submenu-lists.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'submenu-lists.edit')
    <a href="{{ route('admin.submenu-lists.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'submenu-lists.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
