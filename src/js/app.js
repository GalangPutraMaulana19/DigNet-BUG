/**
 * DigNet v2.0 - Main Application JavaScript
 * AdminLTE v4 + Bootstrap 5 (No jQuery)
 */

// Import Bootstrap 5 and dependencies
import 'bootstrap';
import * as bootstrap from 'bootstrap';

// Import AdminLTE v4
import 'admin-lte';

// Import Chart.js for dashboard charts
import Chart from 'chart.js/auto';

// Import styles
import '../scss/app.scss';

// Make Bootstrap available globally
window.bootstrap = bootstrap;
window.Chart = Chart;

/**
 * DOM Ready Handler (vanilla JS, no jQuery)
 */
document.addEventListener('DOMContentLoaded', function() {
  console.log('DigNet v2.0 - AdminLTE v4 Loaded');
  
  // Initialize tooltips
  initTooltips();
  
  // Initialize popovers
  initPopovers();
  
  // Initialize sidebar
  initSidebar();
  
  // Initialize form validation
  initFormValidation();
  
  // Initialize diagnosis form if present
  if (document.querySelector('.diagnosa-form')) {
    initDiagnosisForm();
  }
});

/**
 * Initialize Bootstrap Tooltips
 */
function initTooltips() {
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => 
    new bootstrap.Tooltip(tooltipTriggerEl)
  );
}

/**
 * Initialize Bootstrap Popovers
 */
function initPopovers() {
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => 
    new bootstrap.Popover(popoverTriggerEl)
  );
}

/**
 * Initialize Sidebar Behavior
 */
function initSidebar() {
  const sidebarToggle = document.querySelector('[data-widget="pushmenu"]');
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function(e) {
      e.preventDefault();
      document.body.classList.toggle('sidebar-collapse');
    });
  }
  
  // Active menu highlighting
  const currentPath = window.location.pathname;
  const menuLinks = document.querySelectorAll('.nav-sidebar .nav-link');
  
  menuLinks.forEach(link => {
    if (link.getAttribute('href') === currentPath || 
        currentPath.includes(link.getAttribute('href'))) {
      link.classList.add('active');
      
      // Open parent menu if nested
      const parentMenu = link.closest('.nav-treeview');
      if (parentMenu) {
        const parentLink = parentMenu.previousElementSibling;
        if (parentLink) {
          parentLink.classList.add('active');
          parentMenu.style.display = 'block';
        }
      }
    }
  });
}

/**
 * Initialize Form Validation (Bootstrap 5 native)
 */
function initFormValidation() {
  const forms = document.querySelectorAll('.needs-validation');
  
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      
      form.classList.add('was-validated');
    }, false);
  });
}

/**
 * Initialize Diagnosis Form
 */
function initDiagnosisForm() {
  const diagnosisForm = document.querySelector('.diagnosa-form');
  if (!diagnosisForm) return;
  
  // Handle checkbox selections
  const checkboxes = diagnosisForm.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      updateDiagnosisButton();
    });
  });
  
  // Handle condition selects
  const selects = diagnosisForm.querySelectorAll('select.kondisi');
  selects.forEach(select => {
    select.addEventListener('change', function() {
      const row = this.closest('tr');
      const checkbox = row.querySelector('input[type="checkbox"]');
      if (this.value && !checkbox.checked) {
        checkbox.checked = true;
      }
      updateDiagnosisButton();
    });
  });
  
  function updateDiagnosisButton() {
    const checkedCount = diagnosisForm.querySelectorAll('input[type="checkbox"]:checked').length;
    const submitBtn = diagnosisForm.querySelector('button[type="submit"]');
    
    if (submitBtn) {
      submitBtn.disabled = checkedCount === 0;
      submitBtn.textContent = checkedCount > 0 
        ? `Proses Diagnosis (${checkedCount} gejala)` 
        : 'Pilih minimal 1 gejala';
    }
  }
}

/**
 * Utility: Show Alert
 */
window.showAlert = function(message, type = 'info') {
  const alertContainer = document.querySelector('.alert-container') || document.querySelector('.content-wrapper');
  if (!alertContainer) return;
  
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
  alertDiv.role = 'alert';
  alertDiv.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  
  alertContainer.insertBefore(alertDiv, alertContainer.firstChild);
  
  // Auto dismiss after 5 seconds
  setTimeout(() => {
    const alert = bootstrap.Alert.getOrCreateInstance(alertDiv);
    alert.close();
  }, 5000);
};

/**
 * Utility: Confirm Dialog (Bootstrap 5 Modal)
 */
window.confirmAction = function(message, callback) {
  const modalHtml = `
    <div class="modal fade" id="confirmModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            ${message}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="confirmBtn">Ya, Lanjutkan</button>
          </div>
        </div>
      </div>
    </div>
  `;
  
  // Remove existing modal if any
  const existingModal = document.getElementById('confirmModal');
  if (existingModal) {
    existingModal.remove();
  }
  
  // Add new modal to body
  document.body.insertAdjacentHTML('beforeend', modalHtml);
  
  const modalElement = document.getElementById('confirmModal');
  const modal = new bootstrap.Modal(modalElement);
  
  document.getElementById('confirmBtn').addEventListener('click', function() {
    modal.hide();
    if (typeof callback === 'function') {
      callback();
    }
  });
  
  modal.show();
  
  // Clean up after modal is hidden
  modalElement.addEventListener('hidden.bs.modal', function() {
    modalElement.remove();
  });
};

/**
 * Export for global access
 */
export { initTooltips, initPopovers, initSidebar, initFormValidation };
