@extends('layouts.app')

@section('title', 'Productos - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header con botón de carrito -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Productos para Mascotas</h1>
                <p class="text-gray-600">Encuentra los mejores productos para el cuidado de tu mascota</p>
            </div>
            <!-- Botón del carrito -->
            <a href="#" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i>
                Ver Carrito
                <span class="bg-white text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold ml-2" id="cart-count">
                    {{ count($productos) > 0 ? count($productos) : 0 }}
                </span>
            </a>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
        @endif

        <!-- Buscador y Filtros -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           id="search-input"
                           placeholder="Buscar por nombre, descripción..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-4">
                    <select id="filter-sort" class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Ordenar por</option>
                        <option value="price_asc">Precio: Menor a Mayor</option>
                        <option value="price_desc">Precio: Mayor a Menor</option>
                        <option value="name_asc">Nombre A-Z</option>
                        <option value="name_desc">Nombre Z-A</option>
                    </select>
                    <button id="clear-filters" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-4">
            <p class="text-gray-600">
                <span id="productos-count">{{ count($productos) }}</span> producto(s) encontrado(s)
            </p>
        </div>

        <!-- Lista de Productos -->
        <div id="productos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($productos as $index => $producto)
            <div class="producto-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group"
                 data-name="{{ strtolower($producto['name'] ?? '') }}"
                 data-description="{{ strtolower($producto['description'] ?? '') }}"
                 data-price="{{ $producto['price'] ?? 0 }}"
                 data-veterinary="{{ strtolower($producto['veterinary']['clinic_name'] ?? '') }}">
                <!-- Imagen del Producto -->
                <div class="h-48 bg-gradient-to-br from-gray-100 to-blue-100 relative overflow-hidden">
                    @php
                        // Definir imágenes locales para los productos
                        $localImages = [
                            'producto1.jpg',
                            'producto2.jpg', 
                            'producto3.jpeg',
                            'producto4.jpg',
                            'producto5.jpg',
                            'producto6.jpg'
                        ];
                        
                        // Usar imagen cíclica basada en el índice
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp

                    <img 
                        src="{{ asset('images/productos/' . $localImage) }}" 
                        alt="{{ $producto['name'] ?? 'Producto' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        onerror="this.src='{{ asset('images/default-product.jpg') }}'"
                    >
                    
                    <!-- Badge de precio -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ${{ number_format($producto['price'] ?? 0, 2) }}
                        </span>
                    </div>
                    
                    <!-- Overlay en hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                </div>
                
                <!-- Información del Producto -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2 truncate">
                        {{ $producto['name'] ?? 'Nombre no disponible' }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $producto['description'] ?? 'Descripción no disponible' }}
                    </p>
                    
                    <div class="space-y-2 mb-4">
                        <!-- Categoría -->
                        @if(isset($producto['category_id']) || isset($producto['category']))
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag text-blue-500 mr-2 w-4"></i>
                            <span class="flex-1">
                                @if(isset($producto['category']['name']))
                                    {{ $producto['category']['name'] }}
                                @else
                                    Categoría #{{ $producto['category_id'] ?? 'N/A' }}
                                @endif
                            </span>
                        </div>
                        @endif

                        <!-- Veterinaria -->
                        @if(isset($producto['veterinary_id']) || isset($producto['veterinary']))
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clinic-medical text-purple-500 mr-2 w-4"></i>
                            <span class="flex-1 truncate">
                                @if(isset($producto['veterinary']['clinic_name']))
                                    {{ $producto['veterinary']['clinic_name'] }}
                                @else
                                    Veterinaria #{{ $producto['veterinary_id'] ?? 'N/A' }}
                                @endif
                            </span>
                        </div>
                        @endif

                        <!-- Disponibilidad -->
                        <div class="flex items-center text-sm text-green-600">
                            <i class="fas fa-check-circle mr-2 w-4"></i>
                            <span class="flex-1">Disponible</span>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="flex-1 mr-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto['id'] ?? '' }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 text-sm font-semibold flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Agregar al Carrito
                            </button>
                        </form>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $producto['id'] ?? '') }}" 
                               class="text-gray-400 hover:text-indigo-500 transition duration-200 p-2"
                               title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="text-gray-400 hover:text-red-500 transition duration-200 p-2" 
                                    title="Agregar a favoritos">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12">
                <i class="fas fa-shopping-bag text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay productos disponibles</h3>
                <p class="text-gray-500">No se pudieron cargar los productos desde la API.</p>
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4 max-w-md mx-auto">
                    <p class="text-sm text-yellow-800">
                        <strong>Nota:</strong> Esto puede ser porque la API no tiene productos o hay un error de conexión.
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Estado cuando no hay resultados -->
        <div id="no-results" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron productos</h3>
            <p class="text-gray-500">Intenta ajustar los filtros de búsqueda.</p>
        </div>

        <!-- Información sobre las imágenes -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>💡 <strong>Nota:</strong> Las imágenes mostradas son de referencia local</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Variables globales
