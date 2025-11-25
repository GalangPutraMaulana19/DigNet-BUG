/**
 * DigNet v2.0 - Main Application JavaScript
 * AdminLTE v4 + Bootstrap 5 (No jQuery)
 * 
 * Performance Optimized - Tree-shakeable, Lazy-loaded
 */

// Import only needed Bootstrap components for smaller bundle
import { Tooltip, Popover, Modal, Alert, Dropdown, Collapse } from 'bootstrap';

// Lazy load Chart.js only when needed (reduce initial bundle)
let Chart = null;
const loadChartJS = async () => {
  if (!Chart) {
    const chartModule = await import('chart.js/auto');
    Chart = chartModule.default;
    window.Chart = Chart;
  }
  return Chart;
};

// Import styles (handled by Vite)
import '../scss/app.scss';

// Make Bootstrap components available globally (minimal footprint)
window.bootstrap = { Tooltip, Popover, Modal, Alert, Dropdown, Collapse };

/**
 * DOM Ready Handler - Using native requestIdleCallback for non-critical tasks
 */
document.addEventListener('DOMContentLoaded', function() {
  // Critical: Initialize immediately
  initSidebar();
  
  // Non-critical: Use requestIdleCallback for better performance
  if ('requestIdleCallback' in window) {
    requestIdleCallback(() => {
      initTooltips();
      initPopovers();
      initFormValidation();
    });
  } else {
    // Fallback for browsers without requestIdleCallback
    setTimeout(() => {
      initTooltips();
      initPopovers();
      initFormValidation();
    }, 100);
  }
  
  // Lazy load Chart.js only if charts are present on page
  if (document.querySelector('[data-chart]') || document.querySelector('.chart-container')) {
    loadChartJS().then(() => {
      initCharts();
    });
  }
  
  // Initialize diagnosis form if present (lazy)
  if (document.querySelector('.diagnosa-form')) {
    initDiagnosisForm();
  }
});

/**
 * Initialize Bootstrap Tooltips (uses Intersection Observer for lazy init)
 */
function initTooltips() {
  const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          new Tooltip(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { rootMargin: '50px' });
    
    tooltipElements.forEach(el => observer.observe(el));
  } else {
    // Fallback: initialize all immediately
    tooltipElements.forEach(el => new Tooltip(el));
  }
}

/**
 * Initialize Bootstrap Popovers
 */
function initPopovers() {
  const popoverElements = document.querySelectorAll('[data-bs-toggle="popover"]');
  popoverElements.forEach(el => new Popover(el));
}

/**
 * Initialize Sidebar Behavior (Critical - runs immediately)
 */
function initSidebar() {
  const sidebarToggle = document.querySelector('[data-widget="pushmenu"]');
  const body = document.body;
  
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function(e) {
      e.preventDefault();
      body.classList.toggle('sidebar-collapse');
      
      // Use localStorage for state persistence
      const isCollapsed = body.classList.contains('sidebar-collapse');
      try {
        localStorage.setItem('sidebar-state', isCollapsed ? 'collapsed' : 'open');
      } catch (e) {
        // localStorage might be unavailable in some contexts
      }
    });
  }
  
  // Restore sidebar state
  try {
    const savedState = localStorage.getItem('sidebar-state');
    if (savedState === 'collapsed') {
      body.classList.add('sidebar-collapse');
    }
  } catch (e) {
    // localStorage might be unavailable
  }
  
  // Mobile: collapse sidebar by default
  if (window.innerWidth <= 991) {
    body.classList.add('sidebar-collapse');
  }
  
  // Active menu highlighting (debounced)
  highlightActiveMenu();
}

/**
 * Highlight active menu item
 */
function highlightActiveMenu() {
  const currentPath = window.location.pathname;
  const currentSearch = window.location.search;
  const menuLinks = document.querySelectorAll('.nav-sidebar .nav-link');
  
  menuLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath || href === currentSearch || 
        currentSearch.includes(href?.split('?')[1])) {
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
  
  forms.forEach(form => {
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
 * Initialize Charts (lazy loaded)
 */
function initCharts() {
  const chartContainers = document.querySelectorAll('[data-chart]');
  chartContainers.forEach(container => {
    const chartType = container.dataset.chart;
    const chartData = JSON.parse(container.dataset.chartData || '{}');
    
    if (Chart && chartType && chartData) {
      new Chart(container, {
        type: chartType,
        data: chartData,
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
    }
  });
}

/**
 * Initialize Diagnosis Form
 */
function initDiagnosisForm() {
  const diagnosisForm = document.querySelector('.diagnosa-form');
  if (!diagnosisForm) return;
  
  // Use event delegation for better performance
  diagnosisForm.addEventListener('change', function(e) {
    const target = e.target;
    
    if (target.matches('input[type="checkbox"]') || target.matches('select.kondisi')) {
      if (target.matches('select.kondisi') && target.value) {
        const row = target.closest('tr');
        const checkbox = row?.querySelector('input[type="checkbox"]');
        if (checkbox && !checkbox.checked) {
          checkbox.checked = true;
        }
      }
      updateDiagnosisButton();
    }
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
 * Utility: Show Alert (optimized)
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
    const alertInstance = Alert.getOrCreateInstance(alertDiv);
    if (alertInstance) alertInstance.close();
  }, 5000);
};

/**
 * Utility: Confirm Dialog (Bootstrap 5 Modal, lazy created)
 */
window.confirmAction = function(message, callback) {
  // Remove existing modal if any
  const existingModal = document.getElementById('confirmModal');
  if (existingModal) existingModal.remove();
  
  const modalHtml = `
    <div class="modal fade" id="confirmModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">${message}</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="confirmBtn">Ya, Lanjutkan</button>
          </div>
        </div>
      </div>
    </div>
  `;
  
  document.body.insertAdjacentHTML('beforeend', modalHtml);
  
  const modalElement = document.getElementById('confirmModal');
  const modal = new Modal(modalElement);
  
  document.getElementById('confirmBtn').addEventListener('click', function() {
    modal.hide();
    if (typeof callback === 'function') callback();
  });
  
  modal.show();
  
  // Cleanup
  modalElement.addEventListener('hidden.bs.modal', () => modalElement.remove());
};

/**
 * Performance: Lazy load images with native support fallback
 */
document.querySelectorAll('img[data-src]').forEach(img => {
  if ('loading' in HTMLImageElement.prototype) {
    img.src = img.dataset.src;
    img.loading = 'lazy';
  } else {
    // Fallback for older browsers
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          img.src = img.dataset.src;
          observer.unobserve(img);
        }
      });
    });
    observer.observe(img);
  }
});

/**
 * Export for module usage
 */
export { initTooltips, initPopovers, initSidebar, initFormValidation, loadChartJS };
