@extends('layouts.app')

@section('title', 'Mis Citas - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-calendar-alt text-indigo-600 mr-3"></i>
                Mis Citas
            </h1>
            <p class="text-gray-600 mt-2">Gestiona todas tus citas programadas</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Citas -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @if(isset($citas) && count($citas) > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($citas as $cita)
                    <div class="p-6 hover:bg-gray-50 transition duration-200">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <!-- Información de la cita -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            @if(isset($cita['veterinary']))
                                                Cita con {{ $cita['veterinary']['clinic_name'] }}
                                            @elseif(isset($cita['trainer']))
                                                Sesión con {{ $cita['trainer']['user']['name'] }}
                                            @else
                                                Cita Programada
                                            @endif
                                        </h3>
                                        <p class="text-gray-600 mt-1">
                                            <i class="fas fa-calendar-day mr-2"></i>
                                            {{ \Carbon\Carbon::parse($cita['date'])->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                        {{ $cita['status'] == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $cita['status'] == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $cita['status'] == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        @if($cita['status'] == 'confirmed')
                                            Confirmada
                                        @elseif($cita['status'] == 'pending')
                                            Pendiente
                                        @else
                                            Cancelada
                                        @endif
                                    </span>
                                </div>
                                
                                @if(isset($cita['description']))
                                <p class="text-gray-700 mb-3">
                                    <strong>Motivo:</strong> {{ $cita['description'] }}
                                </p>
                                @endif

                                <!-- Información del profesional -->
                                @if(isset($cita['veterinary']))
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clinic-medical mr-2"></i>
                                    <span>{{ $cita['veterinary']['specialization'] ?? 'Veterinaria' }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Acciones -->
                            <div class="mt-4 lg:mt-0 lg:ml-6 flex space-x-3">
                                <button onclick="cancelAppointment({{ $cita['id'] }})" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 font-semibold text-sm"
                                        {{ $cita['status'] == 'cancelled' ? 'disabled' : '' }}>
                                    <i class="fas fa-times mr-1"></i>
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No tienes citas programadas</h3>
                    <p class="text-gray-600 mb-6">Cuando solicites una cita, aparecerá aquí.</p>
                    <a href="{{ route('veterinarias.index') }}" 
                       class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold">
                        <i class="fas fa-search mr-2"></i>
                        Buscar Veterinarias
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function cancelAppointment(appointmentId) {
    if (confirm('¿Estás seguro de que quieres cancelar esta cita?')) {
        fetch(`/citas/${appointmentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                alert('Error al cancelar la cita');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión');
        });
    }
}
</script>
@endpush
@endsection