
//Confirm sign out
function confirmSignOut(link){
    swal({
  title: "Bạn có chắc chắn muốn thoát",
  type: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willQuit) => {
  if (willQuit) {
    window.location.href = link;
  }
});
}
