@props(['id', 'title', 'message'])

<div id="modal-{{ $id }}" class="fixed inset-0 z-[1001] overflow-y-auto hidden">
    <div class="flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-85 backdrop-blur-sm"></div>
        </div>

        <div class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
            <div class="bg-white px-8 pt-8 pb-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900" id="modal-title">{{ $title }}</h3>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">{{ $message }}</p>
                        </div>
                    </div>
                </div>
                {{ $slot }}
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button"
                        onclick="closeModal('{{ $id }}')"
                        class="inline-flex justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </button>
                    <button type="button"
                        onclick="submitForm('{{ $id }}')"
                        class="inline-flex justify-center rounded-xl border border-green-600 bg-white px-4 py-2 text-sm font-medium text-green-600 shadow-sm hover:bg-green-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById('modal-' + id).classList.add('hidden');
}

function submitForm(id) {
    const form = document.getElementById('form-' + id);
    if (form) {
        form.submit();
        closeModal(id);
    }
}

// Event listener untuk tombol escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="modal-"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        });
    }
});

// Event listener untuk klik di luar modal
document.addEventListener('click', function(event) {
    const modals = document.querySelectorAll('[id^="modal-"]');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script> 