const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'red',
    customClass: {
      popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
  })








//   Toast.fire({
//     title: 'Erreur!',
//     text: 'Veillez correctement remplir le formulaire',
//     icon: 'error',
//     confirmButtonText: 'Cool'
// })