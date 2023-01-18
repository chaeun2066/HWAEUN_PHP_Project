/* 스크롤 */
window.addEventListener('scroll', (e) => {
  let lastKnownScrollPosition = window.scrollY;
  let top_color = document.querySelector(".top");
  /*document.querySelector(".top").innerHTML = window.scrollY*/
  if(lastKnownScrollPosition > 0){ 
    top_color.style.backgroundColor = "#FFFFFF";
    top_color.style.transition = "all 1.2s";
  }else{
    top_color.style.backgroundColor = "transparent";
  }
})

if(document.querySelector("#login") != null){
  document.querySelector("#login").addEventListener('mouseenter', (e) =>{
    document.querySelector(".top").style.backgroundColor = "#FFFFFF";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#login").addEventListener('mouseleave', (e) =>{
    document.querySelector(".top").style.backgroundColor = "transparent";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#join").addEventListener('mouseenter', (e) =>{
    document.querySelector(".top").style.backgroundColor = "#FFFFFF";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#join").addEventListener('mouseleave', (e) =>{
    document.querySelector(".top").style.backgroundColor = "transparent";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
}


if(document.querySelector("#logout") != null){
  document.querySelector("#logout").addEventListener('mouseenter', (e) =>{
    document.querySelector(".top").style.backgroundColor = "#FFFFFF";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#logout").addEventListener('mouseleave', (e) =>{
    document.querySelector(".top").style.backgroundColor = "transparent";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#mypage").addEventListener('mouseenter', (e) =>{
    document.querySelector(".top").style.backgroundColor = "#FFFFFF";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#mypage").addEventListener('mouseleave', (e) =>{
    document.querySelector(".top").style.backgroundColor = "transparent";
    document.querySelector(".top").style.transition = "all 0.5s";
  })

  document.querySelector("#message").addEventListener('mouseenter', (e) =>{
    document.querySelector(".top").style.backgroundColor = "#FFFFFF";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
  
  document.querySelector("#message").addEventListener('mouseleave', (e) =>{
    document.querySelector(".top").style.backgroundColor = "transparent";
    document.querySelector(".top").style.transition = "all 0.5s";
  })
}

document.querySelector("#brand").addEventListener('mouseenter', (e) =>{
  document.querySelector(".top").style.backgroundColor = "#FFFFFF";
  document.querySelector(".top").style.transition = "all 0.5s";
  shop.style.color = "#c7c7c7";
  community.style.color = "#c7c7c7";
  notice.style.color = "#c7c7c7";
})

document.querySelector("#brand").addEventListener('mouseleave', (e) =>{
  document.querySelector(".top").style.backgroundColor = "transparent";
  document.querySelector(".top").style.transition = "all 0.5s";
  shop.style.color = "#2a3428";
  community.style.color = "#2a3428";
  notice.style.color = "#2a3428";
})

document.querySelector("#shop").addEventListener('mouseenter', (e) =>{
  document.querySelector(".top").style.backgroundColor = "#FFFFFF";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#c7c7c7";
  community.style.color = "#c7c7c7";
  notice.style.color = "#c7c7c7";
})

document.querySelector("#shop").addEventListener('mouseleave', (e) =>{
  document.querySelector(".top").style.backgroundColor = "transparent";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#2a3428";
  community.style.color = "#2a3428";
  notice.style.color = "#2a3428";
})

document.querySelector("#community").addEventListener('mouseenter', (e) =>{
  document.querySelector(".top").style.backgroundColor = "#FFFFFF";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#c7c7c7";
  shop.style.color = "#c7c7c7";
  notice.style.color = "#c7c7c7";
})

document.querySelector("#community").addEventListener('mouseleave', (e) =>{
  document.querySelector(".top").style.backgroundColor = "transparent";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#2a3428";
  shop.style.color = "#2a3428";
  notice.style.color = "#2a3428";
})

document.querySelector("#notice").addEventListener('mouseenter', (e) =>{
  document.querySelector(".top").style.backgroundColor = "#FFFFFF";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#c7c7c7";
  shop.style.color = "#c7c7c7";
  community.style.color = "#c7c7c7";
})

document.querySelector("#notice").addEventListener('mouseleave', (e) =>{
  document.querySelector(".top").style.backgroundColor = "transparent";
  document.querySelector(".top").style.transition = "all 0.5s";
  brand.style.color = "#2a3428";
  shop.style.color = "#2a3428";
  community.style.color = "#2a3428";
})


/* window.addEventListener('scroll', (e) => {
	// scroll 이벤트가 발생할 때 마다 이벤트가 발생함을 인식한다
    let lastKnownScrollPosition = window.scrollY;
    // window : 현재 브라우저 창에서
    // .scrollY : 스크롤의 세로 방향 위치
  	document.getElementById("myScroll").innerHTML = window.scrollY
    /*	스크롤 세로 위치를 보도록 한다. 만약에 버튼을 보이고 싶다면 이곳에 
    if(window.scrollY > 50){ showButton = true} 
    이런 식으로 한다면 50보다 스크롤 내려간다면(내릴수록 값 높아짐) 버튼을 보이게 합시다 이런 설정을 보이면 좋겠지요*/
/*}) */