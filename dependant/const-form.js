
window.addEventListener('load', function () {

 var otherCheckbox = document.querySelector('input[id="delConfirm"]');
var otherText = document.getElementById('MsgConfirm');

otherText.style.visibility = 'hidden';

otherCheckbox.addEventListener('change', () => {
  if(otherCheckbox.checked) {
    otherText.style.visibility = 'visible';
  } else {
    otherText.style.visibility = 'hidden';
  }
});

});
