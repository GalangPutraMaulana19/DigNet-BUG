<title>Diagnosa - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="diagnosa-page-header mb-4">
    <h2 class="diagnosa-title text-primary">
        <i class="fa-solid fa-stethoscope me-3"></i>
        Diagnosis Gangguan IndiHome
    </h2>
    <p class="diagnosa-subtitle text-muted">
        Sistem pakar untuk mendiagnosis gangguan perangkat IndiHome dengan metode Forward Chaining dan Certainty Factor
    </p>
</div>

<style>
/* Base Styles */
.diagnosa-page-header,
.diagnosa-form-container,
.hasil-container,
.diagnosa-page-header *,
.diagnosa-form-container *,
.hasil-container * {
    box-sizing: border-box;
}

/* Page Header Styling */
.diagnosa-page-header .diagnosa-title {
    font-size: 1.5rem;
    font-weight: 700;
}

.diagnosa-page-header .diagnosa-subtitle {
    font-size: 1.1rem;
    margin-top: 1rem;
}

/* Premium SaaS Form Styling */
.diagnosa-form-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    overflow: visible; /* Changed from hidden to allow dropdown menus to overflow */
}

.diagnosa-form-header {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 16px 16px 0 0;
}

.diagnosa-form-body {
    padding: 1.5rem;
}

.gejala-card {
    background: #fafafa;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    transition: all 0.2s ease;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
    position: relative; /* For proper stacking context */
    overflow: visible; /* Allow dropdown to overflow */
    z-index: 1; /* Base z-index */
}

/* When dropdown is open inside this card, elevate the entire card above others */
.gejala-card.dropdown-active {
    z-index: 1000 !important;
}

/* Only apply hover effects on devices that support hover */
@media (hover: hover) {
    .gejala-card:hover {
        border-color: #E21E2C;
        box-shadow: 0 2px 8px rgba(226, 30, 44, 0.1);
        transform: translateY(-1px);
    }
}

