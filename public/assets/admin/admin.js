/*
 * Admin panel behaviour shared by every page (loaded by AdminPage/Layouts/master.blade.php):
 *  - toast notifications (window.adminToast) for flash messages
 *  - confirmation modal for buttons with data-confirm (delete)
 *  - marks the inputs that belong to a validation message as invalid
 */
(function () {
    'use strict';

    var TYPES = {
        success: { icon: 'fa-check-circle', title: 'Berhasil', timeout: 4500 },
        error: { icon: 'fa-times-circle', title: 'Gagal', timeout: 8000 },
        warning: { icon: 'fa-exclamation-triangle', title: 'Perhatian', timeout: 6500 },
        info: { icon: 'fa-info-circle', title: 'Info', timeout: 5000 }
    };

    var stack = null;

    function ensureStack() {
        if (stack) { return stack; }
        stack = document.createElement('div');
        stack.className = 'admin-toast-stack';
        stack.setAttribute('role', 'region');
        stack.setAttribute('aria-label', 'Notifikasi');
        document.body.appendChild(stack);
        return stack;
    }

    function el(tag, className, text) {
        var node = document.createElement(tag);
        if (className) { node.className = className; }
        if (text !== undefined) { node.textContent = text; }
        return node;
    }

    /** Shows a toast. type: success | error | warning | info. Text is inserted as text (never HTML). */
    window.adminToast = function (type, message, options) {
        var config = TYPES[type] || TYPES.info;
        var timeout = (options && options.timeout) || config.timeout;

        var toast = el('div', 'admin-toast admin-toast--' + (TYPES[type] ? type : 'info'));
        toast.setAttribute('role', type === 'error' ? 'alert' : 'status');
        toast.style.setProperty('--toast-duration', timeout + 'ms');

        var icon = el('i', 'fas ' + config.icon + ' admin-toast__icon');
        icon.setAttribute('aria-hidden', 'true');

        var body = el('div', 'admin-toast__body');
        body.appendChild(el('strong', 'admin-toast__title', (options && options.title) || config.title));
        body.appendChild(el('span', 'admin-toast__message', message));

        var close = el('button', 'admin-toast__close');
        close.type = 'button';
        close.setAttribute('aria-label', 'Tutup notifikasi');
        close.innerHTML = '&times;';

        var bar = el('span', 'admin-toast__bar');

        toast.appendChild(icon);
        toast.appendChild(body);
        toast.appendChild(close);
        toast.appendChild(bar);

        var timer = null;
        var remaining = timeout;
        var startedAt = 0;

        function dismiss() {
            clearTimeout(timer);
            if (!toast.parentNode) { return; }
            toast.classList.add('is-leaving');
            setTimeout(function () { if (toast.parentNode) { toast.parentNode.removeChild(toast); } }, 220);
        }

        function start() {
            startedAt = Date.now();
            timer = setTimeout(dismiss, remaining);
            toast.classList.remove('is-paused');
        }

        function pause() {
            clearTimeout(timer);
            remaining -= Date.now() - startedAt;
            toast.classList.add('is-paused');
        }

        close.addEventListener('click', dismiss);
        toast.addEventListener('mouseenter', pause);
        toast.addEventListener('mouseleave', start);
        toast.addEventListener('focusin', pause);
        toast.addEventListener('focusout', start);

        ensureStack().appendChild(toast);
        start();

        return toast;
    };

    function showFlash() {
        var holder = document.getElementById('admin-flash');
        if (!holder) { return; }

        var messages = [];
        try { messages = JSON.parse(holder.getAttribute('data-flash') || '[]'); } catch (e) { messages = []; }

        messages.forEach(function (item, index) {
            setTimeout(function () { window.adminToast(item.type, item.message); }, index * 150);
        });
    }

    // ---- Confirmation modal (Bootstrap 4 modal, same look as the rest of the panel) ------------

    var modal = null;
    var pendingButton = null;

    function buildModal() {
        var wrapper = document.createElement('div');
        wrapper.innerHTML =
            '<div class="modal fade" id="admin-confirm" tabindex="-1" role="dialog" aria-labelledby="admin-confirm-title" aria-hidden="true">' +
            '<div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content admin-confirm">' +
            '<div class="modal-body text-center">' +
            '<div class="admin-confirm__icon" aria-hidden="true"><i class="fas fa-trash-alt"></i></div>' +
            '<h5 class="admin-confirm__title" id="admin-confirm-title">Hapus data?</h5>' +
            '<p class="admin-confirm__text text-muted mb-0" id="admin-confirm-text"></p>' +
            '</div>' +
            '<div class="modal-footer justify-content-center border-0 pt-0">' +
            '<button type="button" class="btn btn-light border" data-dismiss="modal" id="admin-confirm-cancel">Batal</button>' +
            '<button type="button" class="btn btn-danger" id="admin-confirm-ok">Ya, hapus</button>' +
            '</div></div></div></div>';
        modal = wrapper.firstChild;
        document.body.appendChild(modal);

        modal.querySelector('#admin-confirm-ok').addEventListener('click', function () {
            var button = pendingButton;
            pendingButton = null;
            window.jQuery(modal).modal('hide');
            if (button) {
                // Remove the marker so the re-dispatched click is not intercepted again.
                button.removeAttribute('data-confirm');
                button.click();
            }
        });

        window.jQuery(modal).on('shown.bs.modal', function () {
            modal.querySelector('#admin-confirm-cancel').focus();
        });
    }

    function confirmClick(event) {
        var button = event.target.closest ? event.target.closest('[data-confirm]') : null;
        if (!button) { return; }

        event.preventDefault();

        // Without jQuery/Bootstrap (should not happen) fall back to the browser dialog.
        if (!window.jQuery || !window.jQuery.fn.modal) {
            if (window.confirm(button.getAttribute('data-confirm'))) {
                button.removeAttribute('data-confirm');
                button.click();
            }
            return;
        }

        if (!modal) { buildModal(); }

        pendingButton = button;
        modal.querySelector('#admin-confirm-title').textContent = button.getAttribute('data-confirm-title') || 'Hapus data?';
        modal.querySelector('#admin-confirm-text').textContent = button.getAttribute('data-confirm');
        modal.querySelector('#admin-confirm-ok').textContent = button.getAttribute('data-confirm-ok') || 'Ya, hapus';
        window.jQuery(modal).modal('show');
    }

    // ---- Validation messages -------------------------------------------------------------------

    function markInvalidFields() {
        var errors = document.querySelectorAll('.field-error');
        var first = null;

        Array.prototype.forEach.call(errors, function (error) {
            var field = error.previousElementSibling;
            if (!field) { return; }

            var controls = field.matches('input, select, textarea') ? [field] : field.querySelectorAll('input:not([type=hidden]), select, textarea');
            Array.prototype.forEach.call(controls, function (control) {
                control.classList.add('is-invalid');
                control.setAttribute('aria-invalid', 'true');
                if (!first && control.focus) { first = control; }
            });
        });

        if (first) {
            first.focus({ preventScroll: true });
            first.scrollIntoView({ block: 'center', behavior: 'smooth' });
        }
    }

    document.addEventListener('click', confirmClick);

    document.addEventListener('DOMContentLoaded', function () {
        showFlash();
        markInvalidFields();
    });
})();
