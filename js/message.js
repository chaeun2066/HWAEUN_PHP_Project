function check_input(){
  if (!document.message_form.rv_id.value){
    header("location: message_form.php?error=수신자를 입력해주세요.");
    document.message_form.rv_id.focus();
    return;
  }
if (!document.message_form.subject.value){
    header("location: message_form.php?error=제목을 입력해주세요.");
    document.message_form.subject.focus();
    return;
  }
if (!document.message_form.content.value){
    header("location: message_form.php?error=내용을 입력해주세요.");
    document.message_form.content.focus();
    return;
  }
document.message_form.submit();
}