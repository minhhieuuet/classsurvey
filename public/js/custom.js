
//Confirm sign out
function confirmSignOut(link){
    swal({
  title: "Bạn có chắc chắn muốn thoát",
  type: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willQuit) => {
  if (willQuit.value) {
    window.location.href = link;
  }
});
}
