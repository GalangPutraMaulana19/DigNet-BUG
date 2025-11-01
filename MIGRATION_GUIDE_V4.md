# Migration Guide: AdminLTE v2 → v4 (Bootstrap 3 → 5)

## Overview

This guide documents the full migration from AdminLTE v2 (Bootstrap 3 + jQuery) to AdminLTE v4 (Bootstrap 5, no jQuery).

## Phase 1: Infrastructure Setup ✅ COMPLETED

### What was done:
1. ✅ Created `package.json` with AdminLTE v4, Bootstrap 5, Font Awesome 6
2. ✅ Setup Vite build pipeline (`vite.config.js`)
3. ✅ Created modern SCSS structure in `src/scss/`
4. ✅ Created vanilla JavaScript entry point in `src/js/app.js`
5. ✅ Implemented Bootstrap 5 native features (no jQuery)

### New file structure:
```
src/
├── js/
│   └── app.js          # Main JS (Bootstrap 5, AdminLTE v4, vanilla JS)
├── scss/
│   ├── app.scss        # Main SCSS entry
│   └── custom/
│       ├── _variables.scss      # IndiHome theme colors
│       ├── _components.scss     # Modern components
│       ├── _utilities.scss      # Utility classes & animations
│       └── _indihome-theme.scss # IndiHome branding
```

### To build assets:
```bash
npm install
npm run build    # Production build → dist/
npm run dev      # Development mode with hot reload
```

## Phase 2: Layout Migration (IN PROGRESS)

### Changes needed:

#### Old AdminLTE v2 Structure → New AdminLTE v4
```html
<!-- OLD (v2) -->
<div class="wrapper">
  <header class="main-header">...</header>
  <aside class="main-sidebar">...</aside>
  <div class="content-wrapper">...</div>
  <footer class="main-footer">...</footer>
</div>

<!-- NEW (v4) -->
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">...</nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">...</aside>
  <div class="content-wrapper">...</div>
  <footer class="main-footer">...</footer>
</div>
```

#### Component Class Changes:

| Old (v2) | New (v4) | Notes |
|----------|----------|-------|
| `.box` | `.card` | Container component |
| `.box-header` | `.card-header` | Card header |
| `.box-body` | `.card-body` | Card body |
| `.box-footer` | `.card-footer` | Card footer |
| `.pull-left` | `.float-start` | BS5 utility |
| `.pull-right` | `.float-end` | BS5 utility |
| `.text-left` | `.text-start` | BS5 utility |
| `.text-right` | `.text-end` | BS5 utility |
| `.label` | `.badge` | Label component |
| `.label-primary` | `.bg-primary` | Color utility |
| `.btn-default` | `.btn-secondary` | Button variant |
| `.input-group-addon` | `.input-group-text` | Input group |
| `.form-control-feedback` | `.valid-feedback` / `.invalid-feedback` | Form validation |

#### Icon Class Changes:

| Old (FA4) | New (FA6) | Notes |
|-----------|-----------|-------|
| `<i class="fa fa-user">` | `<i class="fa-solid fa-user">` | Solid icons |
| `<i class="fa fa-home">` | `<i class="fa-solid fa-home">` | Solid icons |
| `<i class="fa fa-cog">` | `<i class="fa-solid fa-gear">` | Name changed |
| Ionicons removed | Font Awesome 6 only | Use FA6 equivalents |

#### Form Changes (iCheck → Bootstrap 5):

```html
<!-- OLD (iCheck plugin) -->
<input type="checkbox" class="minimal">

<!-- NEW (Bootstrap 5 native) -->
<div class="form-check">
  <input class="form-check-input" type="checkbox" id="check1">
  <label class="form-check-label" for="check1">
    Label text
  </label>
</div>
```

## Phase 3: Removing Legacy Dependencies

