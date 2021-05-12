<a href="{{ route('admin.stock.warehouse.edit-bin', $bin->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								{!! Form::open(['route' => ['admin.stock.warehouse.delete-bin', $bin->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Delete', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}