var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}

function enableModify(){
  $("input[name='enable']").prop('disabled', false);
  $("select[name='enable']").prop('disabled', false);
}

function disableModify(){
  $("input[name='enable']").prop('disabled', true);
  $("select[name='enable']").prop('disabled', true);
}