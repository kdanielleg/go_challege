/**
 * Drag n Drop Submit
 **/
function go_dropHandler(ev) {
  // Prevent default behavior (Prevent file from being opened)
  ev.preventDefault();

  //set File Input
  let fileInput = document.querySelector('input#airport_file_upload');

  fileInput.files = ev.dataTransfer.files;

  //trigger change event
  fileInput.dispatchEvent(new Event('change'));
}
function go_dragOverHandler(ev) {
  // Prevent default behavior (Prevent file from being opened)
  ev.preventDefault();

  // Add dragging class
  document.getElementById('go-airports-submit_box_form_drop').classList.add('dragging');
}
function go_dragLeaveHandler(ev) {
  // Prevent default behavior (Prevent file from being opened)
  ev.preventDefault();
  
  // Add draggling class
  document.getElementById('go-airports-submit_box_form_drop').classList.remove('dragging');
}