<div wire:ignore.self class="modal fade" id="modal-lg-stock">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fondo">
            <div class="modal-header">
                <h4 class="modal-title">Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div wire:loading>
                    <div class="overlay">
                        <i class="fas fa-2x fa-sync-alt"></i>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @if($view == 'create')
                                        Nuevo Stock
                                    @else
                                        Editar Stock
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" wire:click="limpiar">
                                        <i class="fas fa-boxes"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                            @include('dashboard.stock.form_stock')

                            <!-- /.card-body -->
                            </div>
                            {{--<div class="overlay-wrapper" wire:loading>
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt"></i>
                                </div>
                            </div>--}}

                        </div>

                    </div>
                </div>




            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