.gejala-number {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.gejala-code {
    background: #f0f0f0;
    color: #525252;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    flex-shrink: 0;
}

.gejala-text {
    flex: 1;
    min-width: 200px;
    font-weight: 500;
    color: #262626;
    line-height: 1.4;
}

.gejala-select-wrapper {
    flex: 0 0 auto;
    min-width: 180px;
    position: relative; /* Ensure dropdown can position relative to this */
    z-index: 1; /* Base z-index for stacking context */
}

/* When dropdown is open, increase wrapper z-index to bring it above other cards */
.gejala-select-wrapper:has(.kondisi-dropdown.is-open) {
    z-index: 100;
}

/* Hidden native select for form submission */
.premium-select {
    position: absolute;
    opacity: 0;
    pointer-events: none;
    width: 0;
    height: 0;
}

/* Premium Custom Dropdown Component */
.kondisi-dropdown {
    position: relative;
    width: 100%;
    font-family: inherit;
}

.kondisi-dropdown-trigger {
    width: 100%;
    padding: 0.625rem 1rem;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    min-height: 42px;
    text-align: left;
}

.kondisi-dropdown-trigger:hover {
    border-color: #a3a3a3;
}

.kondisi-dropdown-trigger:focus {
    outline: none;
    border-color: #E21E2C;
    box-shadow: 0 0 0 3px rgba(226, 30, 44, 0.1);
}

.kondisi-dropdown.is-open .kondisi-dropdown-trigger {
    border-color: #E21E2C;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    box-shadow: 0 0 0 3px rgba(226, 30, 44, 0.1);
}

.kondisi-dropdown-value {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.kondisi-dropdown-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
    border: 1px solid rgba(0,0,0,0.1);
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.kondisi-dropdown-text {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #262626;
}

.kondisi-dropdown-arrow {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    color: #737373;
}

.kondisi-dropdown.is-open .kondisi-dropdown-arrow {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.kondisi-dropdown-menu {
    position: absolute;
    top: calc(100% - 2px);
    left: 0;
    right: 0;
    width: 100%; /* Explicit width to match trigger */
    background: white;
    border: 2px solid #E21E2C;
    border-top: none;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    box-shadow: 0 8px 24px rgba(226, 30, 44, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 9999; /* High z-index to ensure it appears above all elements */
    max-height: 280px;
    overflow-y: auto;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-8px);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.kondisi-dropdown.is-open .kondisi-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Custom scrollbar for dropdown menu */
.kondisi-dropdown-menu::-webkit-scrollbar {
    width: 6px;
}

.kondisi-dropdown-menu::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 0 0 6px 0;
}

.kondisi-dropdown-menu::-webkit-scrollbar-thumb {
    background: #E21E2C;
    border-radius: 3px;
}

/* Dropdown Options */
.kondisi-dropdown-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.15s ease;
    border-left: 3px solid transparent;
}

.kondisi-dropdown-option:hover {
    background: #f5f5f5;
    border-left-color: #E21E2C;
}

.kondisi-dropdown-option.is-selected {
    background: rgba(226, 30, 44, 0.08);
    border-left-color: #E21E2C;
}

.kondisi-dropdown-option:last-child {
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

.kondisi-option-color {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    flex-shrink: 0;
    border: 2px solid rgba(0,0,0,0.1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1), inset 0 1px 0 rgba(255,255,255,0.5);
    transition: transform 0.15s ease;
}

.kondisi-dropdown-option:hover .kondisi-option-color {
    transform: scale(1.1);
}

.kondisi-option-text {
    flex: 1;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
}

.kondisi-dropdown-option:hover .kondisi-option-text {
    color: #E21E2C;
}

.kondisi-option-badge {
    font-size: 0.65rem;
    font-weight: 600;
    padding: 0.2rem 0.5rem;
    border-radius: 20px;
    background: rgba(0,0,0,0.05);
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

/* Color-coded option indicator colors */
.kondisi-color-0 { background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%); } /* Pilih */
.kondisi-color-1 { background: linear-gradient(135deg, #cc66ff 0%, #a855f7 100%); } /* Pasti Ya - Purple */
.kondisi-color-2 { background: linear-gradient(135deg, #019AFF 0%, #0284c7 100%); } /* Hampir pasti ya - Blue */
.kondisi-color-3 { background: linear-gradient(135deg, #00CBFD 0%, #06b6d4 100%); } /* Kemungkinan besar ya - Cyan */
.kondisi-color-4 { background: linear-gradient(135deg, #00FEFE 0%, #14b8a6 100%); } /* Mungkin ya - Teal */
.kondisi-color-5 { background: linear-gradient(135deg, #A4F804 0%, #84cc16 100%); } /* Tidak tahu - Lime */
.kondisi-color-6 { background: linear-gradient(135deg, #FFFC00 0%, #eab308 100%); } /* Mungkin tidak - Yellow */
.kondisi-color-7 { background: linear-gradient(135deg, #FDCD01 0%, #f59e0b 100%); } /* Kemungkinan besar tidak - Amber */
.kondisi-color-8 { background: linear-gradient(135deg, #FD9A01 0%, #ea580c 100%); } /* Hampir pasti tidak - Orange */
.kondisi-color-9 { background: linear-gradient(135deg, #FB6700 0%, #dc2626 100%); } /* Pasti tidak - Red/Orange */

/* Mobile responsive for dropdown */
@media (max-width: 768px) {
    .kondisi-dropdown-trigger {
        padding: 0.75rem 1rem;
        min-height: 48px;
        font-size: 0.9rem;
    }
    
    .kondisi-dropdown-menu {
        max-height: 240px;
    }
    
    .kondisi-dropdown-option {
        padding: 0.875rem 1rem;
    }
    
    .kondisi-option-color {
        width: 18px;
        height: 18px;
    }
}

@media (max-width: 480px) {
    .kondisi-dropdown-trigger {
        padding: 0.625rem 0.875rem;
    }
    
    .kondisi-dropdown-text {
        font-size: 0.8rem;
    }
    
    .kondisi-dropdown-option {
        padding: 0.75rem 0.875rem;
        gap: 0.5rem;
    }
    
    .kondisi-option-text {
        font-size: 0.8rem;
    }
    
    .kondisi-option-badge {
        display: none;
    }
}

.submit-section {
    padding: 1.5rem;
    background: #f5f5f5;
    border-top: 1px solid #e5e5e5;
    display: flex;
    justify-content: center;
}

.btn-diagnosa-submit {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    border: none;
    padding: 1rem 3rem;
    font-size: 1.125rem;
    font-weight: 600;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(226, 30, 44, 0.3);
    cursor: pointer;
}

.btn-diagnosa-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(226, 30, 44, 0.4);
}

.btn-diagnosa-submit:active {
    transform: translateY(0);
}

/* Mobile-first responsive approach - Prevent glitches */
/* Responsive adjustments for tablets */
@media (max-width: 991px) {
    .diagnosa-form-container {
        margin: 0 -0.5rem;
        width: calc(100% + 1rem);
        border-radius: 12px;
    }
    
    .gejala-card {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
        padding: 1rem;
    }
    
    .gejala-text {
        min-width: unset;
        width: 100%;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }
    
    .gejala-select-wrapper {
        width: 100%;
        min-width: unset;
    }
}

/* Mobile specific adjustments */
@media (max-width: 768px) {
    .diagnosa-page-header .diagnosa-title {
        font-size: 1.25rem;
        word-break: break-word;
    }
    
    .diagnosa-page-header .diagnosa-title i {
        display: block;
        margin-bottom: 0.5rem;
    }
    
    .diagnosa-page-header .diagnosa-subtitle {
        font-size: 0.9rem;
    }
    
    .diagnosa-form-container {
        border-radius: 10px;
        overflow: visible; /* Allow dropdown to overflow */
    }
    
    .diagnosa-form-header {
        padding: 1.25rem 1rem;
    }
    
    .diagnosa-form-header h3 {
        font-size: 1.125rem;
    }
    
    .diagnosa-form-header p {
        font-size: 0.875rem;
    }
    
    .gejala-card {
        padding: 0.875rem;
        margin-bottom: 0.625rem;
        border-radius: 10px;
    }
    
    .gejala-number {
        width: 32px;
        height: 32px;
        font-size: 0.8125rem;
    }
    
    .gejala-code {
        font-size: 0.6875rem;
        padding: 0.2rem 0.625rem;
    }
    
    .gejala-text {
        font-size: 0.875rem;
        line-height: 1.5;
    }
    
    .premium-select {
        width: 100%;
        padding: 0.75rem 2.5rem 0.75rem 0.875rem;
        font-size: 0.8125rem;
        min-height: 44px; /* Touch-friendly height */
    }
    
    .btn-diagnosa-submit {
        width: 100%;
        justify-content: center;
        padding: 0.875rem 1.25rem;
        font-size: 1rem;
        min-height: 48px;
    }
    
    .diagnosa-form-body {
        padding: 1rem 0.875rem;
    }
    
    .submit-section {
        padding: 1rem;
    }
    
    /* Fix alert info on mobile */
    .diagnosa-form-body .alert {
        padding: 0.875rem;
        font-size: 0.875rem;
    }
    
    .diagnosa-form-body .alert .d-flex {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .diagnosa-form-body .alert i {
        align-self: flex-start;
    }
}

/* Extra small devices - prevent content overflow */
@media (max-width: 480px) {
    .diagnosa-form-container {
        margin: 0 -0.75rem;
        width: calc(100% + 1.5rem);
        border-radius: 8px;
    }
    
    .diagnosa-form-header {
        padding: 1rem;
    }
    
    .diagnosa-form-header h3 {
        font-size: 1rem;
        word-break: break-word;
    }
    
    .diagnosa-form-header h3 i {
        display: block;
        margin-bottom: 0.5rem;
    }
    
    .gejala-card {
        padding: 0.75rem;
        gap: 0.625rem;
    }
    
    .gejala-number {
        width: 28px;
        height: 28px;
        font-size: 0.75rem;
    }
    
    .gejala-code {
        font-size: 0.625rem;
        padding: 0.15rem 0.5rem;
    }
    
    .gejala-text {
        font-size: 0.8125rem;
        line-height: 1.45;
    }
    
    .premium-select {
        font-size: 0.8125rem;
        padding: 0.625rem 2.25rem 0.625rem 0.75rem;
    }
    
    .btn-diagnosa-submit {
        font-size: 0.9375rem;
        padding: 0.875rem 1rem;
    }
    
    .diagnosa-form-body {
        padding: 0.875rem 0.75rem;
    }
    
    .submit-section {
        padding: 0.875rem 0.75rem;
    }
}

/* Very small devices (320px-360px) */
@media (max-width: 380px) {
    .diagnosa-form-container {
        margin: 0 -1rem;
        width: calc(100% + 2rem);
        border-radius: 0;
    }
    
    .diagnosa-form-header h3 {
        font-size: 0.9375rem;
    }
    
    .gejala-text {
        font-size: 0.75rem;
    }
    
    .premium-select {
        font-size: 0.75rem;
    }
}

/* Premium Results Styling */
.hasil-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 1.5rem;
    width: 100%;
    max-width: 100%;
}

.hasil-header {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.hasil-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    word-break: break-word;
}

.hasil-body {
    padding: 1.5rem;
    overflow-x: hidden;
    overflow-y: visible;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.hasil-main-card {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
    border: 2px solid #10B981;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.hasil-gangguan {
    font-size: 1.75rem;
    font-weight: 800;
    color: #059669;
    margin-bottom: 0.5rem;
    word-break: break-word;
    overflow-wrap: break-word;
    line-height: 1.3;
}

.hasil-persentase {
    font-size: 1.25rem;
    color: #065F46;
    font-weight: 600;
    word-break: break-word;
}

.gejala-hasil-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #fafafa;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    border: 1px solid #e5e5e5;
    transition: all 0.2s ease;
    flex-wrap: wrap;
}

.gejala-hasil-item:hover {
    background: #f0f0f0;
    border-color: #d4d4d4;
}

/* Premium card styling for results */
.hasil-body .card {
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.hasil-body .card-body {
    padding: 1.25rem;
}

.hasil-body .card-body p {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.7;
    color: #374151;
    font-size: 0.95rem;
}

.hasil-body .card-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.75rem;
}

/* Saran Penanganan styling */
.saran-content {
    margin-top: 1rem;
    line-height: 1.7;
    color: #374151;
}

.saran-content ol {
    margin: 0;
    padding-left: 1.5rem;
    counter-reset: saran-counter;
    list-style: none;
}

.saran-content ol li {
    position: relative;
    padding: 0.5rem 0 0.5rem 0.5rem;
    margin-bottom: 0.5rem;
    line-height: 1.6;
    border-bottom: 1px solid #f0f0f0;
    counter-increment: saran-counter;
}

.saran-content ol li:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.saran-content ol li::before {
    content: counter(saran-counter) ".";
    position: absolute;
    left: -1.5rem;
    color: #F59E0B;
    font-weight: 700;
    font-size: 0.95rem;
}

.saran-content p {
    margin: 0;
    line-height: 1.7;
}

/* Detail Gangguan styling */
.detail-content {
    margin-top: 1rem;
    line-height: 1.7;
    color: #374151;
}

.detail-content p {
    margin: 0;
    line-height: 1.7;
}

/* List group items in results */
.hasil-body .list-group-item {
    border: none;
    border-radius: 8px !important;
    margin-bottom: 0.5rem;
    background: #fafafa;
    transition: all 0.2s ease;
}

.hasil-body .list-group-item:hover {
    background: #f0f0f0;
}

/* Mobile responsive for results - Tablet */
@media (max-width: 991px) {
    .hasil-container {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
        width: calc(100% + 1rem);
        border-radius: 12px;
    }
    
    .hasil-main-card .row {
        flex-direction: column-reverse;
    }
    
    .hasil-main-card .col-md-4 {
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .hasil-main-card .col-md-8 {
        text-align: center;
    }
}

/* Mobile specific results */
@media (max-width: 768px) {
    .hasil-container {
        border-radius: 10px;
    }
    
    .hasil-header {
        flex-direction: column;
        text-align: center;
        padding: 1.25rem 1rem;
        gap: 0.75rem;
    }
    
    .hasil-header h2 {
        font-size: 1.25rem;
    }
    
    .hasil-header .btn {
        width: 100%;
        justify-content: center;
    }
    
    .hasil-body {
        padding: 1rem;
    }
    
    .hasil-main-card {
        padding: 1rem;
        border-radius: 10px;
    }
    
    .hasil-gangguan {
        font-size: 1.25rem;
        text-align: center;
    }
    
    .hasil-persentase {
        font-size: 1rem;
        text-align: center;
    }
    
    .gejala-hasil-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
        padding: 0.875rem;
    }
    
    .gejala-hasil-item > span:first-child {
        align-self: flex-start;
    }
    
    .gejala-hasil-item > span:nth-child(2) {
        margin-top: -0.25rem;
    }
    
    .gejala-hasil-item > span:nth-child(3) {
        width: 100%;
        font-size: 0.9rem;
        line-height: 1.4;
        word-break: break-word;
    }
    
    .gejala-hasil-item > span:last-child {
        align-self: flex-start;
        margin-top: 0.25rem;
    }
    
    .hasil-body .card {
        border-radius: 10px !important;
        margin-bottom: 1rem !important;
    }
    
    .hasil-body .card-body {
        padding: 1rem;
    }
    
    .hasil-body .card-body p {
        font-size: 0.875rem;
        line-height: 1.6;
    }
    
    .hasil-body .card-title {
        font-size: 0.95rem;
    }
    
    .hasil-body .list-group-item {
        padding: 0.875rem;
        font-size: 0.875rem;
    }
    
    .hasil-body .list-group-item .badge {
        margin-top: 0.5rem;
    }
    
    .hasil-main-card .col-md-4 img {
        max-width: 140px !important;
    }
    
    /* Action buttons on mobile */
    .hasil-body .text-center .btn {
        display: block;
        width: 100%;
        margin-bottom: 0.5rem;
        margin-right: 0 !important;
    }
    
    .hasil-body .text-center .btn:last-child {
        margin-bottom: 0;
    }
}

/* Extra small devices for results */
@media (max-width: 480px) {
    .hasil-container {
        margin-left: -0.75rem;
        margin-right: -0.75rem;
        width: calc(100% + 1.5rem);
        border-radius: 8px;
    }
    
    .hasil-header h2 {
        font-size: 1.1rem;
    }
    
    .hasil-gangguan {
        font-size: 1.1rem;
    }
    
    .hasil-persentase {
        font-size: 0.9rem;
    }
    
    .gejala-hasil-item {
        padding: 0.75rem;
    }
    
    .hasil-body .card-body p {
        font-size: 0.8125rem;
    }
    
    .hasil-main-card .col-md-4 img {
        max-width: 100px !important;
    }
}

/* Very small devices for results */
@media (max-width: 380px) {
    .hasil-container {
        margin-left: -1rem;
        margin-right: -1rem;
        width: calc(100% + 2rem);
        border-radius: 0;
    }
    
    .hasil-header {
        padding: 1rem;
    }
    
    .hasil-header h2 {
        font-size: 1rem;
    }
    
    .hasil-body {
        padding: 0.875rem;
    }
}

/* Kemungkinan Lain Section Styling */
.kemungkinan-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem; /* Increased gap between items */
    margin-top: 0.5rem; /* Space from heading */
}

.kemungkinan-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.25rem; /* Increased padding */
    background: #fafafa;
    border-radius: 10px; /* Slightly larger radius */
    border: 1px solid #e5e5e5;
    transition: all 0.2s ease;
    gap: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04); /* Subtle shadow */
}

/* Only apply hover effects on devices that support hover */
@media (hover: hover) {
    .kemungkinan-item:hover {
        background: #f0f0f0;
        border-color: #EF4444;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.1);
    }
}

.kemungkinan-content {
    display: flex;
    align-items: center;
    gap: 0.75rem; /* Increased gap between icon and text */
    flex: 1;
    min-width: 0;
    padding: 0.25rem 0; /* Vertical padding for content */
}

.kemungkinan-content i {
    flex-shrink: 0;
    font-size: 0.875rem;
    color: #EF4444;
}

.kemungkinan-text {
    font-weight: 500;
    color: #374151;
    word-break: break-word;
    overflow-wrap: break-word;
    line-height: 1.5; /* Increased line height */
    font-size: 0.9375rem;
}

.kemungkinan-badge {
    background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
    color: white;
    padding: 0.5rem 0.875rem; /* Increased padding */
    border-radius: 20px;
    font-size: 0.8125rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Kemungkinan Lain Mobile */
@media (max-width: 768px) {
    .kemungkinan-list {
        gap: 0.625rem;
    }
    
    .kemungkinan-item {
        flex-direction: column;
        align-items: flex-start;
        padding: 1rem;
        gap: 0.75rem; /* Increased gap for mobile */
    }
    
    .kemungkinan-content {
        width: 100%;
        gap: 0.625rem;
        padding: 0;
    }
    
    .kemungkinan-text {
        font-size: 0.875rem;
        line-height: 1.5;
    }
    
    .kemungkinan-badge {
        align-self: flex-start;
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
}

@media (max-width: 480px) {
    .kemungkinan-item {
        padding: 0.875rem;
        gap: 0.625rem;
    }
    
    .kemungkinan-text {
        font-size: 0.8125rem;
    }
    
    .kemungkinan-badge {
        padding: 0.3rem 0.625rem;
    }
}

@media (max-width: 480px) {
    .diagnosa-page-header .diagnosa-title {
        font-size: 1.125rem;
    }
    
    .diagnosa-page-header .diagnosa-subtitle {
        font-size: 0.8125rem;
    }
}
</style>

<?php
/**
 * Convert numbered text into an ordered list HTML
 * Handles patterns like "1. text", "1) text", "1 text", etc.
 * @param string $text The text to convert
 * @return string HTML with ordered list or paragraph if no numbered items found
 */
function formatSaranToList($text) {
    if (empty($text)) {
        return '<p>-</p>';
    }
    
    // Escape the text first for security
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    
    // Split by common numbered patterns (1. or 1) or 1: followed by text)
    // Also handle newlines and multiple spaces
    $patterns = [
        '/(\d+)\.\s+/',    // "1. " pattern
        '/(\d+)\)\s+/',    // "1) " pattern
        '/(\d+):\s+/',     // "1: " pattern
        '/\n(\d+)\s+/',    // newline followed by number
    ];
    
    // Try to detect if the text has numbered items
    $hasNumberedItems = false;
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $text)) {
            $hasNumberedItems = true;
            break;
        }
    }
    
    if (!$hasNumberedItems) {
        // Check for simple "1 " at start of lines
        if (preg_match('/^\d+\s/', $text) || preg_match('/\n\d+\s/', $text)) {
            $hasNumberedItems = true;
        }
    }
    
    if ($hasNumberedItems) {
        // Split the text into items
        // First, normalize line breaks
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        
        // Split by numbered pattern at start or after newline
        $items = preg_split('/(?:^|\n)\s*\d+[\.\)\:]?\s*/', $text, -1, PREG_SPLIT_NO_EMPTY);
        
        if (count($items) > 1 || (count($items) == 1 && strlen(trim($items[0])) > 0)) {
            $html = '<ol>';
            foreach ($items as $item) {
                $item = trim($item);
                if (!empty($item)) {
                    $html .= '<li>' . $item . '</li>';
                }
            }
            $html .= '</ol>';
            return $html;
        }
    }
    
    // If no numbered items detected, return as paragraph
    // But still handle line breaks
    $text = nl2br($text);
    return '<p>' . $text . '</p>';
}

switch ($_GET['act'] ?? '') {

  default:
    if ($_POST['submit'] ?? false) {
      $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
      date_default_timezone_set("Asia/Jakarta");
      $inptanggal = date('Y-m-d H:i:s');

      $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1');
      $arincident = array();

      // Sanitize and validate input
      $kondisi_input = isset($_POST['kondisi']) && is_array($_POST['kondisi']) ? $_POST['kondisi'] : [];
      for ($i = 0; $i < count($kondisi_input); $i++) {
        $arkondisi = explode("_", $kondisi_input[$i]);
        if (strlen($kondisi_input[$i]) > 1 && count($arkondisi) >= 2) {
          // Only accept numeric values
          $kode = intval($arkondisi[0]);
          $nilai = intval($arkondisi[1]);
          if ($kode > 0 && $nilai >= 0 && $nilai <= 9) {
            $arincident[$kode] = $nilai;
          }
        }
      }

      $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id+0");
      while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
        $arkondisitext[$rkondisi['id']] = htmlspecialchars($rkondisi['kondisi'], ENT_QUOTES, 'UTF-8');
      }

      $sqlpkt = mysqli_query($conn, "SELECT * FROM repair order by kode_repair+0");
      while ($rpkt = mysqli_fetch_array($sqlpkt)) {
        $arpkt[$rpkt['kode_repair']] = $rpkt['nama_repair'];
        $ardpkt[$rpkt['kode_repair']] = $rpkt['det_repair'];
        $arspkt[$rpkt['kode_repair']] = $rpkt['srn_repair'];
        $argpkt[$rpkt['kode_repair']] = $rpkt['gambar'];
      }

      //print_r($arkondisitext);
// -------- perhitungan certainty factor (CF) ---------
// --------------------- START ------------------------
      $sqlrepair = mysqli_query($conn, "SELECT * FROM repair order by kode_repair");
      $arrepair = array();
      while ($rrepair = mysqli_fetch_array($sqlrepair)) {
        $cftotal_temp = 0;
        $cf = 0;
        // Use prepared statement for inner query
        $kode_repair_int = intval($rrepair['kode_repair']);
        $stmt_incident = mysqli_prepare($conn, "SELECT * FROM basis_pengetahuan WHERE kode_repair = ?");
        mysqli_stmt_bind_param($stmt_incident, "i", $kode_repair_int);
        mysqli_stmt_execute($stmt_incident);
        $sqlincident = mysqli_stmt_get_result($stmt_incident);
        $cflama = 0;
        while ($rincident = mysqli_fetch_array($sqlincident)) {
          // Use validated arincident array
          foreach ($arincident as $incident_key => $incident_value) {
            if ($rincident['kode_incident'] == $incident_key) {
              $bobot_index = min(max(intval($incident_value), 0), 9);
              $cf = ($rincident['mb'] - $rincident['md']) * $arbobot[$bobot_index];
              if (($cf >= 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 - $cflama));
              }
              if ($cf * $cflama < 0) {
                $cflama = ($cflama + $cf) / (1 - min(abs($cflama), abs($cf)));
              }
              if (($cf < 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 + $cflama));
              }
            }
          }
        }
        mysqli_stmt_close($stmt_incident);
        if ($cflama > 0) {
          $arrepair += array($rrepair['kode_repair'] => number_format($cflama, 4));
        }
      }

      arsort($arrepair);

      $inpincident = serialize($arincident);
      $inprepair = serialize($arrepair);

      $np1 = 0;
      $idpkt1 = [];
      $vlpkt1 = [];
      foreach ($arrepair as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = intval($key1);
        $vlpkt1[$np1] = floatval($value1);
      }

      // Use prepared statement for insert
      $hasil_id = $idpkt1[1] ?? 0;
      $hasil_nilai = $vlpkt1[1] ?? 0;
      $stmt_insert = mysqli_prepare($conn, "INSERT INTO hasil (tanggal, incident, repair, hasil_id, hasil_nilai) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt_insert, "sssid", $inptanggal, $inpincident, $inprepair, $hasil_id, $hasil_nilai);
      mysqli_stmt_execute($stmt_insert);
      mysqli_stmt_close($stmt_insert);
// --------------------- END -------------------------

      // Modern Results Display
      echo "<div class='hasil-container'>
        <div class='hasil-header'>
            <h2><i class='fa-solid fa-clipboard-check me-2'></i> Hasil Diagnosis</h2>
            <button id='print' onClick='window.print();' class='btn btn-light' data-bs-toggle='tooltip' title='Cetak hasil diagnosa'>
                <i class='fa-solid fa-print me-2'></i> Cetak
            </button>
        </div>
        <div class='hasil-body'>";
      
      // Gejala yang dipilih section
      echo "<div class='mb-4'>
                <h5 class='mb-3' style='color: #525252; font-weight: 600;'>
                    <i class='fa-solid fa-list-check me-2'></i> Gejala yang Dipilih
                </h5>";
      
      $ig = 0;
      foreach ($arincident as $key => $value) {
        $kondisi = intval($value);
        $ig++;
        $incident = intval($key);
        // Use prepared statement
        $stmt4 = mysqli_prepare($conn, "SELECT * FROM incident WHERE kode_incident = ?");
        mysqli_stmt_bind_param($stmt4, "i", $incident);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);
        $r4 = mysqli_fetch_array($result4);
        mysqli_stmt_close($stmt4);
        
        if ($r4) {
          echo "<div class='gejala-hasil-item'>
                    <span class='gejala-number' style='width: 28px; height: 28px; font-size: 0.75rem;'>$ig</span>
                    <span class='gejala-code'>G" . str_pad(htmlspecialchars($r4['kode_incident'], ENT_QUOTES, 'UTF-8'), 3, '0', STR_PAD_LEFT) . "</span>
                    <span style='flex: 1; font-weight: 500;'>" . htmlspecialchars($r4['nama_incident'], ENT_QUOTES, 'UTF-8') . "</span>
                    <span class='badge' style='background-color: " . ($arcolor[$kondisi] ?? '#e5e5e5') . "; color: #262626; padding: 0.5rem 0.75rem; border-radius: 20px;'>" . ($arkondisitext[$kondisi] ?? '-') . "</span>
                </div>";
        }
      }
      echo "</div>";
      
      $np = 0;
      $idpkt = [];
      $nmpkt = [];
      $vlpkt = [];
      foreach ($arrepair as $key => $value) {
        $np++;
        $idpkt[$np] = $key;
        $nmpkt[$np] = $arpkt[$key] ?? '';
        $vlpkt[$np] = $value;
      }
      if (isset($argpkt[$idpkt[1]]) && $argpkt[$idpkt[1]]) {
        $gambar = 'gambar/repair/' . $argpkt[$idpkt[1]];
      } else {
        $gambar = 'gambar/noimage.png';
      }
      
      // Main diagnosis result
      echo "<div class='hasil-main-card'>
                <div class='row align-items-center'>
                    <div class='col-md-8'>
                        <span class='badge mb-2' style='background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 0.5rem 1rem; border-radius: 20px;'>
                            <i class='fa-solid fa-check-circle me-1'></i> Hasil Terdeteksi
                        </span>
                        <div class='hasil-gangguan'>" . htmlspecialchars($nmpkt[1] ?? 'Tidak terdeteksi', ENT_QUOTES, 'UTF-8') . "</div>
                        <div class='hasil-persentase'>
                            <i class='fa-solid fa-chart-pie me-1'></i> Tingkat Kepastian: <strong>" . round($vlpkt[1] ?? 0, 2) . "%</strong> (" . ($vlpkt[1] ?? 0) . ")
                        </div>
                    </div>
                    <div class='col-md-4 text-center mt-3 mt-md-0'>
                        <img class='img-fluid rounded' style='max-width: 180px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px;' src='$gambar' alt='Gambar gangguan'>
                    </div>
                </div>
            </div>";
      
      // Detail section
      echo "<div class='card mb-3' style='border-left: 4px solid #3B82F6; border-radius: 12px;'>
                <div class='card-body'>
                    <h5 class='card-title mb-3' style='color: #3B82F6;'>
                        <i class='fa-solid fa-circle-info me-2'></i> Detail Gangguan
                    </h5>
                    <div class='detail-content'>" . nl2br(htmlspecialchars($ardpkt[$idpkt[1]] ?? '', ENT_QUOTES, 'UTF-8')) . "</div>
                </div>
            </div>";
      
      // Saran section - use formatSaranToList for proper ordered list formatting
      echo "<div class='card mb-3' style='border-left: 4px solid #F59E0B; border-radius: 12px;'>
                <div class='card-body'>
                    <h5 class='card-title mb-3' style='color: #F59E0B;'>
                        <i class='fa-solid fa-lightbulb me-2'></i> Saran Penanganan
                    </h5>
                    <div class='saran-content'>" . formatSaranToList($arspkt[$idpkt[1]] ?? '') . "</div>
                </div>
            </div>";
      
      // Other possibilities
      if (count($idpkt) > 1) {
        echo "<div class='card kemungkinan-lain-card' style='border-left: 4px solid #EF4444; border-radius: 12px;'>
                    <div class='card-body'>
                        <h5 class='card-title mb-3' style='color: #EF4444;'>
                            <i class='fa-solid fa-list me-2'></i> Kemungkinan Lain
                        </h5>
                        <div class='kemungkinan-list'>";
        
        for ($ipl = 2; $ipl <= count($idpkt); $ipl++) {
          if (isset($nmpkt[$ipl])) {
            echo "<div class='kemungkinan-item'>
                        <div class='kemungkinan-content'>
                            <i class='fa-solid fa-caret-right text-danger'></i>
                            <span class='kemungkinan-text'>" . htmlspecialchars($nmpkt[$ipl], ENT_QUOTES, 'UTF-8') . "</span>
                        </div>
                        <span class='kemungkinan-badge'>" . round($vlpkt[$ipl], 2) . "%</span>
                    </div>";
          }
        }
        
        echo "</div></div></div>";
      }
      
      // Action buttons
      echo "<div class='text-center mt-4'>
                <a href='?module=diagnosa' class='btn btn-primary me-2' style='border-radius: 10px; padding: 0.75rem 1.5rem;'>
                    <i class='fa-solid fa-rotate-left me-2'></i> Diagnosa Ulang
                </a>
                <a href='?module=riwayat' class='btn btn-outline-secondary' style='border-radius: 10px; padding: 0.75rem 1.5rem;'>
                    <i class='fa-solid fa-clock-rotate-left me-2'></i> Lihat Riwayat
                </a>
            </div>";
      
      echo "</div></div>";
    } else {
      echo "
<div class='diagnosa-form-container'>
    <div class='diagnosa-form-header'>
        <h3 class='mb-0'><i class='fa-solid fa-stethoscope me-2'></i> Formulir Diagnosa Gangguan</h3>
        <p class='mb-0 mt-2 opacity-75'>Pilih gejala sesuai kondisi perangkat IndiHome Anda</p>
    </div>
    <form name='text_form' method='POST' action='?module=diagnosa'>
        <div class='diagnosa-form-body'>";
      
      echo "<div class='alert alert-info mb-4' style='border-radius: 12px; border-left: 4px solid #3B82F6;'>
                <div class='d-flex align-items-start'>
                    <i class='fa-solid fa-circle-info me-3 mt-1' style='color: #3B82F6; font-size: 1.25rem;'></i>
                    <div>
                        <strong>Petunjuk Penggunaan:</strong><br>
                        Pilih tingkat kepastian gejala dari \"Pasti Tidak\" sampai \"Pasti Ya\" untuk setiap gejala yang sesuai dengan kondisi perangkat IndiHome (ODP, ONT, STB, Telepon). Setelah selesai, klik tombol <strong>Proses Diagnosa</strong>.
                    </div>
                </div>
            </div>";

      $sql3 = mysqli_query($conn, "SELECT * FROM incident order by kode_incident");
      $i = 0;
      
      // Get all kondisi options once
      $kondisiOptions = [];
      $kondisiQuery = mysqli_query($conn, "select * from kondisi order by id");
      while ($kRow = mysqli_fetch_array($kondisiQuery)) {
        $kondisiOptions[] = [
          'id' => $kRow['id'],
          'text' => $kRow['kondisi']
        ];
      }
      
      // Kondisi color labels
      $kondisiLabels = [
        0 => 'Pilih',
        1 => 'Pasti Ya',
        2 => 'Hampir Pasti Ya',
        3 => 'Mungkin Besar Ya',
        4 => 'Mungkin Ya',
        5 => 'Tidak Tahu',
        6 => 'Mungkin Tidak',
        7 => 'Mungkin Besar Tidak',
        8 => 'Hampir Pasti Tidak',
        9 => 'Pasti Tidak'
      ];
      
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        $kodeIncident = $r3['kode_incident'];
        
        echo "<div class='gejala-card'>
                <div class='gejala-number'>$i</div>
                <span class='gejala-code'>G" . str_pad($kodeIncident, 3, '0', STR_PAD_LEFT) . "</span>
                <div class='gejala-text'>" . htmlspecialchars($r3['nama_incident'], ENT_QUOTES, 'UTF-8') . "</div>
                <div class='gejala-select-wrapper'>
                    <!-- Hidden native select for form submission -->
                    <select name='kondisi[]' id='sl$i' class='premium-select'>
                        <option data-id='0' value='0'>Pilih jika sesuai</option>";
        
        foreach ($kondisiOptions as $opt) {
          echo "<option data-id='" . htmlspecialchars($opt['id'], ENT_QUOTES, 'UTF-8') . "' value='" . $kodeIncident . "_" . $opt['id'] . "'>" . htmlspecialchars($opt['text'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        
        echo "</select>
                    <!-- Custom Premium Dropdown -->
                    <div class='kondisi-dropdown' data-select-id='sl$i'>
                        <button type='button' class='kondisi-dropdown-trigger' aria-haspopup='listbox' aria-expanded='false'>
                            <span class='kondisi-dropdown-value'>
                                <span class='kondisi-dropdown-color kondisi-color-0'></span>
                                <span class='kondisi-dropdown-text'>Pilih jika sesuai</span>
                            </span>
                            <svg class='kondisi-dropdown-arrow' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'></path>
                            </svg>
                        </button>
                        <div class='kondisi-dropdown-menu' role='listbox'>
                            <div class='kondisi-dropdown-option is-selected' data-value='0' data-id='0' role='option'>
                                <span class='kondisi-option-color kondisi-color-0'></span>
                                <span class='kondisi-option-text'>Pilih jika sesuai</span>
                                <span class='kondisi-option-badge'>Default</span>
                            </div>";
        
        foreach ($kondisiOptions as $idx => $opt) {
          $optId = intval($opt['id']);
          $optText = htmlspecialchars($opt['text'], ENT_QUOTES, 'UTF-8');
          $optValue = $kodeIncident . "_" . $opt['id'];
          $labelText = $kondisiLabels[$optId] ?? '';
          
          echo "<div class='kondisi-dropdown-option' data-value='$optValue' data-id='$optId' role='option'>
                    <span class='kondisi-option-color kondisi-color-$optId'></span>
                    <span class='kondisi-option-text'>$optText</span>
                    <span class='kondisi-option-badge'>$labelText</span>
                </div>";
        }
        
        echo "</div>
                    </div>
                </div>
              </div>";
      }
      echo "</div>
        <div class='submit-section'>
            <button type='submit' name='submit' value='1' class='btn-diagnosa-submit' data-bs-toggle='tooltip' data-bs-placement='top' title='Klik untuk melihat hasil diagnosa'>
                <i class='fa-solid fa-magnifying-glass-plus'></i>
                Proses Diagnosa
            </button>
        </div>
    </form>
</div>

<!-- Custom Dropdown JavaScript -->
<script>
(function() {
    'use strict';
    
    // Color mapping
    const kondisiColors = {
        0: 'kondisi-color-0',
        1: 'kondisi-color-1',
        2: 'kondisi-color-2',
        3: 'kondisi-color-3',
        4: 'kondisi-color-4',
        5: 'kondisi-color-5',
        6: 'kondisi-color-6',
        7: 'kondisi-color-7',
        8: 'kondisi-color-8',
        9: 'kondisi-color-9'
    };
    
    // Initialize all custom dropdowns
    document.querySelectorAll('.kondisi-dropdown').forEach(function(dropdown) {
        const selectId = dropdown.dataset.selectId;
        const nativeSelect = document.getElementById(selectId);
        const trigger = dropdown.querySelector('.kondisi-dropdown-trigger');
        const menu = dropdown.querySelector('.kondisi-dropdown-menu');
        const valueDisplay = dropdown.querySelector('.kondisi-dropdown-value');
        const colorIndicator = valueDisplay.querySelector('.kondisi-dropdown-color');
        const textDisplay = valueDisplay.querySelector('.kondisi-dropdown-text');
        const options = dropdown.querySelectorAll('.kondisi-dropdown-option');
        const parentCard = dropdown.closest('.gejala-card'); // Get parent card for z-index management
        
        // Toggle dropdown
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close other dropdowns and reset their z-index
            document.querySelectorAll('.kondisi-dropdown.is-open').forEach(function(other) {
                if (other !== dropdown) {
                    other.classList.remove('is-open');
                    other.querySelector('.kondisi-dropdown-trigger').setAttribute('aria-expanded', 'false');
                    // Reset z-index on wrapper and parent card
                    const otherWrapper = other.closest('.gejala-select-wrapper');
                    if (otherWrapper) otherWrapper.style.zIndex = '';
                    const otherCard = other.closest('.gejala-card');
                    if (otherCard) otherCard.classList.remove('dropdown-active');
                }
            });
            
            // Toggle current
            const isOpen = dropdown.classList.toggle('is-open');
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            
            // Manage z-index on wrapper (for browsers without :has() support)
            const wrapper = dropdown.closest('.gejala-select-wrapper');
            if (wrapper) {
                wrapper.style.zIndex = isOpen ? '100' : '';
            }
            
            // Manage z-index on parent card to ensure dropdown appears above other cards
            if (parentCard) {
                if (isOpen) {
                    parentCard.classList.add('dropdown-active');
                } else {
                    parentCard.classList.remove('dropdown-active');
                }
            }
            
            // Scroll selected option into view
            if (isOpen) {
                const selected = menu.querySelector('.is-selected');
                if (selected) {
                    setTimeout(function() {
                        selected.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                    }, 100);
                }
            }
        });
        
        // Option selection
        options.forEach(function(option) {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const value = option.dataset.value;
                const id = parseInt(option.dataset.id, 10);
                const text = option.querySelector('.kondisi-option-text').textContent;
                
                // Update native select
                nativeSelect.value = value;
                nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                
                // Update visual
                textDisplay.textContent = text;
                colorIndicator.className = 'kondisi-dropdown-color ' + (kondisiColors[id] || 'kondisi-color-0');
                
                // Update selected state
                options.forEach(function(opt) {
                    opt.classList.remove('is-selected');
                });
                option.classList.add('is-selected');
                
                // Close dropdown and reset z-index on parent card
                dropdown.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
                if (parentCard) parentCard.classList.remove('dropdown-active');
            });
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.kondisi-dropdown')) {
            document.querySelectorAll('.kondisi-dropdown.is-open').forEach(function(dropdown) {
                dropdown.classList.remove('is-open');
                dropdown.querySelector('.kondisi-dropdown-trigger').setAttribute('aria-expanded', 'false');
                // Reset z-index on wrapper and parent card
                const wrapper = dropdown.closest('.gejala-select-wrapper');
                if (wrapper) wrapper.style.zIndex = '';
                const card = dropdown.closest('.gejala-card');
                if (card) card.classList.remove('dropdown-active');
            });
        }
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const openDropdown = document.querySelector('.kondisi-dropdown.is-open');
        if (!openDropdown) return;
        
        const menu = openDropdown.querySelector('.kondisi-dropdown-menu');
        const options = Array.from(menu.querySelectorAll('.kondisi-dropdown-option'));
        const currentIndex = options.findIndex(function(opt) { return opt.classList.contains('is-focused') || opt.classList.contains('is-selected'); });
        
        if (e.key === 'Escape') {
            openDropdown.classList.remove('is-open');
            openDropdown.querySelector('.kondisi-dropdown-trigger').setAttribute('aria-expanded', 'false');
            openDropdown.querySelector('.kondisi-dropdown-trigger').focus();
            // Reset z-index on wrapper and parent card
            const wrapper = openDropdown.closest('.gejala-select-wrapper');
            if (wrapper) wrapper.style.zIndex = '';
            const card = openDropdown.closest('.gejala-card');
            if (card) card.classList.remove('dropdown-active');
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = currentIndex < options.length - 1 ? currentIndex + 1 : 0;
            options.forEach(function(opt) { opt.classList.remove('is-focused'); });
            options[nextIndex].classList.add('is-focused');
            options[nextIndex].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = currentIndex > 0 ? currentIndex - 1 : options.length - 1;
            options.forEach(function(opt) { opt.classList.remove('is-focused'); });
            options[prevIndex].classList.add('is-focused');
            options[prevIndex].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
        } else if (e.key === 'Enter') {
            e.preventDefault();
            const focused = menu.querySelector('.is-focused');
            if (focused) {
                focused.click();
            }
        }
    });
})();
</script>";
    }
    break;
}
?>
