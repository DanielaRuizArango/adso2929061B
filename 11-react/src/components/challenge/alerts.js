import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

export const swal = Swal.mixin({
  background: '#FFFDF9',
  color: '#4B3425',
  confirmButtonColor: '#E98B42',
  cancelButtonColor: '#78885A',
  customClass: {
    popup: 'larapets-alert',
    title: 'larapets-alert-title',
    htmlContainer: 'larapets-alert-text',
    confirmButton: 'larapets-alert-confirm',
    cancelButton: 'larapets-alert-cancel',
  },
  buttonsStyling: false,
});

export function showError(title, message) {
  return swal.fire({
    icon: 'error',
    title,
    html: message,
  });
}
