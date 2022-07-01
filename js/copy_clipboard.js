function goClipboard() {
  /* Get the Permalink Text */
  var copyText = document.getElementById("go-airports-share_box_link_val");

  /* Save Copied Text to Clipboard */
  navigator.clipboard.writeText(copyText.textContent);

  /* Alert the copied text */
  alert("Link has been copied to your clipboard. Just paste and share!");
}