@extends('layouts.app')

@section('title', 'Mis Adopciones - PetPedia')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Mis Adopciones</h1>
            <p class="text-gray-600 mt-2">Gestiona tus solicitudes de adopción</p>
        </div>
        <button 
            onclick="openModal()"
            class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 px-6 rounded-lg flex items-center gap-2 shadow-lg transition duration-200">
            <i class="fas fa-plus-circle"></i>
            Nueva Adopción
        </button>
    </div>

    {{-- Alertas --}}
    <div id="alertContainer"></div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" id="statsContainer">
        <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold opacity-90">Pendientes</p>
                    <p class="text-3xl font-bold mt-2" id="pendingCount">0</p>
                </div>
                <i class="fas fa-clock text-4xl opacity-20"></i>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold opacity-90">Aprobadas</p>
                    <p class="text-3xl font-bold mt-2" id="approvedCount">0</p>
                </div>
                <i class="fas fa-check-circle text-4xl opacity-20"></i>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-400 to-red-600 rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold opacity-90">Rechazadas</p>
                    <p class="text-3xl font-bold mt-2" id="rejectedCount">0</p>
                </div>
                <i class="fas fa-times-circle text-4xl opacity-20"></i>
            </div>
        </div>
    </div>

    {{-- Tabla de Adopciones --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-pink-500 to-purple-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Mascota</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Refugio</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Comentario</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="adoptionsTableBody">
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-spinner fa-spin text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">Cargando adopciones...</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200" id="paginationContainer"></div>
    </div>
</div>

{{-- Modal para crear/editar adopción --}}
<div id="adoptionModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md">
        {{-- Header del modal --}}
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-t-xl px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 id="modalTitle" class="text-2xl font-bold text-white">Nueva Adopción</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition duration-200">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Formulario --}}
        <form id="adoptionForm" class="p-6" onsubmit="saveAdoption(event)">
            <input type="hidden" id="adoption_id">
            <input type="hidden" id="form_method" value="POST">

            <div class="space-y-4">
                {{-- Mascota --}}
                <div>
                    <label for="pet_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-paw text-pink-600 mr-1"></i>
                        Mascota
                    </label>
                    <select id="pet_id" name="pet_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200">
                        <option value="">Seleccione una mascota (opcional)</option>
                    </select>
                </div>

                {{-- Refugio --}}
                <div>
                    <label for="shelter_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-home text-orange-600 mr-1"></i>
                        Refugio
                    </label>
                    <select id="shelter_id" name="shelter_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200">
                        <option value="">Seleccione un refugio (opcional)</option>
                    </select>
                </div>

                {{-- Estado --}}
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-flag text-purple-600 mr-1"></i>
                        Estado <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200">
                        <option value="">Seleccione un estado</option>
                        <option value="pending">Pendiente</option>
                        <option value="approved">Aprobado</option>
                        <option value="rejected">Rechazado</option>
                    </select>
                </div>

                {{-- Comentario --}}
                <div>
                    <label for="comment" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-blue-600 mr-1"></i>
                        Comentario
                    </label>
                    <textarea id="comment" name="comment" rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200"
                        placeholder="Escribe un comentario..."></textarea>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal()" 
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </button>
                <button type="submit" 
                    class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // URL del backend API
    const API_URL = 'http://127.0.0.1:8000/api';
    
    // Cargar datos al iniciar la página
    document.addEventListener('DOMContentLoaded', function() {
        loadAdoptions();
        loadPets();
        loadShelters();
    });

    // Cargar adopciones desde el backend
    async function loadAdoptions() {
        try {
            const response = await fetch(`${API_URL}/adoptions`);
            if (!response.ok) throw new Error('Error al cargar adopciones');
            
            const data = await response.json();
            const adoptions = data.data || data;
            
            displayAdoptions(adoptions);
            updateStats(adoptions);
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al cargar las adopciones', 'error');
        }
    }

    // Mostrar adopciones en la tabla
    function displayAdoptions(adoptions) {
        const tbody = document.getElementById('adoptionsTableBody');
        
        if (!adoptions || adoptions.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-heart text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No hay adopciones registradas</p>
                            <p class="text-gray-400 text-sm mt-2">Comienza creando tu primera adopción</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = adoptions.map(adoption => `
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#${adoption.id}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                <i class="fas fa-paw text-pink-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                ${adoption.pet ? adoption.pet.name : 'N/A'}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${adoption.shelter ? adoption.shelter.name : 'N/A'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${getStatusBadge(adoption.status)}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">
                    ${adoption.comment || 'Sin comentario'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <i class="far fa-calendar-alt mr-1"></i>
                    ${new Date(adoption.created_at).toLocaleDateString('es-ES')}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <div class="flex justify-center gap-2">
                        <button onclick="viewAdoption(${adoption.id})" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Ver detalles">
                            <i class="fas fa-eye text-lg"></i>
                        </button>
                        <button onclick="editAdoption(${adoption.id})" class="text-yellow-600 hover:text-yellow-900 transition duration-200" title="Editar">
                            <i class="fas fa-edit text-lg"></i>
                        </button>
                        <button onclick="deleteAdoption(${adoption.id})" class="text-red-600 hover:text-red-900 transition duration-200" title="Eliminar">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Actualizar estadísticas
    function updateStats(adoptions) {
        const pending = adoptions.filter(a => a.status === 'pending').length;
        const approved = adoptions.filter(a => a.status === 'approved').length;
        const rejected = adoptions.filter(a => a.status === 'rejected').length;
        
        document.getElementById('pendingCount').textContent = pending;
        document.getElementById('approvedCount').textContent = approved;
        document.getElementById('rejectedCount').textContent = rejected;
    }

    // Obtener badge de estado
    function getStatusBadge(status) {
        const badges = {
            'pending': '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Pendiente</span>',
            'approved': '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Aprobado</span>',
            'rejected': '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Rechazado</span>'
        };
        return badges[status] || status;
    }

    // Cargar mascotas
    async function loadPets() {
        try {
            const response = await fetch(`${API_URL}/pets`);
            if (!response.ok) throw new Error('Error al cargar mascotas');
            
            const data = await response.json();
            const pets = data.data || data;
            const select = document.getElementById('pet_id');
            
            select.innerHTML = '<option value="">Seleccione una mascota (opcional)</option>' +
                pets.map(pet => `<option value="${pet.id}">${pet.name}</option>`).join('');
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Cargar refugios
    async function loadShelters() {
        try {
            const response = await fetch(`${API_URL}/shelters`);
            if (!response.ok) throw new Error('Error al cargar refugios');
            
            const data = await response.json();
            const shelters = data.data || data;
            const select = document.getElementById('shelter_id');
            
            select.innerHTML = '<option value="">Seleccione un refugio (opcional)</option>' +
                shelters.map(shelter => `<option value="${shelter.id}">${shelter.name}</option>`).join('');
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Abrir modal
    function openModal() {
        document.getElementById('adoptionModal').classList.remove('hidden');
        document.getElementById('modalTitle').textContent = 'Nueva Adopción';
        document.getElementById('adoption_id').value = '';
        document.getElementById('form_method').value = 'POST';
        document.getElementById('adoptionForm').reset();
    }

    // Cerrar modal
    function closeModal() {
        document.getElementById('adoptionModal').classList.add('hidden');
        document.getElementById('adoptionForm').reset();
    }

    // Guardar adopción
    async function saveAdoption(event) {
        event.preventDefault();
        
        const adoptionId = document.getElementById('adoption_id').value;
        const method = document.getElementById('form_method').value;
        const url = adoptionId ? `${API_URL}/adoptions/${adoptionId}` : `${API_URL}/adoptions`;
        
        const formData = {
            pet_id: document.getElementById('pet_id').value || null,
            shelter_id: document.getElementById('shelter_id').value || null,
            status: document.getElementById('status').value,
            comment: document.getElementById('comment').value || null
        };

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Error al guardar');
            }

            closeModal();
            showAlert(adoptionId ? 'Adopción actualizada exitosamente' : 'Adopción creada exitosamente', 'success');
            loadAdoptions();
        } catch (error) {
            console.error('Error:', error);
            showAlert(error.message, 'error');
        }
    }

    // Ver adopción
    async function viewAdoption(id) {
        try {
            const response = await fetch(`${API_URL}/adoptions/${id}`);
            if (!response.ok) throw new Error('Error al cargar la adopción');
            
            const adoption = await response.json();
            
            alert(`Detalles de la Adopción #${adoption.id}\n\nMascota: ${adoption.pet ? adoption.pet.name : 'N/A'}\nRefugio: ${adoption.shelter ? adoption.shelter.name : 'N/A'}\nEstado: ${adoption.status}\nComentario: ${adoption.comment || 'Sin comentario'}\nFecha: ${new Date(adoption.created_at).toLocaleString('es-ES')}`);
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al cargar los detalles', 'error');
        }
    }

    // Editar adopción
    async function editAdoption(id) {
        try {
            const response = await fetch(`${API_URL}/adoptions/${id}`);
            if (!response.ok) throw new Error('Error al cargar la adopción');
            
            const adoption = await response.json();
            
            document.getElementById('adoption_id').value = adoption.id;
            document.getElementById('pet_id').value = adoption.pet_id || '';
            document.getElementById('shelter_id').value = adoption.shelter_id || '';
            document.getElementById('status').value = adoption.status;
            document.getElementById('comment').value = adoption.comment || '';
            document.getElementById('form_method').value = 'PUT';
            document.getElementById('modalTitle').textContent = 'Editar Adopción';
            document.getElementById('adoptionModal').classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al cargar la adopción', 'error');
        }
    }

    // Eliminar adopción
    async function deleteAdoption(id) {
        if (!confirm('¿Está seguro de eliminar esta adopción?')) return;

        try {
            const response = await fetch(`${API_URL}/adoptions/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Error al eliminar');
            
            showAlert('Adopción eliminada exitosamente', 'success');
            loadAdoptions();
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error al eliminar la adopción', 'error');
        }
    }

    // Mostrar alertas
    function showAlert(message, type) {
        const container = document.getElementById('alertContainer');
        const bgColor = type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        container.innerHTML = `
            <div class="${bgColor} border-l-4 p-4 rounded-lg mb-6 flex items-center shadow">
                <i class="fas ${icon} text-2xl mr-3"></i>
                <span>${message}</span>
            </div>
        `;
        
        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }
</script>
@endpush
@endsection