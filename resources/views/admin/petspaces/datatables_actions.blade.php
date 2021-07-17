{!! Form::open(['route' => ['admin.petspaces.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @if(!$is_approved)
    <a href="{{ url('admin/petspace-approved/').'/'. $id}}" class='btn btn-default btn-xs'>
        <i class="fa fa-check"></i>
    </a>
    @endif
    @ability('super-admin' ,'petspaces.show')
    <a href="{{ route('admin.petspaces.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'petspaces.edit')
    <a href="{{ route('admin.petspaces.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'petspaces.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
