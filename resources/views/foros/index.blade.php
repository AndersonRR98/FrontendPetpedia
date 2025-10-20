@extends('layouts.app')  <!-- vista de foro -->

@section('title', 'Foro - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        

        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-orange-500 to-amber-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-comments text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent mb-4">
                Foro de la Comunidad
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Comparte tus experiencias, consejos y dudas sobre tus mascotas 🐾
            </p>
        </div>

        <!-- Formulario nuevo post mejorado -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-12 border border-white/60">
            <h2 class="text-3xl font-black text-gray-900 mb-6 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mr-4">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                Crear Nueva Publicación
            </h2>

            <form id="formPost" method="POST" action="{{ route('foros.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <!-- Título -->
                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-heading text-orange-500 mr-2"></i>
                            Título
                        </label>
                        <input type="text" name="title" 
                               class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-orange-200 focus:bg-white shadow-lg transition-all duration-300 text-lg"
                               placeholder="Escribe un título atractivo..."
                               required
                               value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción breve -->
                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-align-left text-amber-500 mr-2"></i>
                            Descripción breve
                        </label>
                        <textarea name="description" rows="2" 
                                  class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-amber-200 focus:bg-white shadow-lg transition-all duration-300 resize-none text-lg"
                                  placeholder="Una breve descripción de tu publicación...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenido -->
                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-file-alt text-yellow-500 mr-2"></i>
                            Contenido
                        </label>
                        <textarea name="content" rows="4" 
                                  class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-yellow-200 focus:bg-white shadow-lg transition-all duration-300 resize-none text-lg"
                                  placeholder="Comparte tu experiencia, pregunta o consejo..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón de envío -->
                    <div class="flex justify-end mt-4">
                        <button type="submit" 
                                class="bg-gradient-to-r from-orange-500 to-amber-600 text-white px-10 py-4 rounded-2xl hover:from-orange-600 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center text-lg">
                            <i class="fas fa-paper-plane mr-3"></i>
                            Publicar en el Foro
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
        <div class="mb-8 p-6 bg-green-100 border border-green-200 rounded-2xl text-green-800 backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-8 p-6 bg-red-100 border border-red-200 rounded-2xl text-red-800 backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Listado de posts mejorado -->
        <div id="postsContainer" class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            @if(empty($foros) || count($foros) === 0)
                <!-- Estado vacío mejorado -->
                <div class="col-span-2 text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                        <i class="fas fa-comments text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-700 mb-3">No hay publicaciones todavía</h3>
                    <p class="text-gray-500 text-lg mb-8">Sé el primero en crear un post y compartir con la comunidad 🐶</p>
                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 rounded-2xl p-6 max-w-md mx-auto border border-orange-100">
                        <p class="text-orange-800 font-semibold flex items-center justify-center">
                            <i class="fas fa-lightbulb text-orange-500 mr-2"></i>
                            ¡Comparte tu experiencia con otras mascotas!
                        </p>
                    </div>
                </div>
            @else
                @php
                    $localImages = ['foro1.jpg','foro2.jpg','foro3.jpg','foro4.jpg'];
                    // 🔥 USAR EL USUARIO DE LA SESIÓN (del middleware)
                    $currentUser = session('user');
                    $currentUserId = $currentUser['id'] ?? null;
                    $currentUserName = $currentUser['name'] ?? 'Usuario';
                @endphp

                @foreach($foros as $post)
                    @php
                        // Lógica para imagen
                        $imageUrl = null;
                        if (!empty($post['image']) && $post['image'] !== null && strlen($post['image']) > 100) {
                            $imageUrl = 'data:image/jpeg;base64,' . $post['image'];
                        } else {
                            $postId = $post['id'] ?? 1;
                            $imageIndex = ($postId - 1) % count($localImages);
                            $imageUrl = asset('images/foros/' . $localImages[$imageIndex]);
                        }

                        // 🔥 VERIFICACIÓN CON USUARIO DE SESIÓN
                        $isOwner = $currentUserId && isset($post['user']['id']) && $currentUserId == $post['user']['id'];
                    @endphp

                    <div class="foro-card group relative bg-gradient-to-br from-white via-orange-50 to-amber-100 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-white/50"
                         data-post-id="{{ $post['id'] }}">

                        <!-- Efecto de brillo al hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-400/10 to-amber-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>

                        <!-- Imagen del post -->
                        <div class="h-64 relative overflow-hidden rounded-t-3xl">
                            <img src="{{ $imageUrl }}" alt="{{ $post['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                 onerror="this.src='{{ asset('images/default-foro.jpg') }}'">
                            
                            <!-- Gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            
                            <!-- Badge de autor -->
                            <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm rounded-2xl px-4 py-2 shadow-lg">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user text-orange-500 text-sm"></i>
                                    <span class="text-gray-800 font-bold text-sm">{{ $post['user']['name'] ?? 'Anónimo' }}</span>
                                </div>
                            </div>

                            <!-- Badge "Tú" si es el autor -->
                            @if($isOwner)
                            <div class="absolute top-5 right-5 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-2xl px-3 py-1 shadow-lg">
                                <span class="text-sm font-bold">Tú</span>
                            </div>
                            @endif
                        </div>

                        <!-- Contenido del post -->
                        <div class="p-7 relative z-10">
                            <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-orange-600 transition-colors duration-300 line-clamp-2">
                                {{ $post['title'] }}
                            </h3>
                            
                            @if($post['description'] ?? '')
                            <p class="text-lg text-gray-700 mb-4 font-medium leading-relaxed">
                                {{ $post['description'] }}
                            </p>
                            @endif

                            <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">
                                {{ $post['content'] }}
                            </p>

                            <!-- Estadísticas y acciones -->
                            <div class="flex flex-wrap gap-3 justify-between items-center pt-5 border-t border-gray-200/60">
                                <!-- Like -->
                                <form method="POST" action="{{ route('foros.like', $post['id']) }}" class="flex items-center">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center space-x-2 bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-2xl transition-all duration-300 transform hover:scale-105 group/like">
                                        <i class="fas fa-heart group-hover/like:scale-110 transition-transform duration-300"></i>
                                        <span class="font-bold">{{ $post['likes_count'] ?? 0 }}</span>
                                        <span class="hidden sm:inline">Me gusta</span>
                                    </button>
                                </form>

                                <!-- Comentarios -->
                                <button onclick="toggleComments({{ $post['id'] }})" 
                                        class="flex items-center space-x-2 bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-2xl transition-all duration-300 transform hover:scale-105 group/comment">
                                    <i class="fas fa-comment group-hover/comment:scale-110 transition-transform duration-300"></i>
                                    <span class="font-bold">{{ $post['comments_count'] ?? 0 }}</span>
                                    <span class="hidden sm:inline">Comentarios</span>
                                </button>

                                <!-- Botón Eliminar - Solo para el autor -->
                                @if($isOwner)
                                <form method="POST" action="{{ route('foros.destroy', $post['id']) }}" 
                                      class="delete-form flex items-center" 
                                      data-post-title="{{ $post['title'] }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center space-x-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-2xl transition-all duration-300 transform hover:scale-105 group/delete">
                                        <i class="fas fa-trash group-hover/delete:scale-110 transition-transform duration-300"></i>
                                        <span class="hidden sm:inline">Eliminar</span>
                                    </button>
                                </form>
                                @endif

                                <!-- Fecha -->
                                @if($post['created_at'] ?? false)
                                <div class="flex items-center space-x-2 text-gray-500">
                                    <i class="fas fa-clock"></i>
                                    <span class="text-sm hidden md:inline">{{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Sección de comentarios -->
                            <div id="comments-{{ $post['id'] }}" class="mt-6 hidden animate-fade-in">
                                <div class="bg-gradient-to-r from-white to-gray-50 rounded-2xl p-5 border border-gray-200/50">
                                    <!-- Formulario de comentario -->
                                    <form method="POST" action="{{ route('foros.comment', $post['id']) }}" class="mb-4">
                                        @csrf
                                        <div class="flex gap-3">
                                            <textarea name="content" rows="2" 
                                                      class="flex-1 bg-white border-0 rounded-2xl px-4 py-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-200 shadow-sm transition-all duration-300 resize-none"
                                                      placeholder="Escribe tu comentario..." 
                                                      required></textarea>
                                            <button type="submit" 
                                                    class="bg-gradient-to-r from-orange-500 to-amber-500 text-white px-6 py-3 rounded-2xl hover:from-orange-600 hover:to-amber-600 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center">
                                                <i class="fas fa-paper-plane mr-2"></i>
                                                Enviar
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Lista de comentarios -->
                                    @if(!empty($post['comments']))
                                        <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                                            @foreach($post['comments'] as $comment)
                                                <div class="flex items-start space-x-3 p-3 bg-white rounded-2xl border border-gray-100 shadow-sm">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-amber-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-user text-white text-xs"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-gray-900 text-sm">{{ $comment['user_name'] ?? 'Anónimo' }}</p>
                                                        <p class="text-gray-700 text-sm mt-1">{{ $comment['content'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4 text-gray-500">
                                            <i class="fas fa-comment-slash text-2xl mb-2"></i>
                                            <p class="text-sm">No hay comentarios todavía</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script>
function toggleComments(postId) {
    const box = document.getElementById(`comments-${postId}`);
    box.classList.toggle('hidden');
    
    if (!box.classList.contains('hidden')) {
        box.style.opacity = '0';
        box.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            box.style.transition = 'all 0.3s ease-out';
            box.style.opacity = '1';
            box.style.transform = 'translateY(0)';
        }, 50);
    }
}

// Confirmación para eliminar posts
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const postTitle = this.getAttribute('data-post-title');
            
            if (confirm(`¿Estás seguro de que quieres eliminar la publicación "${postTitle}"? Esta acción no se puede deshacer.`)) {
                this.submit();
            }
        });
    });

    // Efectos de entrada para las tarjetas
    const cards = document.querySelectorAll('.foro-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.foro-card:hover {
    animation: float 3s ease-in-out infinite;
}

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

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #f97316, #f59e0b);
    border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #ea580c, #d97706);
}
</style>
@endsection