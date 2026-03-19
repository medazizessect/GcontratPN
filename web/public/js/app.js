/**
 * GcontratPN — JavaScript principal
 */

document.addEventListener('DOMContentLoaded', function () {

    // Confirmation de suppression
    document.querySelectorAll('.btn-delete').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id    = this.dataset.id;
            const csrf  = this.dataset.csrf;

            if (!confirm('هل أنت متأكد من رغبتك في الحذف؟\nهذا الإجراء لا يمكن التراجع عنه.')) {
                return;
            }

            const form = document.getElementById('deleteForm');
            if (!form) return;

            document.getElementById('deleteId').value    = id;
            document.getElementById('deleteToken').value = csrf;
            form.submit();
        });
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function () {
        document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) bsAlert.close();
        });
    }, 5000);

    // Initialize DataTables if present
    const tables = document.querySelectorAll('.datatable');
    tables.forEach(function (table) {
        if (typeof $.fn !== 'undefined' && typeof $.fn.DataTable !== 'undefined') {
            $(table).DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/ar.json'
                },
                order: [],
                pageLength: 20,
            });
        }
    });

    // Montant calculation helper (NbrJour * daily rate)
    const nbrJourInput    = document.querySelector('[name="NbrJour"]');
    const montantLitInput = document.querySelector('[name="MontantLit"]');
    const montantAnnInput = document.querySelector('[name="MontantAnn"]');

    if (nbrJourInput && montantLitInput && montantAnnInput) {
        function calcMontantAnn() {
            const nbrJour    = parseFloat(nbrJourInput.value) || 0;
            const montantLit = parseFloat(montantLitInput.value) || 0;
            if (nbrJour > 0 && montantLit > 0) {
                montantAnnInput.value = (nbrJour * montantLit / 365).toFixed(3);
            }
        }
        nbrJourInput.addEventListener('input', calcMontantAnn);
        montantLitInput.addEventListener('input', calcMontantAnn);
    }
});
