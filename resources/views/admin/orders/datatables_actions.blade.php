{!! Form::open(['route' => ['admin.orders.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @ability('super-admin' ,'orders.show')
    <a href="{{ route('admin.orders.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'orders.edit')

    @php
        $hlink = route('admin.orders.edit', $id);
        if($status == 30 || $status == 40){
             $hlink =  "javascript:void(0)";
         } 
    @endphp
    <a href="{{ $hlink }}" @if($status == 30 || $status == 40) disabled="disabled" @endif class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'orders.destroy')
    @php
        $attributes = [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ];

        if($status == 30 || $status == 40){
            $attributes['disabled'] = 'disabled'; 
            $attributes['onclick'] = 'javascript:void(0)'; 
         }

    @endphp
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', $attributes) !!}
    @endability
</div>
{!! Form::close() !!}
