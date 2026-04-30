@props(['id', 'action', 'title' => 'Konfirmasi Hapus', 'message' => 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.'])

<div id="{{ $id }}" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-dark/60 backdrop-blur-sm opacity-0 transition-opacity duration-300" id="{{ $id }}-backdrop" onclick="closeDeleteModal('{{ $id }}')"></div>
    
    <!-- Modal Content -->
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md transform scale-95 opacity-0 transition-all duration-300 relative overflow-hidden" id="{{ $id }}-content">
            <!-- Header decoration -->
            <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
            
            <div class="p-8 text-center sm:p-10">
                <!-- Icon -->
                <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <!-- Text -->
                <h3 class="text-2xl font-bold text-dark mb-3">{{ $title }}</h3>
                <p class="text-gray-500 mb-8">{{ $message }}</p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button type="button" onclick="closeDeleteModal('{{ $id }}')" class="px-6 py-3 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors w-full sm:w-auto">
                        Batal
                    </button>
                    
                    @if($action === 'js')
                        <button type="button" onclick="confirmDeleteJs('{{ $id }}')" class="px-6 py-3 rounded-xl font-bold text-white bg-red-500 hover:bg-red-600 shadow-lg shadow-red-500/30 transition-all w-full sm:w-auto flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Ya, Hapus
                        </button>
                    @else
                        <form action="{{ $action }}" method="POST" class="w-full sm:w-auto m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-red-500 hover:bg-red-600 shadow-lg shadow-red-500/30 transition-all w-full flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Ya, Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (typeof window.openDeleteModal === 'undefined') {
        window.openDeleteModal = function(id, jsCallback = null) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const content = document.getElementById(id + '-content');
            
            if(modal) {
                modal.classList.remove('hidden');
                // Trigger reflow
                void modal.offsetWidth;
                
                backdrop.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');

                if(jsCallback) {
                    modal.dataset.callback = jsCallback;
                }
            }
        };

        window.closeDeleteModal = function(id) {
            const modal = document.getElementById(id);
            const backdrop = document.getElementById(id + '-backdrop');
            const content = document.getElementById(id + '-content');
            
            if(modal) {
                backdrop.classList.add('opacity-0');
                content.classList.remove('opacity-100', 'scale-100');
                content.classList.add('opacity-0', 'scale-95');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        };

        window.confirmDeleteJs = function(id) {
            const modal = document.getElementById(id);
            if(modal && modal.dataset.callback) {
                // Execute the callback function by name or eval
                try {
                    eval(modal.dataset.callback);
                } catch(e) {
                    console.error('Error executing delete callback:', e);
                }
                closeDeleteModal(id);
            }
        };
    }
</script>
