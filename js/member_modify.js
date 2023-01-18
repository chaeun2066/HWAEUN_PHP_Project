function reset_form(){
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

function check_input(){
  if(!document.customer_form.pass.value){
    header("location: customer_modify_form.php?error=비밀번호를 입력하세요.");
    document.customer_form.pass.focus();
    return;
  }
  
  if(!document.customer_form.pass_confirm.value){
    header("location: customer_modify_form.php?error=비밀번호를 확인하세요.");
    document.customer_form.pass_confirm.focus();
    return;
  }
  if(!document.customer_form.name.value){
    header("location: customer_modify_form.php?error=이름을 입력하세요.");
    document.customer_form.name.focus();
    return;
  }
  if(!document.customer_form.email1.value){
    header("location: customer_modify_form.php?error=이메일을 입력하세요.");
    document.customer_form.email1.focus();
    return;
  }
  if(!document.customer_form.email2.value){
    header("location: customer_modify_form.php?error=이메일을 입력하세요.");
    document.customer_form.email2.focus();
    return;
  }
  if(!document.customer_form.phpne.value){
    header("location: customer_modify_form.php?error=연락처를 입력하세요.");
    document.customer_form.phpne.focus();
    return;
  }
  if(!document.customer_form.address.value){
    header("location: customer_modify_form.php?error=주소를 입력하세요.");
    document.customer_form.address.focus();
    return;
  }
}