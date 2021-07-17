{!! Form::open(['route' => ['admin.order-services.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @ability('super-admin' ,'order-services.show')
    <a href="{{ route('admin.order-services.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'order-services.edit')
    <a href="{{ route('admin.order-services.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'order-services.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
