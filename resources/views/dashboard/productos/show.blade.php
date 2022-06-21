<div wire:ignore.self class="modal fade" id="modal-lg-producto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fondo">
            <div class="modal-header">
                <h4 class="modal-title">Producto ID: <span class="text-bold">{{ $producto_id_show }}</span></h4>
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

                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                {{--<h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>--}}
                                <div class="col-12">
                                    <img src="{{ asset(verImg($imagen_show)) }}" class="product-image img-thumbnail" alt="Product Image">
                                </div>
                                {{--<div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                                </div>--}}
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{ $nombre_show }}</h3>
                                <label class="col-md-12"><span class="text-muted">Categoria:</span> {{ $categoria_show }}</label>

                                <hr>
                                <label class="col-md-12"><span class="text-muted">SKU:</span> {{ $sku_show }}</label>
                                <p class="col-md-12 text-justify">
                                    <span class="text-muted text-bold">Descripcion:</span>
                                    {{ $descripcion_show }}
                                </p>
                                <label class="col-md-12"><span class="text-muted">Marca:</span> {{ $marca_show }}</label>
                                <label class="col-md-12"><span class="text-muted">Modelo:</span> {{ $modelo_show }}</label>
                                <label class="col-md-12"><span class="text-muted">Referencia:</span> {{ $referencia_show }}</label>
                                <label class="col-md-12"><span class="text-muted">Unidad:</span> {{ $unidad_show }}</label>
                                <label class="col-md-12">
                                    <span class="text-muted">Existencias:</span>
                                    @if($decimales_show)
                                        Decimales
                                    @else
                                        Entero
                                    @endif
                                </label>
                                <label class="col-md-12">
                                    <span class="text-muted">Impuesto:</span>
                                    @if($impuesto_show)
                                        I.V.A. 16%
                                    @else
                                        Exento
                                    @endif
                                </label>
                                <label class="col-md-12">
                                    <span class="text-muted">Venta Individual:</span>
                                    @if($individual_show)
                                        Vendido Individualmente
                                    @else
                                        NO APLICA
                                    @endif
                                </label>

                                {{--<div class="mt-4 product-share">
                                    <a href="#" class="text-gray">
                                        <i class="fab fa-facebook-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fab fa-twitter-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fas fa-envelope-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fas fa-rss-square fa-2x"></i>
                                    </a>
                                </div>--}}

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
