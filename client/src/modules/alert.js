import {
    closeAlert
} from '../shared/alert'

$(".alert-modal").on("click", ".btnAlertCancelar", function () {
    closeAlert();
});