@extends('layouts.app')

@section('title', $veterinaria['clinic_name'] ?? 'Veterinaria - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-500">Dashboard</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <a href="{{ route('veterinarias.index') }}" class="text-indigo-600 hover:text-indigo-500">Veterinarias</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-500">{{ $veterinaria['clinic_name'] ?? 'Detalle' }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                    <!-- Header -->
                    <div class="bg-indigo-600 text-white px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h1 class="text-2xl font-bold flex items-center">
                                <i class="fas fa-clinic-medical mr-3"></i>
                                {{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}
                            </h1>
                            <span class="bg-white text-indigo-600 px-3 py-1 rounded-full text-sm font-semibold mt-2 sm:mt-0">
                                {{ $veterinaria['specialization'] ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-6">
                        <!-- Imagen - Misma lógica que el index -->
                        <div class="text-center mb-6">
                            @php
                                // MISMA LÓGICA QUE EN EL INDEX - Imágenes locales cíclicas
                                $localImages = [
                                    'veterinaria1.jpg',
                                    'veterinaria2.jpg', 
                                    'veterinaria3.jpg',
                                    'veterinaria4.jpg',
                                    'veterinaria5.jpg',
                                    'veterinaria6.jpg'
                                ];
                                
                                // Usar el ID de la veterinaria para seleccionar imagen cíclica
                                $imageIndex = ($veterinaria['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            
                            <img 
                                src="{{ asset('images/veterinarias/' . $localImage) }}" 
                                alt="{{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}"
                                class="w-full max-w-2xl h-80 object-cover rounded-lg shadow-md mx-auto hover:shadow-lg transition duration-300"
                                onerror="this.src='{{ asset('images/default-veterinaria.jpg') }}'"
                            >
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Imagen de referencia
                            </p>
                        </div>

                        <!-- Información General -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Información de la Clínica -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-info-circle text-indigo-500 mr-2"></i>
                                    Información General
                                </h2>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-stethoscope text-indigo-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Especialización</p>
                                            <p class="text-gray-600">{{ $veterinaria['specialization'] ?? 'No especificada' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-certificate text-green-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Licencia Veterinaria</p>
                                            <p class="text-gray-600">{{ $veterinaria['veterinary_license'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-calendar-alt text-purple-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Registrado</p>
                                            <p class="text-gray-600">
                                                @if(isset($veterinaria['created_at']))
                                                    {{ \Carbon\Carbon::parse($veterinaria['created_at'])->format('d/m/Y') }}
                                                @else
                                                    Fecha no disponible
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del Veterinario -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-user-md text-green-500 mr-2"></i>
                                    Información del Veterinario
                                </h2>
                                @if(isset($veterinaria['user']))
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-user text-gray-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Nombre</p>
                                            <p class="text-gray-600">Dr. {{ $veterinaria['user']['name'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-envelope text-blue-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Email</p>
                                            <p class="text-gray-600">{{ $veterinaria['user']['email'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    @if(isset($veterinaria['user']['profile']))
                                    <div class="flex items-start">
                                        <i class="fas fa-phone text-green-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Teléfono</p>
                                            <p class="text-gray-600">{{ $veterinaria['user']['profile']['phone'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <p class="text-gray-500 italic">Información del veterinario no disponible.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Horarios -->
                        @if(isset($veterinaria['schedules']) && $veterinaria['schedules'])
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-clock text-yellow-500 mr-2"></i>
                                Horarios de Atención
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        $schedules = is_string($veterinaria['schedules']) ? 
                                                   json_decode($veterinaria['schedules'], true) : 
                                                   $veterinaria['schedules'];
                                        $days = [
                                            'monday' => 'Lunes',
                                            'tuesday' => 'Martes', 
                                            'wednesday' => 'Miércoles',
                                            'thursday' => 'Jueves',
                                            'friday' => 'Viernes',
                                            'saturday' => 'Sábado',
                                            'sunday' => 'Domingo'
                                        ];
                                    @endphp
                                    @foreach($days as $key => $day)
                                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                        <p class="font-semibold text-gray-900 mb-1">{{ $day }}</p>
                                        <p class="text-sm text-gray-600">
                                            @if(isset($schedules[$key]) && $schedules[$key] !== 'Cerrado')
                                                @if(is_array($schedules[$key]))
                                                    {{ implode(', ', $schedules[$key]) }}
                                                @else
                                                    {{ $schedules[$key] }}
                                                @endif
                                            @else
                                                <span class="text-red-500 font-medium">Cerrado</span>
                                            @endif
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-yellow-800 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Horarios no disponibles
                            </p>
                        </div>
                        @endif

                        <!-- Servicios Adicionales -->
                        <div class="mt-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-concierge-bell text-purple-500 mr-2"></i>
                                Servicios Ofrecidos
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    // Servicios basados en la especialización
                                    $servicios = [
                                        'Medicina General' => ['Consulta general', 'Vacunación', 'Desparasitación'],
                                        'Cirugía' => ['Cirugía general', 'Esterilización', 'Cirugía reconstructiva'],
                                        'Dermatología' => ['Tratamiento de piel', 'Alergias', 'Dermatitis'],
                                        'Cardiología' => ['Ecocardiograma', 'Electrocardiograma', 'Consulta cardíaca'],
                                        'Oftalmología' => ['Consulta ocular', 'Cirugía ocular', 'Tratamiento de cataratas'],
                                        'default' => ['Consulta veterinaria', 'Atención de urgencias', 'Asesoramiento']
                                    ];
                                    
                                    $especialidad = $veterinaria['specialization'] ?? 'default';
                                    $serviciosMostrar = $servicios[$especialidad] ?? $servicios['default'];
                                @endphp
                                
                                @foreach($serviciosMostrar as $servicio)
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $servicio }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Acciones Rápidas -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-green-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-bolt mr-2"></i>
                            Acciones Rápidas
                        </h3>
                    </div>
                    <div class="p-4 space-y-3">
                        @if(isset($veterinaria['user']['profile']['phone']))
                        <a href="tel:{{ $veterinaria['user']['profile']['phone'] }}" 
                           class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Llamar Ahora
                        </a>
                        @else
                        <button disabled class="w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-semibold flex items-center justify-center cursor-not-allowed">
                            <i class="fas fa-phone mr-2"></i>
                            Teléfono no disponible
                        </button>
                        @endif
                        
                        @if(isset($veterinaria['user']['email']))
                        <a href="mailto:{{ $veterinaria['user']['email'] }}" 
                           class="w-full border border-indigo-600 text-indigo-600 py-3 px-4 rounded-lg hover:bg-indigo-50 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            Enviar Email
                        </a>
                        @else
                        <button disabled class="w-full border border-gray-400 text-gray-400 py-3 px-4 rounded-lg font-semibold flex items-center justify-center cursor-not-allowed">
                            <i class="fas fa-envelope mr-2"></i>
                            Email no disponible
                        </button>
                        @endif
                        
                        <button onclick="shareVeterinary()" 
                                class="w-full border border-yellow-600 text-yellow-600 py-3 px-4 rounded-lg hover:bg-yellow-50 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-share-alt mr-2"></i>
                            Compartir
                        </button>
                        
                        <button onclick="toggleFavorite({{ $veterinaria['id'] ?? 0 }})" 
                                class="w-full border border-red-600 text-red-600 py-3 px-4 rounded-lg hover:bg-red-50 transition duration-200 font-semibold flex items-center justify-center" 
                                id="favoriteBtn">
                            <i class="far fa-heart mr-2" id="favoriteIcon"></i>
                            <span id="favoriteText">Agregar a Favoritos</span>
                        </button>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-blue-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-address-card mr-2"></i>
                            Contacto
                        </h3>
                    </div>
                    <div class="p-4">
                        @if(isset($veterinaria['user']['profile']))
                        <div class="space-y-3">
                            @if(isset($veterinaria['user']['profile']['phone']))
                            <div class="flex items-start">
                                <i class="fas fa-phone text-green-500 mt-1 mr-3 w-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Teléfono</p>
                                    <p class="text-gray-600">{{ $veterinaria['user']['profile']['phone'] }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if(isset($veterinaria['user']['profile']['address']))
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-500 mt-1 mr-3 w-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Dirección</p>
                                    <p class="text-gray-600">{{ $veterinaria['user']['profile']['address'] }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if(isset($veterinaria['user']['email']))
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-blue-500 mt-1 mr-3 w-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Email</p>
                                    <p class="text-gray-600">{{ $veterinaria['user']['email'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500 italic">Información de contacto no disponible</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Volver a la lista -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-indigo-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Navegación
                        </h3>
                    </div>
                    <div class="p-4">
                        <a href="{{ route('veterinarias.index') }}" 
                           class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>
                            Volver a Veterinarias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function shareVeterinary() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $veterinaria["clinic_name"] ?? "Veterinaria" }} - PetPedia',
            text: 'Mira esta veterinaria en PetPedia: {{ $veterinaria["clinic_name"] ?? "Veterinaria profesional" }}',
            url: window.location.href
        })
        .then(() => console.log('Compartido exitosamente'))
        .catch((error) => console.log('Error al compartir', error));
    } else {
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Enlace copiado al portapapeles');
        });
    }
}

function toggleFavorite(veterinaryId) {
    const btn = document.getElementById('favoriteBtn');
    const icon = document.getElementById('favoriteIcon');
    const text = document.getElementById('favoriteText');
    
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        btn.classList.remove('border-red-600', 'text-red-600', 'hover:bg-red-50');
        btn.classList.add('border-red-500', 'bg-red-500', 'text-white', 'hover:bg-red-600');
        text.textContent = 'En Favoritos';
        
        // Aquí podrías hacer una petición a tu API para guardar en favoritos
        console.log('Agregando veterinaria', veterinaryId, 'a favoritos');
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        btn.classList.remove('border-red-500', 'bg-red-500', 'text-white', 'hover:bg-red-600');
        btn.classList.add('border-red-600', 'text-red-600', 'hover:bg-red-50');
        text.textContent = 'Agregar a Favoritos';
        
        // Aquí podrías hacer una petición a tu API para quitar de favoritos
        console.log('Quitando veterinaria', veterinaryId, 'de favoritos');
    }
}

// Cargar estado de favoritos al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Aquí podrías verificar si esta veterinaria está en favoritos
    // y actualizar el botón en consecuencia
});
</script>
@endpush
@endsection