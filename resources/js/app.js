import './bootstrap';

import Alpine from 'alpinejs';

// Definisikan store Alpine global
Alpine.store('modalState', {
    showStockModal: false,
    stockModalMessage: '',
    
    // Fungsi untuk memicu modal
    showStockModalAlert(message) {
        this.stockModalMessage = message;
        this.showStockModal = true;
    }
});

window.Alpine = Alpine;

Alpine.start();