### To Remove:
- ❌ `aset/jQuery-2.js` → Replaced by vanilla JS
- ❌ `aset/icheck/` → Bootstrap 5 native forms
- ❌ `aset/Flot/` → Chart.js v4
- ❌ `aset/Ionicons/` → Font Awesome 6
- ❌ `aset/skins/` → AdminLTE v4 themes
- ❌ `aset/ckeditor/` (v4) → CKEditor 5

### Keep (but update):
- ✅ `aset/bootstrap.css` → Will be replaced by built CSS from Vite
- ✅ `aset/AdminLTE.css` → Will be replaced by AdminLTE v4

## Phase 4: JavaScript Migration (jQuery → Vanilla JS)

### Common jQuery patterns → Vanilla JS:

```javascript
// OLD jQuery
$(document).ready(function() {
  $('.btn').click(function() {
    $('#modal').modal('show');
  });
});

// NEW Vanilla JS
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const modal = new bootstrap.Modal(document.getElementById('modal'));
      modal.show();
    });
  });
});
```

### Bootstrap Components (jQuery → Bootstrap 5):

```javascript
// OLD jQuery
$('#myModal').modal('show');
$('[data-toggle="tooltip"]').tooltip();

// NEW Bootstrap 5
const modal = new bootstrap.Modal(document.getElementById('myModal'));
modal.show();

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
[...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
```

## Phase 5: Testing Checklist

### Features to Test:
- [ ] Login page
- [ ] Dashboard with statistics
- [ ] Sidebar navigation
- [ ] Diagnosis form (gejala selection)
- [ ] Admin CRUD operations (Gangguan, Gejala, Basis Pengetahuan)
- [ ] Data tables with pagination
- [ ] Form validation
- [ ] Modals and alerts
- [ ] Responsive design (mobile/tablet)
- [ ] Print functionality
- [ ] Riwayat diagnosis

## Phase 6: Files to Update

### Priority 1 (Core Layout):
1. `index.php` - Main layout structure
2. `menu.php` - Sidebar navigation
3. `header.php` - Top navigation (if separate)
4. `footer.php` - Footer (if separate)

### Priority 2 (Main Modules):
1. `modul/welcome.php` - Dashboard
2. `modul/diagnosa/diagnosa.php` - Diagnosis form
3. `modul/repair/repair.php` - Data Gangguan (CRUD)
4. `modul/incident/incident.php` - Data Gejala (CRUD)
5. `modul/pengetahuan/pengetahuan.php` - Basis Pengetahuan (CRUD)

### Priority 3 (Supporting Modules):
1. `modul/formlogin.php` - Login page
2. `modul/tentang.php` - About page
3. `modul/bantuan.php` - Help page
4. `modul/riwayat/` - History pages
5. `modul/post/` - Post management
6. `modul/admin/` - Admin management
7. `modul/password/` - Password change

## Timeline

- **Phase 1**: Infrastructure Setup (1 day) ✅ DONE
- **Phase 2**: Layout Migration (2-3 days) ← CURRENT
- **Phase 3**: Component Migration (3-4 days)
- **Phase 4**: JavaScript Migration (2-3 days)
- **Phase 5**: Testing & Bug Fixes (3-4 days)
- **Phase 6**: Documentation & Cleanup (1-2 days)

**Total Estimated Time**: 2-3 weeks

## Notes

- Keep original files backed up
- Test each module after migration
- Use browser DevTools to debug JS issues
- Check console for errors
- Validate CSS with built output
- Test on multiple browsers (Chrome, Firefox, Edge)

## Resources

- [AdminLTE v4 Documentation](https://adminlte.io/docs/4.0/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)
- [Font Awesome 6 Icons](https://fontawesome.com/icons)
- [Chart.js Documentation](https://www.chartjs.org/docs/latest/)
- [Vite Documentation](https://vitejs.dev/)

---

**Status**: Phase 1 Complete | Phase 2 In Progress  
**Last Updated**: 2025-11-01
