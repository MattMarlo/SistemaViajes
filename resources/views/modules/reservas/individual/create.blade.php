@extends('layouts.app')

@section('title', 'Nueva Reserva Individual')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="h3 mb-1">Nueva reserva individual</h2>
            <p class="text-muted mb-4">Completa los datos del viaje</p>

            <form action="{{ route('reservas.individual.store') }}" method="POST">
                @csrf
                
                <div class="card card-custom p-4">
                    <div class="mb-4">
                        <h6 class="text-uppercase small fw-bold text-primary mb-3">Datos del titular</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">CLIENTE</label>
                                <select name="cliente_id" class="form-select shadow-none" required>
                                    <option value="">Seleccionar cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">AGENTE ASIGNADO</label>
                                <select name="user_id" class="form-select shadow-none">
                                    <option value="{{ auth()->id() }}">{{ auth()->user()->name ?? 'Administrador' }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-uppercase small fw-bold text-primary mb-3">Datos del viaje</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">DESTINO</label>
                                <select name="destino_id" class="form-select shadow-none" required>
                                    <option value="">Seleccionar destino...</option>
                                    @foreach($destinos as $destino)
                                        <option value="{{ $destino->id }}">{{ $destino->etiqueta }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">FECHA RESERVA</label>
                                <input type="date" name="fecha_reserva" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">FECHA DE VIAJE</label>
                                <input type="date" name="fecha_viaje" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">MONTO TOTAL (€)</label>
                                <input type="number" step="0.01" name="precio_total_viaje" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-uppercase small fw-bold text-primary mb-3">Primer pago (opcional)</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">MONTO A COBRAR</label>
                                <input type="number" step="0.01" name="monto_depositado" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">MÉTODO</label>
                                <select name="metodo_pago" class="form-select">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">FECHA PAGO</label>
                                <input type="date" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4 border-secondary">
                        <button type="button" class="btn btn-outline-secondary text-white px-4">Guardar borrador</button>
                        <button type="submit" class="btn btn-primary px-5 fw-bold">Crear reserva</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection