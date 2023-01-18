function check_id(){
  window.open("./customer_check_id.php?id=" + document.customer_form.id.value, "IDcheck", "left=700, top=300, width=350, height=220, scrollbars=no, resizable=no, status=no, location=no, menubar=no,toolbar=no");
}

function reset_form(){
  document.customer_form.id.value = "";  
  document.customer_form.pass.value = "";
  document.customer_form.pass_confirm.value = "";
  document.customer_form.name.value = "";
  document.customer_form.email1.value = "";
  document.customer_form.email2.value = "";
  document.customer_form.phone.value = "";
  document.customer_form.address.value = "";
  document.customer_form.id.focus();
  return;
}