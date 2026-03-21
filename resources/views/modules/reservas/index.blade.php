@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gestión de Reservas</h2>
        <a href="{{ route('reservas.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-lg"></i> Nueva Reserva
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }} 
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }} 
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID / Código</th>
                        <th>Cliente Titular</th>
                        <th>Destino</th>
                        <th>Tipo Viaje</th>
                        <th>Fecha Viaje</th>
                        <th>Monto Total</th>
                        <th>Estado Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $res)
                    <tr>
                        <td class="fw-bold">{{ $res->codigo_reserva }}</td>
                        
                        <td>{{ $res->cliente_nombre }} {{ $res->cliente_apellido }}</td>
                        <td><span class="badge bg-secondary">{{ $res->destino_etiqueta }}</span></td>
                        <td><span class="text-capitalize">{{ $res->tipo_viaje }}</span></td>
                        
                        <td>{{ \Carbon\Carbon::parse($res->fecha_viaje)->format('d/m/Y') }}</td>
                        <td class="text-success fw-bold">€{{ number_format($res->precio_total_viaje, 2) }}</td>
                        
                        <td>
                            @if($res->estado_pago == 'pagado') 
                                <span class="badge bg-success">Completado</span>
                            @elseif($res->estado_pago == 'parcial') 
                                <span class="badge bg-warning text-dark">Parcial</span>
                            @else 
                                <span class="badge bg-danger">Pendiente</span> 
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pagos.index', $res->id) }}" class="btn btn-sm btn-outline-primary">
                                Ver / Pagar
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            No hay reservas registradas en el sistema.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        {{ $reservas->links() }}
    </div>
</div>
@endsection