{!! Form::open(['route' => ['admin.banner-managements.destroy', $id], 'method' => 'delete']) !!}
<div style="width: 150px;" class='btn-group'>

    <a href="{{ url('admin/banner-active').'/'. $id}}" class='btn btn-default btn-xs'>
        @if($status)
            <i class="fa fa-ban"></i>
        @else
            <i class="fa fa-check"></i>
        @endif
    </a>

    @ability('super-admin' ,'banner-managements.show')
    <a href="{{ route('admin.banner-managements.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'banner-managements.edit')
    <a href="{{ route('admin.banner-managements.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability

    @ability('super-admin' ,'banner-managements.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