let allProductos = [];

// Inicializar cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Guardar todos los productos
    allProductos = Array.from(document.querySelectorAll('.producto-card'));
    
    // Configurar event listeners
    setupFilters();
});

// Configurar filtros y búsqueda
function setupFilters() {
    const searchInput = document.getElementById('search-input');
    const filterSort = document.getElementById('filter-sort');
    const clearFilters = document.getElementById('clear-filters');
    
    // Evento de búsqueda en tiempo real
    searchInput.addEventListener('input', applyFilters);
    
    // Evento para ordenamiento
    filterSort.addEventListener('change', applyFilters);
    
    // Limpiar filtros
    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterSort.value = '';
        applyFilters();
    });
}

// Aplicar todos los filtros
function applyFilters() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const sortFilter = document.getElementById('filter-sort').value;
    
    let visibleProductos = [];
    
    // Primero aplicar filtros de búsqueda
    allProductos.forEach(producto => {
        const name = producto.dataset.name;
        const description = producto.dataset.description;
        const veterinary = producto.dataset.veterinary;
        
        // Verificar búsqueda
        const searchMatch = !searchTerm || 
                           name.includes(searchTerm) || 
                           description.includes(searchTerm) || 
                           veterinary.includes(searchTerm);
        
        // Mostrar u ocultar según los filtros
        if (searchMatch) {
            producto.style.display = 'block';
            visibleProductos.push(producto);
        } else {
            producto.style.display = 'none';
        }
    });
    
    // Aplicar ordenamiento si está seleccionado
    if (sortFilter) {
        visibleProductos = sortProductos(visibleProductos, sortFilter);
        
        // Reordenar en el DOM
        const container = document.getElementById('productos-container');
        visibleProductos.forEach(producto => {
            container.appendChild(producto);
        });
    }
    
    // Actualizar contador
    document.getElementById('productos-count').textContent = visibleProductos.length;
    
    // Mostrar/ocultar mensaje de no resultados
    const noResults = document.getElementById('no-results');
    const productosContainer = document.getElementById('productos-container');
    
    if (visibleProductos.length === 0) {
        noResults.classList.remove('hidden');
        productosContainer.classList.add('hidden');
    } else {
        noResults.classList.add('hidden');
        productosContainer.classList.remove('hidden');
    }
}

// Función para ordenar productos
function sortProductos(productos, sortType) {
    return productos.sort((a, b) => {
        switch(sortType) {
            case 'price_asc':
                return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'price_desc':
                return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            case 'name_asc':
                return a.dataset.name.localeCompare(b.dataset.name);
            case 'name_desc':
                return b.dataset.name.localeCompare(a.dataset.name);
            default:
                return 0;
        }
    });
}

// Función para agregar al carrito con feedback
document.addEventListener('DOMContentLoaded', function() {
    const cartForms = document.querySelectorAll('form[action*="addToCart"]');
    
    cartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Mostrar loading
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Agregando...';
            
            // Simular envío (aquí iría tu lógica real de AJAX)
            setTimeout(() => {
                // Mostrar mensaje de éxito
                showSuccessMessage('Producto agregado al carrito');
                
                // Actualizar contador del carrito
                const cartCount = document.getElementById('cart-count');
                let currentCount = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = currentCount + 1;
                
                // Restaurar botón
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
                
                // En un caso real, aquí enviarías el formulario
                // this.submit();
            }, 1000);
        });
    });
});

// Función para mostrar mensaje de éxito
function showSuccessMessage(message) {
    // Crear elemento de mensaje
    const successAlert = document.createElement('div');
    successAlert.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in';
    successAlert.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <div>
                <p class="font-semibold">¡Éxito!</p>
                <p>${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Agregar al documento
    document.body.appendChild(successAlert);
    
    // Auto-eliminar después de 5 segundos
    setTimeout(() => {
        if (successAlert.parentElement) {
            successAlert.remove();
        }
    }, 5000);
}
</script>

<style>
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.producto-card {
    transition: all 0.3s ease;
}

/* Animación para el mensaje de éxito */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
@endpush
@endsection