{!! Form::open(['route' => ['admin.petspace-technicians.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{--@if(!$is_approved)--}}
        {{--<a href="{{ url('admin/tech-approved/').'/'. $id}}" class='btn btn-default btn-xs'>--}}
            {{--<i class="fa fa-check"></i>--}}
        {{--</a>--}}
    {{--@endif--}}
    @ability('super-admin' ,'petspace-technicians.show')
    <a href="{{ route('admin.petspace-technicians.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'petspace-technicians.edit')
    <a href="{{ route('admin.petspace-technicians.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'petspace-technicians.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
