@extends('layouts.app')

@section('title', 'Mis Citas - PetPedia')

@section('content')
@php
    function getStatusBadge($status) {
        switch(strtolower($status)) {
            case 'pending':
                return '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold">Pendiente</span>';
            case 'confirmed':
                return '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">Confirmada</span>';
            case 'cancelled':
                return '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-bold">Cancelada</span>';
            case 'completed':
                return '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold">Completada</span>';
            default:
                return '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-bold">' . $status . '</span>';
        }
    }

    function formatDate($date) {
        return \Carbon\Carbon::parse($date)->format('d/m/Y H:i');
    }
@endphp

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-calendar-alt text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Mis Citas
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Gestiona y revisa todas tus citas programadas
            </p>
        </div>

        <!-- Botones de navegación -->
        <div class="flex justify-center mb-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-2 flex space-x-2">
                <a href="{{ route('veterinarias.index') }}" 
                   class="px-6 py-3 rounded-xl text-gray-600 hover:bg-purple-500 hover:text-white transition-all duration-300 font-semibold flex items-center">
                    <i class="fas fa-clinic-medical mr-2"></i> Veterinarias
                </a>
                <a href="{{ route('citas.index') }}" 
                   class="px-6 py-3 rounded-xl bg-purple-500 text-white font-semibold flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i> Mis Citas
                </a>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/60 text-center">
                <div class="text-2xl font-black text-purple-600 mb-2">{{ count($appointments) }}</div>
                <div class="text-gray-600 font-semibold">Total Citas</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/60 text-center">
                <div class="text-2xl font-black text-yellow-600 mb-2">
                    {{ collect($appointments)->where('status', 'pending')->count() }}
                </div>
                <div class="text-gray-600 font-semibold">Pendientes</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/60 text-center">
                <div class="text-2xl font-black text-green-600 mb-2">
                    {{ collect($appointments)->where('status', 'confirmed')->count() }}
                </div>
                <div class="text-gray-600 font-semibold">Confirmadas</div>
            </div>
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/60 text-center">
                <div class="text-2xl font-black text-blue-600 mb-2">
                    {{ collect($appointments)->where('status', 'completed')->count() }}
                </div>
                <div class="text-gray-600 font-semibold">Completadas</div>
            </div>
        </div>

        <!-- Lista de Citas -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white/60">
            @if(count($appointments) > 0)
                <div class="space-y-6">
                    @foreach($appointments as $appointment)
                    <div class="bg-gradient-to-br from-white via-purple-50 to-indigo-100 rounded-2xl p-6 shadow-lg border border-white/50 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <!-- Información principal -->
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-3">
                                    <h3 class="text-xl font-black text-gray-900">
                                        @if(isset($appointment['veterinary']))
                                            🏥 {{ $appointment['veterinary']['clinic_name'] ?? 'Veterinaria' }}
                                        @elseif(isset($appointment['trainer']))
                                            💪 Entrenador: {{ $appointment['trainer']['user']['name'] ?? 'Entrenador' }}
                                        @else
                                            📅 Cita Programada
                                        @endif
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        {!! getStatusBadge($appointment['status'] ?? 'pending') !!}
                                        @if(isset($appointment['veterinary']))
                                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-bold">
                                                <i class="fas fa-clinic-medical mr-1"></i> Veterinaria
                                            </span>
                                        @elseif(isset($appointment['trainer']))
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold">
                                                <i class="fas fa-dumbbell mr-1"></i> Entrenador
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-600">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-calendar-day text-purple-500"></i>
                                        </div>
                                        <span class="font-semibold">{{ formatDate($appointment['date']) }}</span>
                                    </div>
                                    
                                    @if(isset($appointment['veterinary']['specialization']))
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-stethoscope text-green-500"></i>
                                        </div>
                                        <span class="font-semibold">{{ $appointment['veterinary']['specialization'] }}</span>
                                    </div>
                                    @elseif(isset($appointment['trainer']['specialization']))
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-dumbbell text-orange-500"></i>
                                        </div>
                                        <span class="font-semibold">{{ $appointment['trainer']['specialization'] ?? 'Entrenamiento' }}</span>
                                    </div>
                                    @else
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-info-circle text-gray-500"></i>
                                        </div>
                                        <span class="font-semibold">Sin especialización</span>
                                    </div>
                                    @endif

                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-file-alt text-blue-500"></i>
                                        </div>
                                        <span class="font-semibold truncate" title="{{ $appointment['description'] }}">
                                            {{ Str::limit($appointment['description'], 30) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Información adicional -->
                                @if(isset($appointment['veterinary']['user']['profile']['address']))
                                <div class="mt-3 flex items-center text-gray-600">
                                    <div class="w-6 h-6 bg-red-100 rounded-lg flex items-center justify-center mr-2">
                                        <i class="fas fa-map-marker-alt text-red-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm">{{ $appointment['veterinary']['user']['profile']['address'] }}</span>
                                </div>
                                @elseif(isset($appointment['trainer']['user']['profile']['address']))
                                <div class="mt-3 flex items-center text-gray-600">
                                    <div class="w-6 h-6 bg-red-100 rounded-lg flex items-center justify-center mr-2">
                                        <i class="fas fa-map-marker-alt text-red-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm">{{ $appointment['trainer']['user']['profile']['address'] ?? 'Dirección no disponible' }}</span>
                                </div>
                                @endif

                                <!-- 🔥 INFORMACIÓN DE DEPURACIÓN (temporal) -->
                                @if(app()->environment('local'))
                                <div class="mt-3 p-2 bg-gray-100 rounded-lg text-xs text-gray-600">
                                    <div class="font-semibold">Info Depuración:</div>
                                    <div>Cita ID: {{ $appointment['id'] ?? 'N/A' }}</div>
                                    <div>User ID en cita: {{ $appointment['user_id'] ?? 'NO ENCONTRADO' }}</div>
                                </div>
                                @endif
                            </div>

                            <!-- Acciones -->
                            <div class="flex space-x-3">
                                @if(isset($appointment['veterinary']))
                                <a href="{{ route('veterinarias.show', $appointment['veterinary']['id']) }}" 
                                   class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 py-2 rounded-xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-sm">
                                    <i class="fas fa-eye mr-2"></i> Ver
                                </a>
                                @elseif(isset($appointment['trainer']))
                                <a href="{{ route('entrenadores.show', $appointment['trainer']['id']) }}" 
                                   class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-4 py-2 rounded-xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-sm">
                                    <i class="fas fa-eye mr-2"></i> Ver
                                </a>
                                @endif
                                
                                @if(($appointment['status'] ?? 'pending') === 'pending')
                                <button class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-4 py-2 rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-sm cancel-appointment-btn"
                                        data-appointment-id="{{ $appointment['id'] }}"
                                        data-appointment-type="{{ isset($appointment['veterinary']) ? 'veterinaria' : 'entrenador' }}">
                                    <i class="fas fa-times mr-2"></i> Cancelar
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-purple-300 to-indigo-400 rounded-3xl shadow-2xl mb-6">
                        <i class="fas fa-calendar-times text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-700 mb-3">No tienes citas programadas</h3>
                    <p class="text-gray-500 text-lg mb-8">¡Programa tu primera cita con una veterinaria o entrenador!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('veterinarias.index') }}" 
                           class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-8 py-4 rounded-2xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center">
                            <i class="fas fa-clinic-medical mr-3"></i> Buscar Veterinarias
                        </a>
                        <a href="{{ route('entrenadores.index') }}" 
                           class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center">
                            <i class="fas fa-dumbbell mr-3"></i> Buscar Entrenadores
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .bg-gradient-to-br.from-white.via-purple-50.to-indigo-100 {
        animation: fadeIn 0.6s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Botones de cancelar cita
    const cancelButtons = document.querySelectorAll('.cancel-appointment-btn');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const appointmentId = this.getAttribute('data-appointment-id');
            const appointmentType = this.getAttribute('data-appointment-type');
            
            if (confirm(`¿Estás seguro de que deseas cancelar esta cita con la ${appointmentType}?`)) {
                // Aquí puedes agregar la lógica para cancelar la cita
                fetch(`/citas/${appointmentId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cita cancelada exitosamente');
                        location.reload();
                    } else {
                        alert('Error al cancelar la cita: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cancelar la cita');
                });
                
                // Efecto visual al cancelar
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            }
        });
    });

    // Efectos de entrada para las citas
    const appointmentCards = document.querySelectorAll('.bg-gradient-to-br.from-white.via-purple-50.to-indigo-100');
    appointmentCards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.1) + 's';
    });
});
</script>
@endsection