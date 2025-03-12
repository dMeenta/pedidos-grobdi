<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Datos del pedido</h2>
        </div>
        <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Nro del Pedido:</strong> <br/>
                {{ $pedido->orderId }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>cliente:</strong> <br/>
                {{ $pedido->customerName }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Fecha Entrega:</strong> <br/>
                {{ $pedido->deliveryDate }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Detalles:</strong> <br/>
                <span  style="white-space: pre-line; white-space: pre-wrap">{{ $pedido->orderDescription}}</span> 
            </div>
        </div>
    </div>
    </div>
</div>