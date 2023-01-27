function check_input(){
  if(!document.order_form.name.value){
    alert("받는 분의 성함을 입력해주세요.");
    document.order_form.name.focus();
    return;
  }
 
  if(!document.order_form.phone.value){
    alert("연락처를 입력해주세요.");
    document.order_form.phone.focus();
    return;
  }
 
  if(!document.order_form.postcode.value){
    alert("주소를 입력해주세요.");
    document.order_form.postcode.focus();
    return;
  }

  if(!document.order_form.address.value){
    alert("주소를 입력해주세요.");
    document.order_form.address.focus();
    return;
  }

  if(!document.order_form.extraAddress.value){
    alert("상세주소를 입력해주세요.");
    document.order_form.extraAddress.focus();
    return;
  }

  if(!document.order_form.buy_way.value){
    alert("결제 방식을 입력해주세요.");
    document.order_form.buy_way.focus();
    return;
  }
  
  document.order_form.submit();
}